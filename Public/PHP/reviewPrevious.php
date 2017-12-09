<?php

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
global $db ;
if(!isset($_SESSION['ID']))

  {
    header("Location:" . $pubDir . "/Login.php") ;
  }
  else
  {
    $UN = $_SESSION['username'] ;
    $id = $_SESSION['ID'] ;
    $role = $_SESSION['role'] ;
  }
$q = display_SEC_table();
$points = display_PAV_table();
$p = display_S_table();
$k = display_K_table();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
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


                <select name="keywordSearch[]" id="keywordSearch" size="4" class="options"
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
                <select name="section[]" id="section" size="4" class="options"
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
                <select name="pointsAvailable[]" id="pointsAvailable" size="4" class="options"
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
                <select name="score[]" id="score" size="4" class="options"
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
