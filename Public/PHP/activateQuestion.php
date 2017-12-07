<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');
$q = get_completed_question_list();
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
    <?php include_once 'instructor_navigation.php';?>
    <div class="border">
      <?php include_once 'header.php';?>
      <div id="flexContainer">
        <form method="post">
          <div id="activateQuestions">
            <select id="question_list" name="question_list">
              <?php
                if(empty($q)){
                  echo "<option>No Questions Available</option>";
                }
                else {
                  foreach($q as $q){
                    echo "<option value=\"{$q['QuestionId']}\">
                      {$q['QuestionId']}: {$q['Description']}</option>";
                  }
                }
              ?>
            </select>
            <button type="submit" formaction="inclass.php">Activate Question</button>
            <button type="submit" formaction="confirmDeactivateAll.php">
              Deactivate All</button>
          </div>
        </form>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
