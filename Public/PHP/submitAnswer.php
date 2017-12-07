<?php 
require_once('../../Private/PHP/initialize.php');
session_start();
$student = get_student_by_username($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
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
        <?php $question = get_question($_POST['QuestionId']);
        $answers = get_question_answers($question['QuestionId']);
        $score = 1;
        $totalScore = $question['PointsAvailable'];
        $numcorrect = 0;
        $correctAnswers = "";
		if ($question['QuestionType'] !== "short") {
			foreach ($answers as $answer) {
				if ($answer['Correct'] === 1) {
				$numcorrect = $numcorrect + 1;
				}   
			}
		} else {
			$numcorrect = 1;
		}
        $scorePerCorrect = ($totalScore - 1) / $numcorrect;
         if ($question['QuestionType'] === "multiple") { 
            for ($i = 0; $i < count($answers); $i += 1 ) {
               if (isset($_POST["radio'$i'"])) {
                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["radio'$i'"]) {
                            if ($answer['Correct'] === 1) {
                           $score += $scorePerCorrect;
                           $correctAnswers += "$i ";
                            }
                        } 
                    }
                }
            }
        }
		else if ($question['QuestionType'] === "checkbox") { 
            for ($i = 0; $i < count($answers); $i += 1 ) {
               if (isset($_POST["checkbox'$i'"])) {
                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["checkbox'$i'"]) {
                            if ($answer['Correct'] === 1) {
                           $score += $scorePerCorrect;
                           $correctAnswers += "$i ";
                            }
                        } 
                    }
                }
            }
        }
		else if ($question['QuestionType'] === "short") { 
            for ($i = 0; $i < count($answers); $i += 1 ) {
               if (isset($_POST["text"])) {
                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["text"]) {
                            if ($answer['Correct'] === 1) {
                           $score = $totalScore;
                           $correctAnswers += $answer['AnswerText'];
						   break;
                            }
                        } 
                    }
                }
            }
        }
        ?>
        <p> Score on Question <?php echo $question['QuestionId']; ?> <?php echo "$score/$totalScore"; ?>
        <p> <?php echo $question['QuestionText']; ?> </p>

        <?php
        add_score($_POST['QuestionId'], $student['StudentId'], $score);
        ?>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>