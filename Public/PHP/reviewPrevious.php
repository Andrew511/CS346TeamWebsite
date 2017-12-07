<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // this is a POST request and thus a form submission: process the form data
    
    /* to be completed:
       1) retrieve the question based on the form data
       2) disconnect from the database
    */
    
    $q = get_question_list();   
		 
	  
	$p = display_S_table();
		

	$k = display_K_table();
	
    }

   else {
    // this is a GET request: no form data to process

    /* to be completed:
       null out the question to be used below
    */
    
    $q = NULL;
	$p = NULL;
	$k = NULL;
    
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
    <?php include 'student_navigation.php';?>
    <div class="border">
      <?php include 'header.php' ?>
      <div class="flexContainer">
          <div class="searchContainer" id="reviewSearch">
            <form action="searchResults.php" method="post">
              <div id="keyword">
              </div>
              <div id="searchOptions">
                <select name="keywordSearch" size="4" class="options"
                  multiple>
				  <?php foreach ($k as $k => $value)
							echo $k['Keyword'];
							//echo "<option>$k['Keyword']</option>";
							?>               
                </select>
                <select name="section" size="4" class="options"
                  multiple>
				  <?php foreach ($q as $key => $value)
								echo $q['Section'];
							//echo "<option> $q['Section']</option>";
							?>        
                </select>
                <select name="pointsAvailable" size="4" class="options"
                  multiple>
				  <?php foreach ($q as $key => $value)
				  echo $q['PointsAvailable'];
							//echo "<option> $q['PointsAvailable']</option>";
							?>
                </select>
                <select name="score" size="4" class="options"
                  multiple>
				  <?php array_unique($p);
						foreach ($p as $key => $value)
						echo $$p['Score']k;
							//echo "<option> $p['Score']</option>";?>
                  <option></option>
                </select>
                <input type="submit" value="Search" id="searchButton"/>
              </div>
            </form>
          </div>
        </div>
        </div>
	</div>	
    <?php include 'footer.php';?>
  </body>
</html>
