<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
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
          <?php
          if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $scores = get_scores($_POST['stats']);
            $id = $_POST['stats'];
            $total_points = $_POST['total_points'];
          }
          if(empty($scores)){
            echo "There are no student statistics available for this day.";
          }
          ?>

            <?php

            if(!empty($scores)){
              echo "<table>";
                echo "<tr>";
                echo  "<th>Last Name</th>";
                echo "<th>First Name</th>";
                echo "<th>Username</th>";
                echo "<th>Q Id</th>";
                echo "<th>Points Earned</th>";
                echo "<th>Total Points</th>";
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
    <?php include 'footer.php';?>
  </body>
</html>
