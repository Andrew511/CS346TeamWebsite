<?php
  /*
  // Returns an array containing arrays whic have the indexs 'Username' and 'Score'
  // which contain their respective values
  */
  function get_scores($questionId) {
    global $db;

    try {
      $query = "SELECT Username, Score FROM Scores
                WHERE QuestionId = :questionId
                INNER JOIN Students ON Students.StudentId = Score.UserId";
      $stmt = $db->prepare($query);
      $stmt->execute(["questionId" => $questionId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        db_disconnect();
        exit("Aborting: There was a database error when retrieving " .
             "the score.");
    }
}

/*
// returns an array which should have the average score stored at index 'Score' UNTESTED
*/
function get_avg($questionId) {
  global $db;

  try {
    $query = "SELECT AVG(Score) FROM Scores
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

function add_question($id, $keyword, $type, $text, $points, $section) {
  global $db;

  try {
    $query = "INSERT INTO Questions VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);"
    $stmt = $db->prepare($query);
    $stmt->execute([$id, 2, $type, $text, $points, $section, 0, 0, 0]); /*Database auto generates a unique ID for each question if not passed in,
    Defaults also do not need values passed in as they will default to null, this is true for activation start, end and class average
    the database will only generate these values if the other values are explicitly named as I did above, where :sqlvariable => $phpvariable */
    return true;
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: there was a database error when inserting a new " . 
            "question.");
  }
}

function edit_question($id) {
  global $db;

  try {
    $query = "SELECT QuestionType, QuestionText, PointsAvailable, section 
              FROM Questions
              WHERE QuestionId = $id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was an error when retrieving the question.");
  }
}

function delete_question($id) {
  global $db;

  try{
    $query = "DELETE FROM Questions WHERE QuestionId="$id";
    echo "Question$id successfully deleted from database.";
    return true;
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was an error when deleting the question. " .
        "Please try again later.");
  }
}

?>