<?php
session_start()  ;
$dir = '/var/www/students/team6/CS346TeamWebsite/Private/PHP' ;
$pdir = '/students/team6/CS346TeamWebsite/Public/PHP' ;
require_once($dir.'/initialize.php') ;
global $db ;
if(!isset($_SESSION['ID']))
	{
		header("Location:" . $pdir . "/Login.php") ;
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
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div id="flexContainer">
        <div id="studentHomePage">
          <p>
            Are you currently in class? Has the instructor activated the next
            question?<br/>
            Then click this button right away.
          </p>
          <form action="showActive.php" id="showQuestion" class="questions">
            <div>
              <input type="submit" value="Show Question"/>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
