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
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // this is a POST request and thus a form submission: process the form data
    
    /* to be completed:
       1) retrieve the question based on the form data
       2) disconnect from the database
    */
    $keyword = $_POST['keywordSearch'];
	$section = $_POST['section'];
	$score = $_POST['score'];
	$pointsAv = $_POST['pointsAvailable'];
	if(!isset($keyword))
	{$keyword = 'Null';}
	if(!isset($section))
	{$section = 'Null';}
	if(!isset($score))
	{$score = 'Null';}
	if(!isset($pointsAv))
	{$pointsAv = 'Null';}
    $q = search($keyword,$section,$score,$pointsAv); 
	if($q == null)
	{
	echo "No Result, please modify your seach.";
	}
	

  } else {
    // this is a GET request: no form data to process

    /* to be completed:
       null out the question to be used below
    */
    
    $q = NULL;
    
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
  </head>

  <body>
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div class="flexContainer">
          <div class="searchContainer">
            <h1>Search Results</h1>
            <div>
			<?php
					echo "<ul><li>Keyword:" ;
					echo "{$_POST['keyword']}";
					echo"</li><li>Section:";
					echo "{$_POST['section']}";
					echo "</li><li>Your score:";
					echo "{$_POST['score']}";
					echo "</li><li>Total score:";
					echo "{$_POST['pointsAvailable']}";
					echo"</li>";
				foreach($q as $q)
			   {
				    echo "<li>Question id:";
					echo "{$q['QuestionId']}";
					echo "</li><li>Question :";
					echo "{$q['QuestionText']}";
					echo "</li>";
				}
					echo "</ul>";
				
			  ?>
            </div>
          </div>
        </div>
	</div>	
    <?php include 'footer.php';?>
  </body>
</html>
