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
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $id = $_POST['results'];
              $keywords = get_keyword_list($id);
              $students_answers = get_student_answers($id);
              $answer_choices = get_answer_choices($id);
              $question = get_question($id);

              echo "<h1>$id</h1>";
              echo "<p>You answer selections <ul>";
              foreach($students_answers as $s){
                echo "<li>";
                echo "{$s['StudentAnswer']}";
                echo "</li>";
              }
            }
             ?>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
