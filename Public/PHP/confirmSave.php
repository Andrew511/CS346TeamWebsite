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
              if(!check_id($_POST['ID'])){
                add_question($_POST['ID'], $_POST['status'], $_POST['types'],
                              $_POST['question_text'], $_POST['points'], $_POST['section']);

                $keywords = $_POST['keywords'];
                $keywords_arr = array();
                $keywords_arr = explode(",", $keywords);
                foreach($keywords_arr as $keyword){
                  insert_keywords($_POST['ID'], $keyword);
                }
                $answer = $_POST['answer'];
                foreach($_POST['answer'] as $item){
                  if(count($answer) > 1){
                    //still need to update the answers table
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
