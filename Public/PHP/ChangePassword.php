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
      <?php include 'student_navigation.php';?>
      <div class="border">
        <?php include 'header.php' ?>
        <div class="flexContainer">
          <div class="changePwContainer">
            <form action="pwConfirmation.html">
              <div class="pwBox">
                <label>
                  Username:
                  <input type="text" name="username" value="doej65" readonly><br/>
                </label>
                <label>
                  Old Password:
                  <input type="text" name="oldPassword" required><br/>
                </label>
                <label>
                  New Password:
                  <input type="text" name="newPassword" required><br/>
                </label>
                <label>
                  Confirm New Password:
                  <input type="text" name="confirmPassword" required><br/>
                </label>
                <p>
                  Your password <strong>must</strong> meet all three requirements
                  below:
                </p>
                <ol>
                  <li>It must contain AT LEAST 8 characters.</li>
                  <li>It may NOT appear in Cain &amp; Abel's dictionary of common
                    passwords.</li>
                  <li>It may NOT contain your username as a substring</li>
                </ol>
                <p class="centered">
                  <input type="submit" value="Change Password"/>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include 'footer.php';?>
    </div>
  </body>
</html>
