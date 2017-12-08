<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');
date_default_timezone_set("America/Chicago");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['question_list'];
  $time = time();
  $activate_start = date('Y/m/d h:i:s a', $time);
  activate_question($id, 3, $activate_start);
  $q = get_active_question($id);
  $answers = get_answer_choices($id);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
      <script src="../JavaScript/inclass.js"></script>
  </head>

  <body>
    <?php include 'instructor_navigation.php';?>
    <div class="border">
      <?php include 'header.php';?>
      <div id="flexContainer">
        <h1>Live Statistics</h1>
        <div class="question">
          <?php
          echo $activate_start;
          if (isset($q[0])) {
  		        $question = $q[0];
              $answers = get_question_answers($id);
              echo "<h2>";
              echo $question['QuestionId'];
              echo "</h2>";
              echo "<p>";
              echo $question['QuestionText'];
              echo "</p>";
            }
          ?>

          <h2 id="timer"><time>00:00:00</time></h2>
        </div>
        <canvas id="live_stats" width="300" height="300"></canvas>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $id?>">
          <?php
            foreach($answers as $answers){
              echo "<input type=\"hidden\" name=\"answers\"
                value=\"{$answers['AnswerText']}\">";
            }
           ?>
          <button type="sumbit" id="deactivate"
              formaction="confirmDeactivate.php">Deactivate</button>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
