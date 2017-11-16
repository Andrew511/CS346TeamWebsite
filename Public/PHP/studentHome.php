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
    require_once(studentnavigation.php);
    <div class="border">
      require_once(header.php);
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
    <div class="footer">
      <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
          <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
        </a>
        <a href="http://validator.w3.org/check/referer">
          <img src="../Images/HTML5_Logo.png"
            width="63" height="64" alt="HTML5 Powered" title="\'Valid\' HTML" />
        </a>
      </p>
    </div>
  </body>
</html>
