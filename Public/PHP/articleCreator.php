<?php
	require_once("../Server/Services/game-table.php");
	require_once("../Server/Services/article-table.php");
	require_once("../Server/Services/console-table.php");
	require_once("../Server/Services/genre-table.php");
	require_once("../Server/DB/config.php");
	$db = new DB();	
	$db->connect();
	$genreTable = new GenreTable($db);
	$genre = $genreTable->getAll();
	$gameTable = new GameTable($db);
	$game = $gameTable->getAll();
	$consoleTable = new ConsoleTable($db);
	$console = $consoleTable->getAll();	 
	$articleTable = new ArticleTable($db);
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
	<table id = "table">
		<tr>
			<td class = "tableCell">
			<form action ="confirmation.php" method = "post">
				<textarea rows = "1" id = "articleTitle" name="articleTitle" placeholder = "Title" required></textarea>
				<textarea rows = "40" id = "textbox" name="textbox" placeholder = "HTML and Inline CSS here." required></textarea>
				<input type = "text" list = "gamesList" id = "gameTitle" name="gameTitle" placeholder = "Game Name" required />
				<datalist id ="gamesList" size = "5" >
				<?php foreach($game as $game)
					{
							echo "<option value=\"";
							echo "{$game['GameName']}";
							echo "\">";
							echo "{$game['GameName']}";
							echo "</option>";
							}
				?>
				</dataList>
				<input type = "text" list = "consoleList" id = "consoleTitle" name="consoleTitle" placeholder = "Console Name" required />
				<datalist id ="consoleList" size = "5" >
				<?php foreach($console as $console)
					{
							echo "<option value=\"";
							echo "{$console['console']}";
							echo "\">";
							echo "{$console['console']}";
							echo "</option>";
							}
				?>
				</dataList>
				<input type = "text" list = "genreList" id = "genreTitle" name="genreTitle" placeholder = "Genre Name" required />
				<datalist id ="genreList" size = "5" >
				<?php foreach($genre as $genre)
					{
							echo "<option value=\"";
							echo "{$genre['genre']}";
							echo "\">";
							echo "{$genre['genre']}";
							echo "</option>";
							}
				?>
				</dataList>
				<input type = "button" class = "previewButtons" onclick = "insertPreview()" value = "Insert Preview">
				<input type = "submit" class = "previewButtons" value = "Submit Article">
				<textarea rows = "1" id = "tagTable" name="tagTable" placeholder = "Enter your Custom Tags, use comma to sepreate them"></textarea>
				</form>
			</td>
			<td class = "tableCell">
				<div id = "preview"></div>
			</td>
		</tr>
	</table>
	</div>
	<?php require_once('./initFooter.php') ?>
</body>
	<script src = "articleCreator.js"></script>
	<script src = "login.js"></script>
</html>
