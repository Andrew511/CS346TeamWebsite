
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
    $string = "";
    foreach($keywords as $keywords){
      "{$keywords['Keyword']}";
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
  <!--  <script type="text/javascript" src="../JavaScript/add_question.js"></script> -->
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
            <input type="text" name="keywords"
            <?php
            /*
              this code doesn't work yet and will need to fix
            */
              echo "value=\" \"";
              $count = count($keywords);
                foreach($keywords as $keywords){
                  echo $keywords['Keyword'];

                $count--;
                if($count > 1){
                  echo ", ";
                }
                echo "\"/>";
              }
            ?>/><br/>
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
                if($q['QuestionType'] === "radio"){
                  echo "<option value=\"radio\" selected>Multiple Choice</option>";
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
                <br/>
                <?php include_once 'process_edit.php'; ?>
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
