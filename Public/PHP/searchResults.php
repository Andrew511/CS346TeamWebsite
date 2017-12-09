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
      print_r($section);
      echo "</pre>";
      $kid = [];
      $scoreid = [];
      $pid = [];
      $sctid = [];
      include_once 'search_functions.php';

      echo "<pre>";
      print_r($sctid);
      echo "</pre>";
      $questionId = [];
      if(!empty($kid)){
      //  $questionId[] = $kid;
      array_push($questionId, $kid);
      }
      if(!empty($scoreid)){
      //  $questioId[] = $scoreid;
      array_push($questionId, $scoreid);
      }
      if(!empty($pid)){
      //  $questionId[] = $pid;
      array_push($questionId, $pid);
      }
      if(!empty($sctid)){
      //  $questionId[] = $sctid;
      array_push($questionId, $sctid);
      }
      echo "Section arr";
      echo "<pre>";
      print_r($sctid);
      echo "</pre>";
      $q = [];
    $questionId = array_unique($questionId);
    echo "<pre>";
    print_r($questionId);
    echo "</pre>";
      foreach($questionId as $key=>$value){
        foreach($questionId[$key] as $k=>$v){
          $id = $questionId[$key][$k]['QuestionId'];
          $result = search_questions($id);
        //  print_r($result);
          if($result){
          //  $q[] = $result;
            array_push($q, $result);
          }
        }
      }

      echo "<pre>";
      print_r($q);
      echo "</pre>";
      echo "<form method=\"post\" action=\"showQuestionResult.php\"
              target=\"blank\">";
      echo "<select name=\"results\">";

      if(!empty($q)){
        foreach($q as $q2){
          //echo $q2;
        //  echo $value;
        //  print_r($q2);
          foreach($q2 as $r){
            echo $r;
            print_r($r);
            echo "<option value=\"";
            echo $r['QuestionId'];
            echo "\">Q";
            echo $r['QuestionId'];
            echo ": Section ";
            echo $r['Section'];
            echo ": ";
            echo $r['Description'];
            echo "</option>";
          }
          }

      }
      else {
        echo "<option>No Results Matching Criteria</option>";
      }
      echo "</select>";
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
