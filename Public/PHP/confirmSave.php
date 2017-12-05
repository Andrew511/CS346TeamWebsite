<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
  $types = $_POST['types'];
  $id = $_POST['ID'];
  $status = $_POST['status'];
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
    <div>
      <?php include_once 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <div id="pageHeader">
        <h1 id="headerTitle"><span id="mainU">U</span>W<span id="mainO">O
        </span><span id="mainW"> W</span>eb<span id="mainC">C</span>licker</h1>
      </div>
      <div id="flexContainer">
        <div class="confirm">
          <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
              if(!check_id($id)){
                add_question($id, $status, $types, $_POST['question_text'],
                $_POST['points'], $_POST['section'], $_POST['description']);

                $keywords = $_POST['keywords'];
                $keywords_arr = array();
                $keywords_arr = explode(",", $keywords);
                foreach($keywords_arr as $keyword){
                  insert_keywords($id, $keyword);
                }
                if($types === 'radio'){
                  $answer_options = $_POST['answer'];
                  $correct = 1;
                  $number = 1;
                  add_answer($id, $answer_options, $correct, $number);
                }
                elseif ($types === 'checkbox'){
                  foreach($_POST['answer'] as $a){
                      add_answer($id, $a, 1, count($_POST['answer']));
                    }
                }
                elseif ($types === 'dropdown'){
                  foreach($_POST['answer'] as $a){
                      add_answer($id, $a, 1, count($_POST['answer']));
                    }
                }
                elseif ($types === 'short'){
                  $answer = $_POST['answer'];
                  $answer_arr = array();
                  $answer_arr = explode("|", $answer);
                  foreach($answer_arr as $a){
                    add_short($id, $a);
                  }
                }

                echo "Your question was successfully added to the database!";
              }
            }
          ?>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
