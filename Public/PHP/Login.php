<?PHP
session_start() ;

//is there a different file I should require?
require_once('initalize.php') ;

	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		global $db ;
	
		$UN = $_POST['username'] ;
		$PW = $_POST['password'] ;
		$_SESSION['username'] = $UN ;
		// $PW = Hash Fucntion
		$role = $_POST['role'] ;
	
		if($role == "student")
		{
			try
			{
				$query = "SELECT StudentId FROM Students WHERE Username = '$UN' AND HashPassword = '$PW'" ;
				$id = $db->query($query) ;
				$_SESSION['ID'] = $id ;
				$_SESSION['role'] = $role ;
				$lastLogin = date('m/d/Y h:i:s a' , time()) ;
				$query = "UPDATE Students SET LastLogin = '$lastLogin' WHERE StudentId = '$id'" ;
				$db->exec($query) ;
				//redirect to student page
			}
			catch(PDOException $e)
			{
				echo "Username or Password is incorrect." ;
			}	
		}
		else
		{
			try
			{
				$query = "SELECT InstructorId FROM Instructors WHERE Username = '$UN' AND HashPassword = '$PW'" ;
				$id = $db->query($query) ;
				$_SESSION['ID'] = $id ;
				$_SESSION['role'] = $role ;
				$lastLogin = date('m/d/Y h:i:s a' , time()) ;
				$query = "UPDATE Instructors SET LastLogin = '$lastLogin' WHERE InstructorId = '$id'" ;
				$db->exec($query) ;
				//redirect to instructor page
			}
			catch(PDOException $e)
			{
				echo "Username or Password is incorrect." ;
			}
		}			
	}
?>	  
 