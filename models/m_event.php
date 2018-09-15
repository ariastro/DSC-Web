<?php
/**
 * 
 */
class mEvent
{
	private $mysqli;
	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM event";
		if ($id != null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function delete($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM event WHERE id = '$id'") or die ($db->error);
	}

	function __destruct(){
		$db = $this->mysqli->conn;
		$db->close();
	}

}
?>