
<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['question_list'];
    $q = edit_question($id);
    $keywords = get_keyword_list($id);
    $answers = get_answer_choices($id);
    $keyword_string;
    foreach($keywords as $k){
      $string = $string . "," . $k;
    }
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
    <script type="text/javascript" src="../JavaScript/add_question.js"></script>
  </head>
  <body>
    <div>
      <?php include 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <div id="pageHeader">
        <h1 id="headerTitle"><span id="mainU">U</span>W<span id="mainO">O
        </span><span id="mainW"> W</span>eb<span id="mainC">C</span>licker</h1>
      </div>
      <div id="flexContainer">
        <div class="question">

        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>