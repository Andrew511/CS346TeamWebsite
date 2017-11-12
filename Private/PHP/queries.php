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
        exit("Aborting: There was a database error when inserting " .
             "a new book.");
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
           "existing books.");
  }
}
?>
