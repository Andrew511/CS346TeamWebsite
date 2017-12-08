
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
  $q = get_question_list();
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
  </head>

  <body>
    <?php include_once 'instructor_navigation.php';?>
    <div class="border">
      <?php include_once 'header.php';?>
      <div id="flexContainer">
        <h1>Questions in Directory</h1>
        <form method="post">
          <div id="directoryQuestions">
            <select id="question_list" name="question_list">
              <?php
                if(empty($q)){
                  echo "<option>No Questions Available</option>";
                }
                else {
                  foreach($q as $q){
                    echo "<option value=\"{$q['QuestionId']}\">
                      {$q['QuestionId']}: {$q['Description']}</option>";
                  }
                }
              ?>
            </select>
            <button type="submit" formaction="edit.php">Edit</button>
            <button type="submit" formaction="deleteConfirm.php">Delete</button>
          </div>
        </form>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
