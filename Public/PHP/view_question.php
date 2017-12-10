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
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$id = $_POST['question_list'];
		$question = view_question($id);
		$answers = get_question_answers($id);
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
    <?php include_once 'instructor_navigation.php';?>
    <div class="border">
      <?php include_once 'header.php';?>
      <div id="flexContainer">
        <h1>Review Question</h1>
        <div class="question">
          <?php
              echo "<h2>";
              echo $question[0]['QuestionId'];
              echo "</h2>";
              echo "<p>";
              echo $question[0]['QuestionText'];
              echo "</p>";

          echo "<p>Answer Options:</p>";
          echo "<ul>";
          if($question[0]['QuestionType'] === "short"){
            foreach($answers as $answers){
              echo "<li>";
              echo "{$answers["ShortAnswer"]}";
              echo "</li>";
            }
          }
          else{
            foreach($answers as $answers){
              echo "<li>";
              echo "{$answers["AnswerText"]}";
              echo "</li>";
            }
          }
          echo "</ul>";
          ?>
        </div>
        <form method="post">
          <?php
          echo "<input type=\"hidden\" name=\"question_list\" value=\"";
          echo $question[0]['QuestionId'];
          echo "\">"
          ?>
          <button type="submit" formaction="inclass.php">Activate Question</button>
        </form>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
