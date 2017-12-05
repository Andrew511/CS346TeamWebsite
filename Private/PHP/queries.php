<?php

  /*
  // Returns an array containing arrays whic have the indexs 'Username' and 'Score'
  // which contain their respective values
  */
  function get_scores($questionId) {
    global $db;

    try {
      $query = "SELECT Students.Username, Scores.Score FROM Scores
                WHERE QuestionId = :questionId
                INNER JOIN Students ON Score.UserId = Students.StudentId";
      $stmt = $db->prepare($query);
      $stmt->execute(["questionId" => $questionId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        db_disconnect();
        exit("Aborting: There was a database error when retrieving " .
             "the score.");
    }
}

function get_student_by_username($username) {
  global $db;

  try{
    $query = "SELECT *
              FROM Students
              WHERE Username = :username";
    $stmt = $db->prepare($query);
    $stmt->execute(["username" => $username]);
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the student.");
  }
}

function add_answer($questionId, $studentId, $score) {
  global $db;

  try{
    $query = "INSERT INTO Scores
              VALUES QuestionId = :questionId, UserId = :userId, Score = :score
              ";
    $stmt = $db->prepare($query);
    $stmt->execute(["questionId" => $questionId, "userId" => $studentId, "score" => $score]);
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of active questions.");
  }
}

function get_active() {
  global $db;

  try{
    $query = "SELECT *
              FROM Questions
              WHERE Status = 3";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of active questions.");
  }
}

function get_question($questionId) {
  global $db;

  try {
    $query = "SELECT * FROM Questions
              WHERE QuestionId = :questionId";
    $stmt = $db->prepare($query);
    $stmt->execute(["questionId" => $questionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when retrieving " .
           "the questions answers.");
  }
}

function get_question_answers($questionId) {
  global $db;

  try {
    $query = "SELECT AnswerText, Correct, ShortAnswer FROM Answers
              WHERE QuestionId = :questionId";
    $stmt = $db->prepare($query);
    $stmt->execute(["questionId" => $questionId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when retrieving " .
           "the questions answers.");
  }
}

/*
// returns an array which should have the average score stored at index 'Score' UNTESTED
*/
function get_avg($questionId) {
  global $db;

  try {
    $query = "SELECT AVG(Score) AS Average FROM Scores
              WHERE QuestionId = :questionId";
    $stmt = $db->prepare($query);
    $stmt->execute(["questionId" => $questionId]);
    return  $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when listing " .
           "the class average for the question.");
  }
}

function set_status($questionId, $statusId) { // can be used to set to draft or activate as well as deactivate a single question
  global $db;

    try {
      $query = "UPDATE Questions
                SET Status = :status
                WHERE QuestionId = :questionId";
      $stmt = $db->prepare($query);
      $stmt->execute(["questionId" => $questionId, "status" => $statusId ]);
      return  true;
    } catch (PDOException $e) {
        db_disconnect();
        exit("Aborting: There was a database error when changing " .
             "the question status.");
    }
}

function deactivate_all() {
  global $db;

    try {
      $query = "UPDATE Questions
                SET Status = 4
                WHERE Status = 3";
      $stmt = $db->prepare($query);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
        db_disconnect();
        exit("Aborting: There was a database error when deactivating " .
             "the questions.");
    }
}



//tested & works on webdev server
function add_question($id, $status, $type, $text, $points, $section, $description) {
  global $db;

  try {
    $query = "INSERT INTO Questions(QuestionId, Status, QuestionType,
                                     QuestionText, PointsAvailable, Section,
                                     Description)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $status, $type, $text, $points, $section, $description]);
    return true;
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: there was a database error when inserting a new " .
            "question. in function Add_question");
  }
}

/*
tested & works on webdev server
checks if the id the instructor is inserting already exist,
if it does not exist, then insert it into the database
*/
function check_id($id){
  global $db;

  try{
    $query = "SELECT *
              FROM Questions
              WHERE QuestionId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($result){ //If there is a question already, output a message to the instructor
      echo "There was an error inserting your question into the database.".
      " A question with the id $id already exists. Please try a different id.";
      return true;
    }
  } catch (PDOException $e){
      db_disconnect();
      exit("Aborting: there was a database error when checking the database for " .
            "the question ID.");
  }
}
/*
tested & works on webdev server
call this function after the function to add the question to the database to
make sure we also update the keywords table
*/
function insert_keywords($id, $keyword){
  global $db;

  try {
    $query = "INSERT INTO Keywords
              VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $keyword]);
    return true;
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: there was a database error when inserting a new " .
          "question.");
  }
}

