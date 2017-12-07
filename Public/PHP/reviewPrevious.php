<?php

  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');

  /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // this is a POST request and thus a form submission: process the form data
    
    /* to be completed:
       1) retrieve the question based on the form data
       2) disconnect from the database
    */
    $q = get_question_list();
	$points = get_question_list();
	$p = display_S_table();
	$k = display_K_table();
  /* else {
    // this is a GET request: no form data to process

    /* to be completed:
       null out the question to be used below
    */
    
   /* $q = NULL;
	$p = NULL;
	$k = NULL;
    
  }*/

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
			
				
                <select name="keywordSearch[]" size="4" class="options"
                  multiple>
				  <?php
				  foreach ($k as $k)
							{
							echo "<option value=\"";
							echo "{$k['Keyword']}";
							echo "\">";
							echo "{$k['Keyword']}";
							echo "</option>";
							}
							?>               
                </select>
                <select name="section" size="4" class="options"
                  multiple>
				  <?php foreach ($q as $q)
							{
							echo "<option value=\"";
							echo "{$q['Section']}";
							echo "\">";
							echo "{$q['Section']}";
							echo "</option>";
							}
							?>        
                </select>
                <select name="pointsAvailable" size="4" class="options"
                  multiple>
				  <?php  foreach ($points as $points)
							{
							echo "<option value=\"";
							echo "{$points['PointsAvailable']}";
							echo "\">";
							echo "{$points['PointsAvailable']}";
							echo "</option>";
							}
							?>
                </select>
                <select name="score" size="4" class="options"
                  multiple>
				  <?php 
						foreach ($p as $p)
						{
							echo "<option value=\"";
							echo "{$p['Score']}";
							echo "\">";
							echo "{$p['Score']}";
							echo "</option>";
							}
							?>
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
