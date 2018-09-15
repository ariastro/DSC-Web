<?php
include 'models/m_project.php';
require 'models/function.php';

$prjct = new mProject($connection);

if (@$_GET['act'] == '') {
?>

<link rel="stylesheet" type="text/css" href="css/home.css">

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Project <small>Students Project</small></h1>
                </div>
                <!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
		<div class="span4 text-right">
			<button type="button" style="margin-bottom: 20px"  class="btn btn-toolbar" onclick="refresh()"><i class="fa fa-refresh"></i></button>
			<script>
				function refresh() {
				    location.reload();
				}
			</script>
			<button type="button" style="margin-bottom: 20px; margin-right: 10px" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Project</button><br>
		</div>
</div>

	<?php
	$tampil = $prjct->tampil();
	while ($data = $tampil->fetch_object()){
	?>

		<div class="item-boxes-container">
			<div class="item-box item-box-small clearfix">
				<div class="delete">
						<a id="edit_project" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-nama_project="<?php echo $data->nama_project; ?>" data-developer="<?php echo $data->developer; ?>"data-keterangan="<?php echo $data->keterangan; ?>" data-kategori="<?php echo $data->kategori; ?>" data-gambar="<?php echo $data->gambar; ?>">
								<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</button>
						</a>
						<a href="?page=project&act=del&id=<?php echo $data->id ?>" onclick="return confirm ('Delete this image ?')">
							<button class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Delete</button>
						</a>
					</div>
			<div class="row">
				<div class="col-md-6 item-box-image">
			  		<a href=""> 
			  			<img src="assets/img/projects/<?php echo $data->gambar ?>" class="lazy " style="display: inline;">
			  		</a>
			  	</div>
			  	<div class="col-md-6 item-box-information clearfix"> 
			  		<div class="item-box-main-information"> 
			  			<h3 class="item-box-name"> <a href="#"> <?php echo $data->nama_project; ?> </a> </h3> <p class="small"> Oleh: <?php echo $data->developer ?> </p> 

			  			<div class="col-md-10 alert alert-border-soft-blue"> 
			  				<p align="justify "><?php echo $data->keterangan; ?></p> 
			  			</div> 
			  		</div> 
			  		<div class="col-md-2 item-box-extra-information"> 
			  			<div class="item-box-extra-information-item"> 
			  				<span class="text-icon--center-aligned dark-gray" data-toggle="tooltip" title="Jumlah Siswa"> <i class="fa fa-user"></i> 1 Siswa </span> 
			  			</div> 
			  			<div class="item-box-extra-information-item">  
			  				<span class="text-icon--center-aligned dark-gray"> <i class="fa fa-dashboard"></i> <?php echo $data->kategori; ?> </span>  
			  			</div> 
			  		</div>
			  	</div>
			</div>
			</div> 
		</div>
		<?php
	}
		?>

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

			<div id="tambah" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Tambah Project</h3>
						</div>						
						<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="nama_project">Judul</label>
									<input type="text" name="nama_project" class="form-control" id="nama_project" required autofocus="">
								</div>
								<div class="form-group">
									<label class="control-label" for="developer">Developer</label>
									<input type="text" name="developer" class="form-control" id="developer" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="keterangan">Keterangan</label>
									<textarea type="text" name="keterangan" class="form-control" id="keterangan" required></textarea>
								</div>
								<div class="form-group">
									<label class="control-label" for="kategori">Kategori</label><br>
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										  <label class="btn btn-info" active>
										  	<input type="radio" name="kategori" value="Pemula" id="kategori" required> Pemula 
										  </label>
										  <label class="btn btn-primary">
										    <input type="radio" name="kategori" value="Menengah" id="kategori"> Menengah
										  </label>
										  <label class="btn btn-danger">
										    <input type="radio" name="kategori" value="Expert" id="kategori"> Expert
										  </label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="gambar">Gambar</label>
									<input type="file" name="gambar" class="form-control" id="gambar" required>
								</div>
								<div class="modal-footer">
									<button type="reset" class="btn btn-danger">Reset</button>
									<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
								</div>
							</div>
						</form>
						<?php
						if(@$_POST['tambah']){
							$nama_project = $connection->conn->real_escape_string($_POST['nama_project']);
							$developer = $connection->conn->real_escape_string($_POST['developer']);
							$keterangan = $connection->conn->real_escape_string($_POST['keterangan']);
							$kategori = $connection->conn->real_escape_string($_POST['kategori']);
							$extensi = explode(".", $_FILES['gambar']['name']);
							$gambar = "img-".$nama_project.".".end($extensi);
							$sumber = $_FILES['gambar']['tmp_name'];
							$upload = move_uploaded_file($sumber, "assets/img/projects/".$gambar);

							$sqlQuery = "INSERT INTO project VALUES('', '$nama_project', '$developer', '$keterangan', '$kategori', '$gambar')";

							if(mysqli_query($connection->conn, $sqlQuery)){
								?>
									<script>
									alert('penyimpanan data berhasil');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=project" />
								<?php
							}
								else{
									?>
									<script>
									alert('penyimpanan data gagal');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=project" />
								<?php
								}
						}								
						?>

					</div>
				</div>
			</div>
<?php
}else if (@$_GET['act'] == 'del') {
	$gmbr_awal = $prjct->tampil($_GET['id'])->fetch_object()->gambar;
	unlink("assets/img/projects/".$gmbr_awal);

	$prjct->delete($_GET['id']);
	header("location: ?page=project");
}	 