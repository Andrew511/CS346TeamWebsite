<?PHP
//is there a different file I should require?
require_once('initalize.php') ;

if($_SERVER['REQUEST_METHOD'] === 'POST')
{	
	global $db ;

	$id = $_SESSION['ID'] ;
	//This variable would be used to set the readonly field in the form
	$UN = $_SESSION['username'] ;
	$role = $_SESSION['role'] ;
	
	$oldPass = $_POST['oldPassword'] ;
	//$oldPass = hash function
	$newPass1 = $_POST['newPassword'] ;
	$newPass2 = $_POST['confirmPassword'] ;
	
	if($newPass1 == $newPass2 && strpos($newPass1 , $UN) == false)
	{
		$newPass = $newPass1 ;
		//$newPass = hash function
	}
	else
	{
		echo "Your new password does not meet the standards." ;
		header('changePassword.php') ;
	}
	
	if($role == "student")
	{
		try
		{
			$query = "UPDATE Students SET HashPassword = :newPass WHERE StudentId = :id AND HashPassword = :oldPass" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["newPass" => $newPass , "id" => $id , "oldPass" => $oldPass]) ;
		}
		catch(PDOException $e)
		{
			echo "Error updating password" ;
		}
	}
	else
	{
		try
		{
			$query = "UPDATE Instructors SET HashPassword = :newPass WHERE InstructorId = :id AND HashPassword = :oldPass" ;
			$stmt = $db->prepare($query) ;
			$stmt->execute(["newPass" => $newPass , "id" => $id , "oldPass" => $oldPass]) ;
		}
		catch
		{
			echo "Error updating password" ;
		}
	}
}	
?>
