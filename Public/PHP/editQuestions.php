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
        <h1>Questions in Directory</h1>
        <form>
          <div id="directoryQuestions">
            <select>
              <!-- php query to generate list goes here -->
            </select>
          </div>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
