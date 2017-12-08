<?php
define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
require_once('../../Private/PHP/initialize.php');

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
        <div class="confirm">
          <?php
            if(deactivate_all()){
              echo "All questions were successfully deactivated!";
            }
           ?>

        </div>
      </div>
    </div>
    <?php include_once 'footer.php';?>
  </body>
</html>
