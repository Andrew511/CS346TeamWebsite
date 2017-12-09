<?php
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
    <div>
       <?php
		if($role === "student") 
			include_once ('student_navigation.php') ;
		elseif($role === "instructor")
			include_once ('instructor_navigation.php') ;
		?>
      <div class="border">
        <?php include 'header.php' ?>
        <div class="flexContainer">
          <div class="changePwContainer">
            <form action="ChangePassword.php" method = "POST">
              <div class="pwBox">
			  <?PHP
			  		
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$oldPass = $_POST['oldPassword'] ;
		$newPass1 = $_POST['newPassword'] ;
		$newPass2 = $_POST['confirmPassword'] ;
	if($newPass1 === $newPass2 && strpos($newPass1 , $UN) == false && strpos($newPass1 , $oldPass) == false)
	{
		$newPass = $newPass1 ;
		if($role === "student")
		{
		try
		{
			$query = "SELECT Salt FROM Students WHERE StudentId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["id" => $id]) ;
			$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
			$salt = $stmt['Salt'] ;
			$query = "SELECT PasswordChanges FROM Students WHERE StudentId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["id" => $id]) ;
			$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
			$pwc = $stmt['PasswordChanges'] ;
			$pwc++ ;
			$oldPass = hash_password($oldPass , $salt) ;
			$newPass = hash_password($newPass , $salt) ;
			$query = "UPDATE Students SET HashPassword = :newPass WHERE StudentId = :id AND HashPassword = :oldPass" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["newPass" => $newPass , "id" => $id , "oldPass" => $oldPass]) ;
			$query = "UPDATE Students SET PasswordChanges = :pwc WHERE StudentId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["pwc" => $pwc , "id" => $id]) ;
			echo "Password Changed.<br>" ;
		}
		catch (PDOException $e)
		{
			echo "Error updating password" ;
		}
	}
	else
	{
		try
		{
			$query = "SELECT Salt FROM Instructors WHERE InstructorId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["id" => $id]) ;
			$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
			$salt = $stmt['Salt'] ;
			$query = "SELECT PasswordChanges FROM Instructors WHERE InstructorId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["id" => $id]) ;
			$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
			$pwc = $stmt['PasswordChanges'] ;
			$pwc++ ;
			$oldPass = hash_password($oldPass , $salt) ;
			$newPass = hash_password($newPass , $salt) ;
			$query = "UPDATE Instructors SET HashPassword = :newPass WHERE InstructorId = :id AND HashPassword = :oldPass" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["newPass" => $newPass , "id" => $id , "oldPass" => $oldPass]) ;
			$query = "UPDATE Instructors SET PasswordChanges = :pwc WHERE InstructorId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["pwc" => $pwc , "id" => $id]) ;
			echo "Password Changed.<br>" ;
		}
		catch (Exception $e)
		{
			echo "Error updating password" ;
		}
	}
	}
	else
	{
		echo "Your new password does not meet the standards.<br>" ;
	}
	
	}
			  
	 ?>
                <label>
                  Username:
                  <input type="text" name="username" value=<?PHP echo htmlspecialchars($UN); ?>  readonly><br/>
                </label>
                <label>
                  Old Password:
                  <input type="password" name="oldPassword" required><br/>
                </label>
                <label>
                  New Password:
                  <input type="password" name="newPassword" required><br/>
                </label>
                <label>
                  Confirm New Password:
                  <input type="password" name="confirmPassword" required><br/>
                </label>
                <p>
                  Your password <strong>must</strong> meet all three requirements
                  below:
                </p>
                <ol>
                  <li>It must contain AT LEAST 8 characters.</li>
                  <li>It may NOT appear in Cain &amp; Abel's dictionary of common
                    passwords.</li>
                  <li>It may NOT contain your username as a substring</li>
                </ol>
                <p class="centered">
                  <input type="submit" value="Change Password"/>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include 'footer.php';?>
    </div>
  </body>
</html>
