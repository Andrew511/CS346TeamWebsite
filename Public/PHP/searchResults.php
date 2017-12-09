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

      echo "<pre>";
      print_r($keyword);
      echo "</pre>";
      echo "<pre>";
      print_r($section);
      echo "</pre>";
      echo "<pre>";
      print_r($score);
      echo "</pre>";
      echo "<pre>";
      print_r($pointsAv);
      echo "</pre>";

      $kid = [];
      $scoreid = [];
      $pid = [];
      $sctid = [];
      include_once 'search_functions.php';

      echo "<pre>";
      print_r($kid);
      echo "</pre>";
      echo "<pre>";
      print_r($scoreid);
      echo "</pre>";
      echo "<pre>";
      print_r($pid);
      echo "</pre>";
      echo "<pre>";
      print_r($sctid);
      echo "</pre>";

      $questionId = [];
      if(!empty($kid)){
        $questionId[] = $kid;
      }
      if(!empty($scoreid)){
        $questioId[] = $scoreid;
      }
      if(!empty($pid)){
        $questionId[] = $pid;
      }
      if(!empty($sctid)){
        $questionId[] = $sctid;
      }
    //  $questionId = array_unique(array_merge($kid, $scoreid, $pid, $sctid));
    $questionId = array_unique($questionId, SORT_REGULAR);
      echo "<pre>";
      print_r($questionId);
      echo "</pre>";
/*
      $questions_unique = array_unique($question, SORT_REGULAR);
      echo "<pre>";
      print_r($questions_unique);
      echo "</pre>";
      foreach($questions_unique as $key=>$value){
        if(empty($value)){
          unset($questions_unique[$key]);
        }
      }

      echo "<form action=\"showQuestionResult.php\" method=\"post\">";
      echo "<select id=\"results\" name=\"results\">";
      if(empty($questions_unique))
      {
        echo "<option>No Results Matching Criteria</option>";
      }
      else{
        $questions_unique = array_unique($questions_unique[0], SORT_REGULAR);
          foreach($questions_unique as $key=>$value){
            echo "<option value=\"$questions_unique[$key]['QuestionId']\">Q";
            echo $questions_unique[$key]['QuestionId'];
            echo ": Section ";
            echo $questions_unique[$key]['Section'];
            echo ": ";
            echo $questions_unique[$key]['Description'];
            echo "</option>";
        }
      }
      echo "</select>";*/
      ?>
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
