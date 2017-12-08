<?php
	session_start()  ;
	$dir = '/var/www/students/team6/CS346TeamWebsite/Private/PHP' ;
	$pdir = '/students/team6/CS346TeamWebsite/Public/PHP' ;
	require_once($dir.'/initialize.php') ;
	global $db ;
	if(!isset($_SESSION['ID']))
	{
		header("Location:" . $pdir . "/Login.php") ;
	}
	else
	{
		$UN = $_SESSION['username'] ;
		$id = $_SESSION['ID'] ;
		$role = $_SESSION['role'] ;
	}
  define("SITE_ROOT", "/var/www/students/team6/CS346TeamWebsite");
  require_once(SITE_ROOT.'/Private/PHP/initialize.php');

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
	<meta name="viewport" content="width=device-width, initial-scale=1" />
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
					echo "<ul><li>Keyword:" ;
					echo "{$_POST['keyword']}";
					echo"</li><li>Section:";
					echo "{$_POST['section']}";
					echo "</li><li>Your score:";
					echo "{$_POST['score']}";
					echo "</li><li>Total score:";
					echo "{$_POST['pointsAvailable']}";
					echo"</li>";
				foreach($q as $q)
			   {
				    echo "<li>Question id:";
					echo "{$q['QuestionId']}";
					echo "</li><li>Question :";
					echo "{$q['QuestionText']}";
					echo "</li>";
				}
					echo "</ul>";
				
			  ?>
            </div>
          </div>
        </div>
	</div>	
    <?php include 'footer.php';?>
  </body>
</html>
