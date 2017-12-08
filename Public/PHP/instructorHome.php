<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
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
        <div id="instructorOptions">
          <ul class="homeOptions">
            <li><a href="activateQuestion.php">Activate\Deactivate Question</a></li>
            <li><a href="editQuestions.php">Add\Edit\Review Questions</a></li>
            <li><a href="classStatistics.php">Statistics</a></li>
          </ul>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
