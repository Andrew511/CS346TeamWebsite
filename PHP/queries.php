<?php

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

function get_avg($questionId) {
  global $db;

  try {
    $query = "SELECT AVG(Score) FROM Scores
              WHERE QuestionId = :questionId";
    $stmt = $db->prepare($query);
    $stmt->execute["questionId" => $questionId]();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when listing " .
           "the class average for theh question.");
  }
}

function add_question($id, $keyword, $type, $text, $points, $section) {
  global $db;

  try {
    $query = "INSERT INTO Questions VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
    $stmt = $db->prepare($query);
    $stmt->execute([$id, 2, $type, $text, $points, $section, 0, 0, 0]);
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
