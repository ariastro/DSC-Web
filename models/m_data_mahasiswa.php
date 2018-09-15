<?php
/**
 * 
 */
class dataMahasiswa
{
	private $mysqli;
	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM data_mahasiswa";
		if ($id != null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah_gmbr($tgl, $title, $image){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO galeri VALUES('', '$tgl', '$title', '$image')") or die($db->error);
	}

	public function tampil_gmbr($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM galeri";
		if ($id != null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function delete($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM data_mahasiswa WHERE id = '$id'") or die ($db->error);
	}

	public function delete_gmbr($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM galeri WHERE id = '$id'") or die ($db->error);
	}

	function __destruct(){
		$db = $this->mysqli->conn;
		$db->close();
	}

}
?>