/*
still need to figure out how to get this into the form and update the table
*/
function add_answer($id, $text, $correct, $number) {
  global $db;

  try{
    $query = "INSERT INTO Answers(QuestionId, AnswerText, Correct, NumberCorrect)
              VALUES(?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $text, $correct, $number]);
    return true;
  }
  catch (PDOException $e){
    db_disconnect();
    exit("Aborting: there was a database error when inserting a new question");
  }
}

function add_short($id, $text){
  global $db;

  try{
    $query = "INSERT INTO Answers(QuestionId, ShortAnswer)
              VALUES(?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$id, $text]);
    return true;
  }
  catch (PDOException $e){
    db_disconnect();
    exit("Aborting: there was a database error when inserting a new question");
  }
}

function edit_question($id) { //to retrieve question information for editing
  global $db;

  try {
    $query = "SELECT QuestionType, QuestionText, PointsAvailable, Section
              FROM Questions
              WHERE QuestionId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was an error when retrieving the question.");
  }
}

function delete_question($id) {
  global $db;

  try{
    $query = "DELETE FROM Questions
              WHERE QuestionId=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    echo "Question $id successfully deleted from database.";
    return true;
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was an error when deleting the question. " .
        "Please try again later.");
  }
}

function delete_keywords($id){
  global $db;

  try{
    $query = "DELETE FROM Keywords
              WHERE QuestionId=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
  }
  catch (PDOException $e){
    db_disconnect();
    exit("Aborting: There was an error when deleting the question. " .
      "Please try again later.");
  }
}

function delete_answers($id){
  global $db;

  try{
    $query = "DELETE FROM Answers
              WHERE QuestionId=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
  }
  catch (PDOException $e){
    db_disconnect();
    exit("Aborting: There was an error when deleting the question. " .
      "Please try again later.");
  }
}

function get_question_list() { //function to populate all the questions the instructor has in the database
  global $db;

  try{
    $query = "SELECT *
              FROM Questions";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of questions available to edit.");
  }
}


function get_keyword_list($id) {
  global $db;

  try{
    $query = "SELECT *
              FROM Keywords WHERE QuestionId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([id]);
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of questions available to edit.");
  }
}

function get_answer_choices($id){
  global $db;
  try{
    $query = "SELECT *
              FROM Answers WHERE QuestionId = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    db_disconnect();
    exit("Aborting: There was an error when retrieving the question.");
  }
}

//function to search by given parameters and return to the Students only deactivated Questions
function search($keyword, $section , $score, $pointsAvailable) {
    global $db;

    try {
      $query = "SELECT * FROM Questions
                WHERE (Keywords IS NULL OR Keywords = :keyword)
				AND (Section IS NULL OR Section = :section)
				AND (Score IS NULL OR Score = :score)
				AND (PointsAvailable IS NULL OR PointsAvailable = :pointsAvailable)
				AND (Status = :status)
                INNER JOIN Questions ON Question.QuestionId = Keywords.QuestionId
				INNER JOIN Questions ON Question.QuestionId = Scores.QuestionId";
      $stmt = $db->prepare($query);
      $stmt->execute(["keyword" => $keyword ,"section" => $section ,
					  "score"=>$score ,"pointsAvailable"=>$pointsAvailable, "status" =>4]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        db_disconnect();
        exit("Aborting: There was a database error when retrieving " .
             "the search results.");
    }

function display_S_table() { //function to populate all the scores in the database.
  global $db;

  try{
    $query = "SELECT Score
              FROM Scores;"
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of scores.")
  }
}

function display_K_table() { //function to populate all the keywords in the database
  global $db;

  try{
    $query = "SELECT Keyword
              FROM Keywords;"
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("There was an error fetching the list of keywords available to edit.")
  }
}
}

function change_password($id , $role , $oldPass , $newPass1 , $newPass2)
{
	if($newPass1 == $newPass2 && strpos($newPass1 , $UN) == false)
	{
		$newPass = $newPass1 ;
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
			$query = "SELECT Salt FROM Students WHERE StudentId = :id" ;
			$stmt = $db->prepare($query) ;
			$salt = $stmt->execute(["id" => $id]) ;
			$oldPass = hash_password($oldPass , $salt) ;
			$newPass = hash_password($newPass , $salt) ;
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
			$query = "SELECT Salt FROM Instructors WHERE InstructorId = :id" ;
			$stmt = $db->prepare($query) ;
			$salt = $stmt->execute(["id" => $id]) ;
			$oldPass = hash_password($oldPass , $salt) ;
			$newPass = hash_password($newPass , $salt) ;
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

function hash_password($password , $salt)
{
	$iv = mcrypt_create_iv(22,MCRYPT_DEV_URANDOM) ;
	$encoded_iv = str_replace('+' , '.' , base64_encode($iv)) ;
	$salt = $salt . $encoded_iv . '$' ;
	$hashed_password = crypt($password , $salt) ;
	return $hashed_password ;
}


?>
