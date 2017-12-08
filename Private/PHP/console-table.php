<?php

/**
 * Service for dealing with the Article table
 */
class ConsoleTable {
    private $db;
    function __construct($d) {
        $this->db = $d;
    }


	public function getAll()
	{
		$query = "SELECT *
				FROM ConsoleTable";				
		$stmt = $this->db->ExecuteQuery($query);
		return $stmt;
	}
}
?>
