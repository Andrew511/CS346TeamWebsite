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
  $id = $_POST['id'];
  $end = date('Y/m/d h:i:s a' , time());

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
  </head>

  <body>
    <?php include 'instructor_navigation.php';?>
    <div class="border">
      <?php include 'header.php';?>
      <div id="flexContainer">
        <h1>Daily Statistics</h1>
        <div class="tables">
          <?php
          if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $scores = get_scores($_POST['stats']);
            $id = $_POST['stats'];
            update_average($id);
            $total_points = $_POST['total_points'];
            $avg = get_average($id);
          }
          if(empty($scores)){
            echo "There are no student statistics available for this day.";
          }
          else{
            echo "<p><strong>Class Average</strong>: ";
            echo "{$avg[0]['ClassAverage']}";
            echo "</p>";

            echo "<table>";
              echo "<tr>";
              echo  "<th>Last Name</th>";
              echo "<th>First Name</th>";
              echo "<th>Username</th>";
              echo "<th>Q Id</th>";
              echo "<th>Total Points</th>";
              echo "<th>Points Earned</th>";
            echo "</tr>";
            foreach($scores as $scores){
              echo "<tr>";
              echo "<td>";
              echo "{$scores['FirstName']}";
              echo "</td>";
              echo "<td>";
              echo "{$scores['LastName']}";
              echo "</td>";
              echo "<td>";
              echo "{$scores['UserId']}";
              echo "</td>";
              echo "<td>";
              echo $id;
              echo "</td>";
              echo "<td>";
              echo $total_points;
              echo "</td>";
              echo "<td>";
              echo "{$scores['Score']}";
              echo "</td>";
            }
            echo "</table>";
          }
          ?>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
