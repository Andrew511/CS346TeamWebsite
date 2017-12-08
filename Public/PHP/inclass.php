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
  $id = $_POST['question_list'];
  $time = time();
  $activate_start = date('Y/m/d h:i:s a', $time);
  activate_question($id, 3, $activate_start);
  $q = get_active_question($id);
  $answers = get_answer_choices($id);
  $print = get_answer_choices($id);
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
      <script src="../JavaScript/inclass.js"></script>
  </head>

  <body>
    <?php include 'instructor_navigation.php';?>
    <div class="border">
      <?php include 'header.php';?>
      <div id="flexContainer">
        <h1>Live Statistics</h1>
        <div class="question">
          <?php
          echo $activate_start;
          if (isset($q[0])) {
  		        $question = $q[0];
              $answers = get_question_answers($id);
              echo "<h2>";
              echo $question['QuestionId'];
              echo "</h2>";
              echo "<p>";
              echo $question['QuestionText'];
              echo "</p>";

          echo "<p>Answer Options:</p>";
          echo "<ul>";
          if($question['QuestionType'] === "short"){
            foreach($print as $print){
              echo "<li>";
              echo "{$print["ShortAnswer"]}";
              echo "</li>";
            }
          }
          else{
            foreach($print as $print){
              echo "<li>";
              echo "{$print["AnswerText"]}";
              echo "</li>";
            }
          }
          echo "</ul>";
        }
          ?>
          <h2 id="timer"><time>00:00:00</time></h2>
        </div>

        <form method="post">
          <input type="hidden" name="id" value="<?php echo $id?>">
          <input type="hidden" name="type" value="<?php echo $question['QuestionType']?>">
          <?php

              if($question['QuestionType'] === "short"){
                foreach($answers as $answers){
                  echo "<input type=\"hidden\" class=\"answer\" name=\"answers[]\"
                  value=\"";
                  echo "{$answers['ShortAnswer']}";
                  echo "\">";
                }
              }
              else {
                foreach($answers as $answers){
                  echo "<input type=\"hidden\" class=\"answer\" name=\"answers[]\"
                  value=\"";
                  echo "{$answers['AnswerText']}";
                  echo "\">";
                }
              }

           ?>
          <button type="sumbit" name="deactivate"
              formaction="confirmDeactivate.php">Deactivate</button>
        </form>
        <p id="right"> </p>
        <p id="wrong"></p>
      </div>

      <canvas id="live_stats" width="1000" height="400"></canvas>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
