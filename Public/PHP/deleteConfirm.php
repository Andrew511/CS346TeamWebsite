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
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['question_list'];
  }
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
    <div>
      <?php include_once 'instructor_navigation.php';?>
      <div class="border">
        <?php include_once 'header.php';?>
        <div class="flexContainer">
          <div class="changePwContainer">
            <div class="confirm">
              <form method="post" action="question_deleted.php">
                <p>
                  Are you sure you want to delete question <?php echo $id; ?>?
                </p>
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <input type="submit" value="Yes I'm sure!"/>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include_once 'footer.php';?>
    </div>
  </body>
</html>
