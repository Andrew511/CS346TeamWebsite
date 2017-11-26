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
        $question = display_Q_table()[0]; 
        $answers = get_question_answers($question['QuestionId']);
        ?>

      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>