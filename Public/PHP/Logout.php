<?PHP
//is there a different file I should require?
	require_once('initalize.php')
	global $db ;

	$id = $_SESSION['ID'] ;
	$role = $_SESSION['role'] ;
	$lastLogout = date('m/d/Y h:i:s a' , time()) ;
	
	if($role == "student")
	{
		try
		{
			$query = "UPDATE Students SET LastLogout = :lastLogout WHERE StudentId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["lastLogout" => $lastLogout , "id" => $id]) ;
			
		}
		catch(PDOException $e)
		{
			echo "Error updating logout time." ;
		}
	}
	else
	{
		try
		{
			$query = "UPDATE Instructors SET LastLogout = :lastLogout WHERE InstructorId = :id" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["lastLogout" => $lastLogout , "id" => $id]) ;
		}
		catch(PDOException $e)
		{
			echo "Error updating logout time." ;
		}
	}
	//clears session variables
	$_SESSION = array() ;
	session_destroy() ;
	header("Login.php") ;
?>
