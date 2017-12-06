
<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['question_list'];
    $q = edit_question($id);
    foreach($q as $q){
      "{$q['Description']}, {$q['Section']}, {$q['PointsAvailable']},
        {$q['QuestionText']}, {$q['QuestionType']}";
    }
    $keywords = get_keyword_list($id);
    $answers = get_answer_choices($id);
    $correct = get_correct_answer_edit($id);
    $array = array();
    $i = 0;
    foreach($correct as $correct){
      $array[$i] = trim("{$correct['AnswerText']}");
      $i++;
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
    <script src="../JavaScript/add_question.js"></script>
  </head>
  <body>
    <div>
      <?php include_once 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <?php include_once 'header.php'?>
      <div id="flexContainer">
        <div class="question">
          <form action ="confirm_update.php" method="post">
            <h1>Add Question</h1>
            <p>Question ID: </p>
            <input type="number" name="ID" value="<?php echo $id; ?>"><br/>
            <p>Description</p>
            <input type="text" name="description" value="<?php echo $q['Description']?>"/>
            <p>Keywords (Please separate keywords by ,)</p>
            <input type="text" name="keywords" value="<?php
            $count = count($keywords);
            foreach($keywords as $keywords){
              echo "{$keywords['Keyword']}";
              if($count>1){
                echo ", ";
              }
              $count--;
            }
            ?>"/>
            <br/>
            <p>Book Section:</p>
            <input type="text" name="section" value="<?php echo $q['Section'];?>"/>
            <p>Points</p>
            <input type="number" name="points" value="<?php echo $q['PointsAvailable']; ?>"/>
            <div>
              <p>Type your question below:</p>
              <textarea class="questionText" name="question_text">
<?php echo $q['QuestionText'];?>
</textarea>
              <select id="answerTypes" name="types">
                <?php
                if($q['QuestionType'] === "multiple"){
                  echo "<option value=\"multiple\" selected>Multiple Choice</option>";
                }
                else {
                  echo "<option value=\"radio\">Multiple Choice</option>";
                }
                if($q['QuestionType'] === "checkbox"){
                  echo "<option value=\"checkbox\" selected>Checkboxes</option>";
                }
                else {
                  echo "<option value=\"checkbox\">Checkboxes</option>";
                }
                if($q['QuestionType'] === "dropdown"){
                  echo "<option value=\"dropdown\" selected>Dropdown</option>";
                }
                else {
                  echo "<option value=\"dropdown\">Dropdown</option>";
                }
                if($q['QuestionType'] === "short"){
                  echo "<option value=\"short\" selected>Short answer</option>";
                }
                else {
                  echo "<option value=\"short\">Short answer</option>";
                }
                 ?>

              </select>
              <div id="answer_options">
                Type the answer options and select the correct answer.
                <br/><p>
                  <?php
                  if($q['QuestionType'] === "multiple") {
                    foreach($answers as $answers){
                      $a = trim("{$answers['AnswerText']}");
                      if($a == $array[0]){
                        echo "<input type=\"radio\" name=\"answer\" value=\"";
                        echo "{$answers['AnswerText']}";
                        echo "\" checked\>";
                        echo "<textarea name=\"answer_choices\">";
echo "{$answers['AnswerText']}";
                        echo "</textarea>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo "{$answers['AnswerText']}";
                        echo "\"\>";
                      }
                      else {
                        echo "<input type=\"radio\" name=\"answer\" value=\"";
                        echo "{$answers['AnswerText']}";
                        echo " \"\>";
                        echo "<textarea name=\"answer_choices\">";
echo "{$answers['AnswerText']}";
                        echo "</textarea>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo "{$answers['AnswerText']}";
                        echo "\"\>";
                      }
                    }
                  }
                  else if($q['QuestionType'] === "checkbox") {
                    foreach($answers as $answers){
                      echo $answers;
                      if($answers['Correct'] === 1){
                        echo "<input type=\"checkbox\" name=\"answer[]\" value=\"";
                        echo $a['AnswerText'];
                        echo " checked\>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo $a['AnswerText'];
                        echo "\>";
                      }
                      else {
                        echo "<input type=\"checkbox\" name=\"answer[]\" value=\"";
                        echo $a['AnswerText'];
                        echo "\>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo $a['AnswerText'];
                        echo "\>";
                      }
                    }
                  }
                  else if($q['QuestionType'] === "dropdown") {
                    echo "<select name=\"answer[]\" id=\"answer\" multiple>";
                    foreach($answers as $a){
                      if($a['Correct'] === 1){
                        echo "<option value=\"";
                        echo $a['AnswerText'];
                        echo " selected>";
                        echo $a['AnswerText'];
                        echo "</option>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo $a['AnswerText'];
                        echo "\>";
                      }
                      else {
                        echo "<option value=\"";
                        echo $a['AnswerText'];
                        echo " selected>";
                        echo $a['AnswerText'];
                        echo "</option>";
                        echo "<input type=\"hidden\" name=\"choices[]\" value=\"";
                        echo $a['AnswerText'];
                        echo "\>";
                      }
                    }
                  }
                  else if($q['QuestionType'] === "short"){
                    echo "<textarea name=\"answer\" id=\"answer\">";
                    $count = count($answers);
                    foreach($answers as $a){
                      echo $a['AnswerText'];
                      $count--;
                      if($count > 1){
                        echo " | ";
                      }
                    }
                  }
                   ?>
              </div>
              <p>
              <button type="button" id="add_answer">Add more answer choices</button>
              </p>
              <button type="submit" name="status" value="1">Save as Draft</button>
              <button type="submit" name="status" value="2">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
