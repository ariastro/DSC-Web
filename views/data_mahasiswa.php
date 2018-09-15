<?php
include 'models/m_data_mahasiswa.php';

$mhs = new dataMahasiswa($connection);

if (@$_GET['act'] == '') {
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mahasiswa <small>Data Mahasiswa</small></h1>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12" style="margin-bottom: 50px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="datatables">
				<thead>
					<tr>
						<th width="2%">No.</th>
						<th width="10%">NIM</th>
						<th width="25%">Name</th>
						<th width="2%">Gender</th>
						<th width="10%"><i class="fas fa-phone-square"></i> Phone</th>
						<th width="15%"><i class="fas fa-envelope"></i> Email</th>
						<th width="15%"><i class="fab fa-github"></i> Github</th>
						<th width="20%"><i class="fas fa-cogs"></i> Action</th>
					</tr>	
				</thead>

				<tbody>
					<?php
					$no = 1;
					$tampil = $mhs->tampil();
					while ($data = $tampil->fetch_object()) {
						
					?>
					<tr>
						<td align="center"><?php echo $no++ .".";?></td>
						<td><?php echo $data->nim; ?></td>
						<td><?php echo $data->nama; ?></td>
						<td align="center"><?php echo $data->jk; ?></td>
						<td><?php echo $data->no_hp; ?></td>
						<td><?php echo $data->email; ?></td>
						<td>
							<a href="<?php echo $data->github; ?>">
							<?php echo $data->github; ?>
							</a></td>
						<td align="center">
							<a id="edit_mahasiswa" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-nim="<?php echo $data->nim; ?>" data-nama="<?php echo $data->nama; ?>"data-jk="<?php echo $data->jk; ?>" data-no_hp="<?php echo $data->no_hp; ?>" data-email="<?php echo $data->email; ?>" data-github="<?php echo $data->github; ?>" >
								<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</button>
							</a>
							<a href="?page=data_mahasiswa&act=del&id=<?php echo $data->id ?>" onclick="return confirm ('Delete this data ?')">
							<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</button>
							</a>
						</td>
					</tr>		
					<?php
					} 
					?>	
				</tbody>
			</table>
		</div>
			<button type="button" class="btn btn" onclick="refresh()"><i class="fa fa-refresh"></i></button>
			<script>
				function refresh() {
				    location.reload();
				}
			</script>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
			<a href="./report/export_excel_mahasiswa.php" target="_blank">
				<button class="btn btn-danger"><i class="fa fa-print"></i> Export ke Excel</button>
			</a> 

			<div id="tambah" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Tambah Mahasiswa</h3>
						</div>						
						<form method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="nim">NIM</label>
									<input type="text" name="nim" class="form-control" id="nim" required autofocus>
								</div>
								<div class="form-group">
									<label class="control-label" for="nama">Name</label>
									<input type="text" name="nama" class="form-control" id="nama" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="jk">Gender</label></br>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
										  <label class="btn btn-danger" active>
										  	<input type="radio" name="jk" value="M" id="jk" required><i class="fas fa-mars"></i> Male 
										  </label>
										  <label class="btn btn-info">
										    <input type="radio" name="jk" value="F" id="jk"><i class="fas fa-venus"></i> Female
										  </label>
										</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="no_hp">Phone</label>
									<input type="text" name="no_hp" value="+62" class="form-control" id="no_hp" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="email">Email</label>
									<input type="email" name="email" class="form-control" id="email" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="github">Github</label>
									<input type="url" name="github" value="https://" class="form-control" id="github">
								</div>
								<div class="modal-footer">
									<button type="reset" class="btn btn-danger">Reset</button>
									<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
								</div>
							</div>
						</form>
						<?php
						if(@$_POST['tambah']){
							$nim = $connection->conn->real_escape_string($_POST['nim']);
							$nama = $connection->conn->real_escape_string($_POST['nama']);
							$jk = $connection->conn->real_escape_string($_POST['jk']);
							$no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
							$email = $connection->conn->real_escape_string($_POST['email']);
							$github = $connection->conn->real_escape_string($_POST['github']);

							$sqlQuery = "INSERT INTO data_mahasiswa VALUES('', '$nim', '$nama', '$jk', '$no_hp', '$email', '$github')";

							if(mysqli_query($connection->conn, $sqlQuery)){
								?>
									<script>
									alert('penyimpanan data berhasil');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
								<?php
							}
								else{
									?>
									<script>
									alert('penyimpanan data gagal');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=data_mahasiswa" />
								<?php
								}
						}								
						?>
					</div>
				</div>
			</div>

			<div id="edit" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 name ="editt" class="modal-title" align="center">Edit Data Mahasiswa</h3>
						</div>						
						<form id="form" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="nim">NIM</label>
									<input type="hidden" name="id" id="id">
									<input type="text" name="nim" class="form-control" id="nim" required autofocus>
								</div>
								<div class="form-group">
									<label class="control-label" for="nama">Name</label>
									<input type="text" name="nama" class="form-control" id="nama" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="jk">Gender</label></br>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
										  <label class="btn btn-danger" active>
										  	<input type="radio" name="jk" value="M" id="jk" required><i class="fas fa-mars"></i> Male 
										  </label>
										  <label class="btn btn-info">
										    <input type="radio" name="jk" value="F" id="jk"><i class="fas fa-venus"></i> Female
										  </label>
										</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="no_hp">Phone</label>
									<input type="text" name="no_hp" class="form-control" id="no_hp" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="email">Email</label>
									<input type="email" name="email" class="form-control" id="email" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="github">Github</label>
									<input type="url" name="github" class="form-control" id="github">
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn btn-success" name="edit" value="Simpan">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<script src="js/jquery-3.3.1.min.js"></script>
			<script type="text/javascript">
			$(document).on("click", "#edit_mahasiswa", function(){
					var id = $(this).data('id');
					var nim = $(this).data('nim');
					var nama = $(this).data('nama');
					var jk = $(this).data('jk');
					var no_hp = $(this).data('no_hp');
					var email = $(this).data('email');
					var github = $(this).data('github');
					$("#modal-edit #id").val(id);
					$("#modal-edit #nim").val(nim);
					$("#modal-edit #nama").val(nama);

				    if(jk == "F") {
				        $('#modal-edit #jk').filter('[value=F]').prop('checked', true);
				        $('#modal-edit #jk').filter('[value=M]').prop('checked', false);
				    }else {
				    	$('#modal-edit #jk').filter('[value=M]').prop('checked', true);
				    	$('#modal-edit #jk').filter('[value=F]').prop('checked', false);
				    }

					$("#modal-edit #no_hp").val(no_hp);
					$("#modal-edit #email").val(email);
					$("#modal-edit #github").val(github);
			})

			$(document).ready(function(e){
				$("#form").on("submit", (function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_mahasiswa.php',
						type : 'POST',
						data : new FormData(this),
						contentType : false,
						cache : false,
						processData : false,
						success : function(msg){
							$('.table').html(msg);
						}
					});
				}));
			});

			</script>

	</div>
</div>

<?php
}else if (@$_GET['act'] == 'del') {
	$mhs->delete($_GET['id']);
	header("location: ?page=data_mahasiswa");
}	 