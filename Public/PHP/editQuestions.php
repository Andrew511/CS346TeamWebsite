
<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
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
        <h1>Questions in Directory</h1>
        <form action="edit.php" method="post">
          <div id="directoryQuestions">
            <select id="question_list">
              <?php
                $q = get_question_list();
                if(empty($q)){
                  echo "<option>No Questions Available</option>";
                }
                else {
                  foreach($q as $q){
                    echo "<option value=\"{$q['QuestionID']}\"> {$q['QuestionId']}: {$q['Description']}</option>";
                  }
                }
              ?>
            </select>
            <input type="submit" value="Edit"/>
          </div>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
