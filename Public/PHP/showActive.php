<!DOCTYPE html>
<?php    require_once('../../Private/PHP/initialize.php'); ?>
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
        if (get_active()[0].isset) {?>
		$question = get_active()[0]; 
        $answers = get_question_answers($question['QuestionId']);
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
               <input type="checkbox" id="checkbox<?php echo $i;?>" name="checkbox" value="<?php echo $answer['AnswerText'];?>">
               <label for="checkbox<?php echo $i;?>"> <?php echo "$i. " + $answer['AnswerText'];?> </label>
              <?php $i = $i + 1;
             }
           }

            elseif ($question['QuestionType'] === "short") { 
            
             foreach ($answers as $answer) { ?>
               <input type="text" id="text" name="text">
               <label for="text"> <?php echo $answer['AnswerText'];?> </label>
              <?php 
             }
           } ?>
          <input type="submit" value="Submit">
        </form>

        <?php } else { ?>
          <div id="errorMessage">
            Let the instructor know that there are no active questions in the
            database.
          </div>
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
        
        <?php } ?>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>