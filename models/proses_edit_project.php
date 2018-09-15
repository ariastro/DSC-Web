<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_data_project.php';

$connection = new Database($host, $user, $pass, $database);
$prjct = new mProject($connection);

$id = $_POST['id'];
$nama_project = $connection->conn->real_escape_string($_POST['nama_project']);
$developer = $connection->conn->real_escape_string($_POST['developer']);
$keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
$kategori = $connection->conn->real_escape_string($_POST['kategori']);
$gambar = $connection->conn->real_escape_string($_POST['gambar']);

$sqlQuery = "UPDATE project SET nama_project = '$nama_project', developer = '$developer', keterangan = '$keterangan', kategori = '$kategori', gambar = '$gambar', github = '$github' WHERE id = '$id'";

if(mysqli_query($connection->conn, $sqlQuery)){
	?>
		<script>
		alert('Update data berhasil');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=project" />
	<?php
	}
	else{
		?>
		<script>
		alert('Update data gagal');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=project" />
		<?php
	}
?>