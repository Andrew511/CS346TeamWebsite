<?php
  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
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
    <div>
      <?php include_once 'instructor_navigation.php';?>
    </div>
    <div class="border">
      <?php include_once 'header.php'?>
      <div id="flexContainer">
        <div class="confirm">
          <p>
            <?php include_once 'add.php'; ?>
          </p>
        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
