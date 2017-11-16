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
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div id="flexContainer">
        <div id="errorMessage">
          Let the instructor know that there are no active questions in the
          database.
        </div>
        <div id="studentHomePage">
          <p>
            Are you currently in class? Has the instructor activated the next
            question?<br/>
            Then click this button right away.
          </p>
          <form action="showQuestion.html" id="showQuestion" class="questions">
            <div>
              <input type="submit" value="Show Question"/>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
