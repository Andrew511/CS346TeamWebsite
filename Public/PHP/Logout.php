<?PHP
session_start()  ;
$dir = realpath(__DIR__ . '/../..').'/Private/PHP' ;
$pdir = dirname(__FILE__) ;
$temp[] = preg_split("[/]" , $pdir) ;
$pubDir = "";
for($i = 3 ; $i < sizeof($temp[0]) ; $i++)
{
	$pubDir = $pubDir . "/" . $temp[0][$i] ;
}
require_once($dir.'/initialize.php') ;
global $db ;
if(!isset($_SESSION['ID']))
	{
		header("Location:" . $pubDir . "/Login.php") ;
	}
	else
	{
		$UN = $_SESSION['username'] ;
		$id = $_SESSION['ID'] ;
		$role = $_SESSION['role'] ;
	}
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$id = $_SESSION['ID'] ;
	$role = $_SESSION['role'] ;
	$lastLogout = date('Y-m-d H:i:s' , time()) ;
	
	if($role == "student")
	{
		try
		{
			$query = "UPDATE Students SET LastLogout = '$lastLogout' WHERE StudentId = '$id'" ;
			$db->exec($query) ;
		}
		catch(PDOException $e)
		{
			echo "Error updating logout time." ;
		}
	}
	else
	{
		try
		{
			$query = "UPDATE Instructors SET LastLogout = '$lastLogout' WHERE InstructorId = '$id'" ;
			$db->exec($query) ;
		}
		catch(PDOException $e)
		{
			echo "Error updating logout time." ;
		}
	}
	//clears session variables
	$_SESSION = array() ;
	session_destroy() ;
	header("Location: ".$pdir."/Login.php") ;
}
	
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
  </head>
  <body>
    <?php
		if($role === "student") 
			include_once ('student_navigation.php') ;
		elseif($role === "instructor")
			include_once ('instructor_navigation.php') ;
	?>
    <div class="border">
      <?php include 'header.php' ?>
      <div id="flexContainer">
        <div class="confirm">
          <form action="Logout.php" method="post">
            <p> Are you sure you want to logout?</p>
            <input type="submit" value="Yes, I'm sure!"/>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
