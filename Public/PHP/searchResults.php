<?php

  require_once('../Private/PHP/initialize.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // this is a POST request and thus a form submission: process the form data
    
    /* to be completed:
       1) retrieve the question based on the form data
       2) disconnect from the database
    */
    
    $q = search($_POST['keywordSearch'], $_POST['section'], 
			    $_POST['score'], $_POST['pointsAvailable']); 
	if($q == null)
	{
	echo "No Result, please modify your seach.";
	}
	

  } else {
    // this is a GET request: no form data to process

    /* to be completed:
       null out the question to be used below
    */
    
    $q = NULL;
    
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
          <div class="searchContainer">
            <h1>Search Results</h1>
            <div>
			<?php
			{ echo "<ul>
					<li>Keyword: $_POST['keyword']</li>
					<li>Section: $_POST['section']</li>					
					<li>Your score: $_POST['score']</li>
					<li>Total score: $_POST['pointsAvailable']</li>"}
			foreach($q as $key => $value)
				{echo "<li>Question id: $q['QuestionId']</li>
				       <li>Question : $q['QuestionText']</li>"}
			echo {"</ul>"}
			  ?>
            </div>
          </div>
        </div>
	</div>	
    <?php include 'footer.php';?>
  </body>
</html>
