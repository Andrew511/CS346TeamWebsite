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
	$q = get_active();
	$id = $q[0]["QuestionId"];
	echo json_encode(get_student_answers($id));
?>
