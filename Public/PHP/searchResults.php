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

    if(isset($_POST['keywordSearch'])){
      $keyword = $_POST['keywordSearch'];
    }
    else{
      $keyword = 'Null';
    }
    if(isset($_POST['section'])) {
      $section = $_POST['section'];
    }
    else{
      $section = "Null";
    }
    if(isset($_POST['score'])){
      $score = $_POST['score'];
    }
  	else{
      $score = "Null";
    }
    if(isset($_POST['pointsAvailable'])){
      $pointsAv = $_POST['pointsAvailable'];
    }
  	else{
      $pointsAv = "Null";
    }
  } else {
    $q = NULL;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../CSS/p1indiva.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet"/>
  </head>

  <body>
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div class="flexContainer">
          <div class="searchContainer">
            <h1>Search Results</h1>
            <div>
			<?php
      $kid = [];
      $scoreid = [];
      $pid = [];
      $sctid = [];
      include_once 'search_functions.php';
      $questionId = [];
      if(!empty($kid)){
      array_push($questionId, $kid);
      }
      if(!empty($scoreid)){
      array_push($questionId, $scoreid);
      }
      if(!empty($pid)){
      array_push($questionId, $pid);
      }
      if(!empty($sctid)){
      array_push($questionId, $sctid);
      }

      if(is_array($questionId)){
        $questionId = array_unique($questionId, SORT_REGULAR);
      }

      $a = [];
      for($i = 0; $i < sizeof($questionId); $i++){
        for($j = 0; $j < sizeof($questionId[$i]); $j++){
          for($k = 0; $k < sizeof($questionId[$i][$j]); $k++ ){
            if(!in_array($questionId[$i][$j][$k]['QuestionId'], $a)){
              array_push($a, $questionId[$i][$j][$k]["QuestionId"]);
            }
          }
        }
      }

      asort($a);

    echo "<form method=\"post\" action=\"showQuestionResult.php\"
            target=\"blank\">";
    echo "<select name=\"results\">";

    for($i = 0; $i < sizeof($a); $i++){
      $qid = $a[$i];
      $result = search_questions($qid);
      foreach($result as $result){
        echo "<option value=\"";
        echo "{$result['QuestionId']}";
        echo "\">";
        echo "{$result['QuestionId']}";
        echo ": Section ";
        echo "{$result['Section']}";
        echo ", ";
        echo "{$result['Description']}";
        echo "</option>";
      }
    }
    ?>
  </select>

        <div>
        <input type="submit" value="View">
        </div>
      </form>

          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
