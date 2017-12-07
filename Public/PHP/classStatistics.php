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
                    echo "<input type=\"hidden\" name=\"total_points\" 
                          value=\" {$questions['PointsAvailable']}\">";                  }
                }  
              ?>
            </select>
            
            <input type="submit" value="View Daily Statistics">
          </div>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
