<?php if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $role = $_POST["role"];
  }
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>UWO WebCLICKER</title>
    <link rel="stylesheet" type="text/css" href="../p1indiva.css" />
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface"
      rel="stylesheet" />
    <?php
      if($role == 'student') {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=studentHome.php\">";
      }
      else if ($role == 'instructor') {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=instructorHome.php\">";
      }
    ?>

  </head>
</html>
