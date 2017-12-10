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
    <?php include_once 'student_navigation.php';?>
    <div class="border">
      <?php include_once 'header.php' ?>
      <div class="flexContainer">
          <div class="searchContainer">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $qid = $_POST['results'];
              $keywords = get_keyword_list($qid);
              $students_answers = search_student_answers($qid, $id);
							$student_score = student_search_score($qid, $id);
              $answer_choices = get_answer_choices($qid);
              $question = get_question($qid);

              echo "<h1>$qid</h1>";
              echo "<p>You answer selections <ul>";
              foreach($students_answers as $s){
                echo "<li>";
                echo "{$s['StudentAnswer']}";
                echo "</li>";
              }
							echo "</ul></p>";
							echo "<p>Correct Answer: <ul>";
							foreach($answer_choices as $answers){
								if("{$answers['Correct']}"){
									echo "<li>";
									echo "{$answers['AnswerText']}";
									echo "</li>";
								}
								else if("{$answers['ShortAnswer']}"){
									echo "</li>";
									echo "{$answers['ShortAnswer']}";
									echo "</li>";
								}
							}
							echo "</ul></p>";
								echo "<h2>Question Description</h2>";
								echo "<p>";
								echo $question['Description'];
								echo "</p>";
								echo "<p>";
								echo $question['QuestionText'];
								echo "</p>";
            }
             ?>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
