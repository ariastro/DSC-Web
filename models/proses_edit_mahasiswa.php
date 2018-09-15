<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_data_mahasiswa.php';

$connection = new Database($host, $user, $pass, $database);
$mhs = new dataMahasiswa($connection);

$id = $_POST['id'];
$nim = $connection->conn->real_escape_string($_POST['nim']);
$nama = $connection->conn->real_escape_string($_POST['nama']);
$jk = $connection->conn->real_escape_string($_POST['jk']);
$no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
$email = $connection->conn->real_escape_string($_POST['email']);
$github = $connection->conn->real_escape_string($_POST['github']);

$sqlQuery = "UPDATE data_mahasiswa SET nim = '$nim', nama = '$nama', jk = '$jk', no_hp = '$no_hp', email = '$email', github = '$github' WHERE id = '$id'";

if(mysqli_query($connection->conn, $sqlQuery)){
	?>
		<script>
		alert('Update data berhasil');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
	<?php
	}
	else{
		?>
		<script>
		alert('Update data gagal');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
		<?php
	}
?>