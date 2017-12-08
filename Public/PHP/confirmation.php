 <?php
	require_once("../Server/Services/article-table.php");
	require_once("../Server/DB/config.php");
	$db = new DB();	
	$db->connect();
	$articleTable = new ArticleTable($db);
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$author = 'a';
		 $articleTable->insert($_POST['articleTitle'],$author,$_POST['textbox'],
				$_POST['gameTitle'],$_POST['consoleTitle'],$_POST['genreTitle'],$_POST['tagTable']);
	 }
	 else
	 { echo "error insert your article at database level";
	 }
	 ?>
	 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title> GamingWiki</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css"/>
	<link rel = "stylesheet" type = "text/css" href = "articleCreator.css"/>
</head>
<body>
<?php 
		if(session_id() == '') {
			session_start();
		}
	?>
	
	<?php require_once('./initHeader.php') ?>
	<div id = "main">
	<?php echo $_POST['textbox']; ?>
	</div>
	<?php require_once('./initFooter.php') ?>
</body>
</html>