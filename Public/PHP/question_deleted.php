<?php
  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
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
    <div>
      <?php include 'instructor_navigation.php';?>
      <div class="border">
        <?php include 'header.php';?>
        <div class="flexContainer">
          <div class="changePwContainer">
            <div class="confirm">
                <p>
                  <?php
                    delete_answers($id);
                    delete_keywords($id);
                    delete_question($id);
                  ?>
                </p>
            </div>
          </div>
        </div>
      </div>
      <?php include 'footer.php';?>
    </div>
  </body>
</html>
