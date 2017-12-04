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
				$query = "SELECT Salt FROM Students WHERE Username = :Username" ;
				$stmt = $db->prepare($query) ;
				$salt = $stmt->execute(["Username" => $UN]) ;
				$hashedPassword = hash_password($PW , $salt) ;
				$PW = crypt($PW , $hashedPassword) ;
				$query = "SELECT StudentId FROM Students WHERE Username = :Username AND HashPassword = :Password" ;
				$stmt = $db->prepare($query) ;	
				$id = $stmt->execute(["Username" => $UN , "Password" => $PW]) ;
				$_SESSION['ID'] = $id ;
				$_SESSION['role'] = $role ;
				$lastLogin = date('m/d/Y h:i:s a' , time()) ;
				$query = "UPDATE Students SET LastLogin = :lastLogin WHERE StudentId = :id" ;
				$stmt = $db->prepare($query) ;
				$stmt->execute(["lastLogin" => $lastLogin , "id" => $id]) ;
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
				$query = "SELECT Salt FROM Instructors WHERE Username = :Username" ;
				$stmt = $db->prepare($query) ;
				$salt = $stmt->execute(["Username" => $UN]) ;
				$hashedPassword = hash_password($PW , $salt) ;
				$PW = crypt($PW , $hashedPassword) ;
				$query = "SELECT InstructorId FROM Instructors WHERE Username = :Username AND HashPassword = :Password" ;
				$stmt = $db->prepare($query) ;	
				$id = $stmt->execute(["Username" => $UN , "Password" => $PW]) ;
				$_SESSION['ID'] = $id ;
				$_SESSION['role'] = $role ;
				$lastLogin = date('m/d/Y h:i:s a' , time()) ;
				$query = "UPDATE Instructors SET LastLogin = :lastLogin WHERE InstructorId = :id" ;
				$stmt = $db->prepare($query) ;
				$stmt->execute(["lastLogin" => $lastLogin , "id" => $id]) ;
				//redirect to instructor page
			}
			catch(PDOException $e)
			{
				echo "Username or Password is incorrect." ;
			}
		}			
	}
?>	  
 
