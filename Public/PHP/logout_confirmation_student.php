<?PHP
	session_start()  ;
	$dir = realpath(__DIR__ . '/../..').'/Private/PHP' ;
	$pdir = dirname(__FILE__) ;
	$temp[] = preg_split("[/]" , $pdir) ;
	$pubDir = "";
	for($i = 3 ; $i < sizeof($temp[0]) ; $i++)
	{

	$pubDir = $pubDir . "/" . $temp[0][$i] ;

	}
	require_once($dir.'/initialize.php') ;
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
      <div id="flexContainer">
        <div class="confirm">
          <form action="logout.html" method="post">
            <p> Are you sure you want to logout?</p>
            <input type="submit" value="Yes, I'm sure!"/>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
