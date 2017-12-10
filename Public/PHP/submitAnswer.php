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
	$student = get_student_by_username($UN);
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
    <?php include_once 'student_navigation.php';?>
    <div class="border">
      <?php include_once 'header.php' ?>
      <div id="flexContainer">
        <?php $question = get_question($_POST['QuestionId']);
        $answers = get_question_answers($question['QuestionId']);
        $score = 1;
        $totalScore = $question['PointsAvailable'];
        $numcorrect = 0;
        $correctAnswers = "";
		$studentAnswer = "";
		if ($question['QuestionType'] !== "short") {
            $i = 1;
			foreach ($answers as $answer) {

				if ($answer['Correct'] == 1) {
				$numcorrect = $numcorrect + 1;
                $correctAnswers .= $answer['AnswerText'] . ", ";
                }
                $i += 1;
			}
		} else {
            $correctAnswers = $answers[0]['ShortAnswer'];
            $numcorrect = 1;
		}
        $scorePerCorrect = ($totalScore - 1) / $numcorrect;

         if ($question['QuestionType'] == "multiple") {

               if (isset($_POST["radio"])) {
					$studentAnswer = $_POST["radio"];
                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["radio"]) {
                            if ($answer['Correct'] == 1) {
                           $score += $scorePerCorrect;
                            }
                        }
                    }
                }
        }
		else if ($question['QuestionType'] == "checkbox") {
            for ($i = 0; $i < count($answers); $i += 1 ) {

               if (isset($_POST["checkbox$i"])) {
                    $studentAnswer .= $_POST["checkbox$i"] . "|";

                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["checkbox$i"]) {
                            if ($answer['Correct'] == 1) {
                           $score += $scorePerCorrect;
                            }
                            else {
                                if ($score > 1) {
                                    $score -= $scorePerCorrect;
                                }
                            }
                        }
                    }
                }
            }
        }
		else if ($question['QuestionType'] == "short") {
            for ($i = 0; $i < count($answers); $i += 1 ) {
               if (isset($_POST["text"])) {
					$studentAnswer = $_POST["text"];
                    foreach ($answers as $answer) {
                        if ($answer['AnswerText'] === $_POST["text"]) {
                            if ($answer['Correct'] == 1) {
                           $score = $totalScore;
						   break;
                            }
                        }
                    }
                }
            }
        }
        ?>

		<p> Score on Question <?php echo $question['QuestionId']; ?> <?php echo "$score/$totalScore"; ?></p>
		<p> <?php echo "Correct Answers: "; 
			echo $correctAnswers;
			?>
		</p>

        <p> <?php echo $question['QuestionText']; ?> </p>

        <?php
        add_score($_POST['QuestionId'], $student['StudentId'], $score, $studentAnswer );
		if ($score == $totalScore) {
			add_correct_submission($question['QuestionId']);
		}
        ?>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
