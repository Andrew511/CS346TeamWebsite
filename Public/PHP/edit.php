
<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
  $id = $_POST['question_list'];
  $q = edit_question($id);
  $keywords = get_keyword_list($id);
  $answers = get_answer_choices($id);
  $keyword_string;
  foreach($keywords as $k){
    $string = $string . "," . $k;
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
          <?php
            if($_POST['status'] === "edit"){
              echo "
                <form action =\"confirmSave.php\" method=\"post\">
                  <h1>Edit Question</h1>
                  <p>Question ID: </p>
                  <input type=\"number\" name=\"ID\" value=\"$id\"><br/>
                  <p>Description</p>
                  <input type=\"text\" name=\"description\" value=\"";
                  echo $q['Description'];
                  echo "\"/>
                  <p>Keywords (Please separate keywords by ,)</p>
                  <input type=\"text\" name=\"keywords\" value=\"";
                  echo $string;
                  echo "\"/><br/>
                  <p>Book Section:</p>
                  <input type=\"text\" name=\"section\" value=\"";
                  echo $q['Section'];
                  echo "\"/>
                  <p>Points</p>
                  <input type=\"number\" name=\"points\" value=\"";
                  echo $q['PointsAvailable'];
                  echo "\"/>
                  <div>
                    <p>Type your question below:</p>
                    <textarea class=\"questionText\" name=\"question_text\">";
echo $q['QuestionText'];
                  echo "</textarea>
                    <select id=\"answerTypes\" name=\"types\">";
                    if($q['QuestionType'] === radio){
                      echo "<option value=\"radio\" selected>Multiple Choice</option>";
                    }
                    else{
                      echo"<option value=\"radio\">Multiple Choice</option>";
                    if($q['QuestionType'] === checkbox){
                      echo "<option value=\"checkbox\" selected>Checkboxes</option>";
                    }
                    else{
                      echo "<option value=\"checkbox\">Checkboxes</option>";
                    }
                    if($q['QuestionType'] === 'dropdown'){
                      echo "<option value=\"dropdown\" selected>Dropdown</option>";
                    }
                    else{
                      echo "<option value=\"dropdown\">Dropdown</option>";
                    }
                    if($q['QuestionType'] === 'short'){
                      echo "<option value=\"short\" selected>Short answer</option>";
                    }
                    else {
                      echo "<option value=\"short\">Short answer</option>";
                    }
                    echo "
                    </select>
                    <div id=\"answer_options\">
                      Type the answer options and select the correct answer.
                      <br/>

                    </div>
                    <p>
                    <button type=\"button\" id=\"add_answer\">Add more answer choices</button>
                    </p>
                    <button type=\"submit\" name=\"status\" value=\"1\">Save as Draft</button>
                    <button type=\"submit\" name=\"status\" value=\"2\">Save</button>
                  </div>
                </form>";
            }
/*            elseif($_POST['status'] === "delete"){
              delete_question($id);
            }
*/
          ?>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
