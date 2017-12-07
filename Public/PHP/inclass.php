<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $q = get_active();
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
  </head>

  <body>
    <?php include 'instructor_navigation.php';?>
    <div class="border">
      <?php include 'header.php';?>
      <div id="flexContainer">
        <h1>Live Statistics</h1>
        <div class="question">
        

        </div>
        <canvas id="live_stats" width="300" height="300"></canvas>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
