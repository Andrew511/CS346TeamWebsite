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
  $id = $_POST['id'];
  $end = date('Y/m/d h:i:s a' , time());

}

$questions = get_deactivated_question_list();
$hidden = $questions;
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
    <?php include 'instructor_navigation.php';?>
    <div class="border">
      <?php include 'header.php';?>
      <div id="flexContainer">
        <h1>Class Statistics</h1>
        <form method="post" action="daily_statistics.php">
          <div id="directoryQuestions">
            <select id="question_list" name="stats">
              <?php
                if(empty($questions)){
                  echo "<option>No Questions Available</option>";
                }
                else {
                  foreach ($questions as $questions)
                  {
                    echo "<option value=\"{$questions['QuestionId']}\">";
                    echo "{$questions['QuestionId']}: {$questions['Description']}";
                    echo " Activated on: ";
                    echo "{$questions['ActivationStart']}";
                    echo "</option>";
                  }
                }
              ?>
            </select>
            <?php
              foreach($hidden as $hidden){
                echo "<input type=\"hidden\" name=\"total_points\"
                      value=\" {$hidden['PointsAvailable']}\">";
              }
            ?>
            <input type="submit" value="View Daily Statistics">
          </div>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
