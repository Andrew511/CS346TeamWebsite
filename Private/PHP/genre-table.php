<?php

/**
 * Service for dealing with the Article table
 */
class GenreTable {
    private $db;
    function __construct($d) {
        $this->db = $d;
    }

	public function getAll()
	{
		$query = "SELECT *
				FROM GenreTable";				
		$stmt = $this->db->ExecuteQuery($query);
		return $stmt;
	}
}
?>
