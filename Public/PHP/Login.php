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
global $db ;
if(isset($_SESSION['ID']))
	{
		$UN = $_SESSION['username'] ;
		$id = $_SESSION['ID'] ;
		$role = $_SESSION['role'] ;
		if($role === "student")
		{
			header("Location: " .$pdir . "/studentHome.php") ;
		}
		else
		{
			header("Location: " .$pdir . "/instructorHome.php") ;
		}
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

  <body id="loginPage">
    <div id="loginBox">
      <h1 id="loginHeader"><span id="mainU">U</span>W<span id="mainO">O
      </span><span id="mainW"> W</span>eb<span id="mainC">C</span>licker</h1>
      <div>
        <form id="loginForm" action="Login.php" method="post">
          <div>
		  	
		<?PHP
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			global $db ;
			$UN = $_POST['username'] ;
			$PW = $_POST['password'] ;
			$_SESSION['username'] = $UN ;
			$role = $_POST['role'] ;
			if($role == "student")
			{
				try
				{
					$query = "SELECT Salt FROM Students WHERE Username = :username" ;
					$stmt = $db->prepare($query) ;
					$stmt->execute(["username" => $UN]) ;
					$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
					$salt = $stmt['Salt'] ;
					$PW = hash_password($PW , $salt) ;
					$query = "SELECT * FROM Students WHERE Username = :Username ";
					$stmt = $db->prepare($query) ;	
					$stmt->execute(["Username" => $UN]) ;
					$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
					$id = $stmt["StudentId"] ;
					$hashPass = $stmt["HashPassword"] ;
					if($hashPass === $PW)
					{
						$_SESSION['ID'] = $id ;
						$_SESSION['role'] = $role ;
						$lastLogin = date('Y-m-d H:i:s' , time()) ;
						$query = "UPDATE Students SET LastLogin = :lastLogin WHERE StudentId = :id" ;
						$stmt = $db->prepare($query) ;
						$stmt->execute(["lastLogin" => $lastLogin , "id" => $id]) ;
						header("Location: " .$pdir . "/studentHome.php") ;
					}
					else
					{
						echo "Username or Password is incorrect.<br>" ;
					}

				}
				catch(PDOException $e)
				{
					echo "Database Error." ;
				}	
			}
			else
			{
				try
				{
					$query = "SELECT Salt FROM Instructors WHERE Username = :username" ;
					$stmt = $db->prepare($query) ;
					$stmt->execute(["username" => $UN]) ;
					$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
					$salt = $stmt['Salt'] ;
					$PW = hash_password($PW , $salt) ;
					$query = "SELECT * FROM Instructors WHERE Username = :Username ";
					$stmt = $db->prepare($query) ;	
					$stmt->execute(["Username" => $UN]) ;
					$stmt = $stmt->fetch(PDO::FETCH_ASSOC) ;
					$id = $stmt["InstructorId"] ;
					$hashPass = $stmt["HashPassword"] ;
					if($hashPass === $PW)
					{
						$_SESSION['ID'] = $id ;
						$_SESSION['role'] = $role ;
						$lastLogin = date('Y-m-d H:i:s' , time()) ;
						$query = "UPDATE Instructors SET LastLogin = :lastLogin WHERE InstructorId = :id" ;
						$stmt = $db->prepare($query) ;
						$stmt->execute(["lastLogin" => $lastLogin , "id" => $id]) ;
						header("Location: " .$pdir . "/instructorHome.php") ;
					}
					else
					{
						echo "Username or Password is incorrect.<br>" ;
					}

				}
				catch(PDOException $e)
				{
					echo "Username or Password is incorrect." ;
				}	
			}			
		}
		?>
            <span class="bold">Sign in as: </span>
            <label><input type="radio" id="radioStudent" name="role"
              value="student" checked/> Student </label>
            <label><input type="radio" id="radioInstructor" name="role"
              value="instructor"/>
            Instructor </label><br/>
            <label>Username:
              <input type="text" id="username" name="username"/>
            </label>
            <br/>
            <label>Password:
              <input type="password" id="password" name="password"/>
            </label>
            <br/>
            <input type="submit" id="loginButton" value="Log In"/>
          </div>
        </form>
      </div>
  </div>
    <div class="footer" id="loginfooter">
      <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px"
                src="http://jigsaw.w3.org/css-validator/images/vcss"
                alt="Valid CSS!" />
        </a>
        <a href="http://validator.w3.org/check/referer">
          <img src="../Images/HTML5_Logo.png"
            width="63" height="64" alt="HTML5 Powered" title="Valid HTML" />
        </a>
      </p>
    </div>
  </body>
</html>  
 
