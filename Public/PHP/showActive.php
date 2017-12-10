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
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
  </head>
  <body>
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div id="flexContainer">
        <?php
		$questions = get_active(); 
        if (isset($questions[0])) {
		$question = $questions[0];
        $answers = get_question_answers($question['QuestionId']); ?>
        <form action="submitAnswer.php" method="post">
          <input type="hidden" name="QuestionId" value="<?php echo $question['QuestionId'] ?>" >
          <p> <?php echo $question['QuestionText']; ?> </p>

          <?php if ($question['QuestionType'] === "multiple") { 
            $i = 0;
             foreach ($answers as $answer) { ?>
               <input type="radio" id="radio<?php echo $i;?>" name="radio" value="<?php echo $answer['AnswerText'];?>">
               <label for="radio<?php echo $i;?>"> <?php echo $answer['AnswerText'];?> </label>
              <?php $i = $i + 1;
             }
           }

            elseif ($question['QuestionType'] === "checkbox") { 
            $i = 0;
             foreach ($answers as $answer) { ?>
               <input type="checkbox" id="checkbox<?php echo $i;?>" name="checkbox<?php echo $i;?>" value="<?php echo $answer['AnswerText'];?>">
               <label for="checkbox<?php echo $i;?>"> <?php echo "$i. " . $answer['AnswerText'];?> </label>
              <?php $i = $i + 1;
             }
           }

            elseif ($question['QuestionType'] === "short") { 
            
              ?>
               <input type="text" id="text" name="text">
               
              <?php 
            
           } ?>
          <input type="submit" value="Submit">
        </form>

        <?php } else { ?>
          <div id="errorMessage">
            Let the instructor know that there are no active questions in the
            database.
            
            <form action="showActive.php" id="showQuestion" class="questions">
              <div>
                <input type="submit" value="Show Question"/>
              </div>
            </form>
          </div>
        
        <?php } ?>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
