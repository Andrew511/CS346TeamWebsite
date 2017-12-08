<?php
session_start()  ;
$dir = realpath(__DIR__ . '/../..').'/Private/PHP' ;
$pdir = dirname(__FILE__) ;
$temp[] = preg_split("[/]" , $pdir) ;
$pubDir = "";
for($i = 3 ; $i < sizeof($temp[0]) ; $i++)
{
	$pubDir = $pubDir . "/" . $temp[0][$i] ;
}
require_once($dir.'/initialize.php') ;
global $db ;
if(!isset($_SESSION['ID']))
	{
		header("Location:" . $pubDir . "/Login.php") ;
	}
	else
	{
		$UN = $_SESSION['username'] ;
		$id = $_SESSION['ID'] ;
		$role = $_SESSION['role'] ;
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>
    <div>
      <?php include_once 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <?php include_once 'header.php'?>
      <div id="flexContainer">
        <div class="question">
          <form action ="confirmSave.php" method="post">
            <h1>Add Question</h1>
            <p>Question ID: </p>
            <input type="number" name="ID"><br/>
            <p>Description</p>
            <input type="text" name="description"/>
            <p>Keywords (Please separate keywords by ,)</p>
            <input type="text" name="keywords"/><br/>
            <p>Book Section:</p>
            <input type="text" name="section"/>
            <p>Points</p>
            <input type="number" name="points"/>
            <div>
              <p>Type your question below:</p>
              <textarea class="questionText" name="question_text"></textarea>
              <select id="answerTypes" name="types">
                <option value="multiple">Multiple Choice</option>
                <option value="checkbox">Checkboxes</option>
                <option value="dropdown">Dropdown</option>
                <option value="short">Short answer</option>
              </select>
              <p>
                Type the answer options and select the correct answer.
              </p>
              <div id="answer_options">
              </div>
              <p>
              <button type="button" id="add_answer">Add more answer choices</button>
              <button type="button" id="reset">Reset Answers</button>
              </p>
              <button type="submit" name="submit" value="1">Save as Draft</button>
              <button type="submit" name="submit" value="2">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
