<?php
/**
 * 
 */
class mProject
{
	private $mysqli;
	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM project";
		if ($id != null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah($nama_project, $developer, $keterangan, $kategori, $gambar){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO project VALUES('', '$nama_project', '$developer', '$keterangan, $kategori, $gambar')") or die($db->error);
	}

	public function delete($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM project WHERE id = '$id'") or die ($db->error);
	}

	function __destruct(){
		$db = $this->mysqli->conn;
		$db->close();
	}

}
?>