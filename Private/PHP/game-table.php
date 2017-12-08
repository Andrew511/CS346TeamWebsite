<?php

/**
 * Service for dealing with the Game table
 */
class GameTable {
    private $db;
    function __construct($d) {
        $this->db = $d;
    }

    /**
     * SQL for inserting an Game into the DB
     */
    public function insert($gameName, $description) {
        $query = "INSERT INTO GameTable (GameName, Description)
                  VALUES ('$gameName', '$description')";
        $this->db->ExecuteNonQuery($query);
    }

    /**
     * SQL for Selecting a single Game record from the DB
     */
    public function get($gameName) {
        $query = "SELECT * FROM GameTable WHERE GameName = '$gameName' ";
        $response = $this->db->ExecuteQuery($query);
        return $response;
    }

    /**
     * SQL for getting all games from the database
     */
    public function getAll() {
        $query = "SELECT GameName FROM  GameTable";
        $response = $this->db->ExecuteQuery($query);
        return $response;
    }
}

?>