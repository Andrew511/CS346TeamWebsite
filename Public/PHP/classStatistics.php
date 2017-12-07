<?php    
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php'); 

$questions = get_deactivated_question_list();
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
    <?php include 'instructor_navigation.php';?>
    <div class="border">
        <?php include 'header.php';?>
        <div id="flexContainer">
            <?php
            
            foreach ($questions as $question)
            {
              echo "<a href=\"daily_statistics.php\">";
              echo "{$questions['QuestionId']}: {$questions['Description']}";
              echo "Activated on: ";
              echo "{$questions['ActivateionStart']}";
            }
            
            ?>
        </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
