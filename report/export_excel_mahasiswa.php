<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_data_mahasiswa.php";
$connection = new Database($host, $user, $pass, $database);
$mhs = new dataMahasiswa($connection);

$fileName = "excel_mhs-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename='$fileName'");
header("Content-Type: application/vnd.ms-excel");

?>

<table border="1px">
	<tr>
		<th width="3%">No.</th>
		<th width="10%">NIM</th>
		<th width="25%">Name</th>
		<th width="3%">Gender</th>
		<th width="10%"><i class="fas fa-phone-square"></i> Phone</th>
		<th width="15%"><i class="fas fa-envelope"></i> Email</th>
		<th width="15%"><i class="fab fa-github"></i> Github</th>
	</tr>	
	<?php
	$no = 1;
	$tampil = $mhs->tampil();
	while ($data = $tampil->fetch_object()) {
		echo "<tr>";
			echo "<td align=center>".$no++."</td>";
			echo "<td>".$data->nim."</td>";
			echo "<td>".$data->nama."</td>";
			echo "<td>".$data->jk."</td>";
			echo "<td>".$data->no_hp."</td>";
			echo "<td>".$data->email."</td>";
			echo "<td>".$data->github."</td>";
		echo "</tr>";

	}
	?>
	
</table>