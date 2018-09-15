<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_event.php';

$connection = new Database($host, $user, $pass, $database);
$evnt = new mEvent($connection);

$id = $_POST['id'];
$tgl = $connection->conn->real_escape_string($_POST['tgl']);
$nama_event = $connection->conn->real_escape_string($_POST['nama_event']);
$lokasi = $connection->conn->real_escape_string($_POST['lokasi']);
$kategori = $connection->conn->real_escape_string($_POST['kategori']);
$kuota = $connection->conn->real_escape_string($_POST['kuota']);
$jadwal = $connection->conn->real_escape_string($_POST['jadwal']);

$sqlQuery = "UPDATE event SET tgl = '$tgl', nama_event = '$nama_event', lokasi = '$lokasi', kategori = '$kategori', kuota = '$kuota', jadwal = '$jadwal' WHERE id = '$id'";

if(mysqli_query($connection->conn, $sqlQuery)){
	?>
		<script>
		alert('Update data berhasil');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=event" />
	<?php
	}
	else{
		?>
		<script>
		alert('Update data gagal');
		</script>
		<meta http-equiv="refresh" content="0; url=?page=event" />
		<?php
	}
?>