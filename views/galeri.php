<?php
include 'models/m_data_mahasiswa.php';

$img = new dataMahasiswa($connection);

if (@$_GET['act'] == '') {

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

	<script src="hoome/vendor/fancybox/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="hoome/vendor/fancybox/jquery.fancybox.min.css">

	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1custom/jquery-ui.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.12.1custom/jquery-ui.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({
				dateFormat:"dd-MM-yy",
				changeMonth: true,
				changeYear: true
			});
		});
	</script>

	<link rel="stylesheet" type="text/css" href="css/home.css">

<body>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Gallery <small>Image Gallery</small></h1>
	    </div><!-- /.col-lg-12 -->
	</div><!-- /.row -->

	<!-- <section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<a class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Foto
					</a>
				</div>
				<div class="col-md-2" style="margin-left: -20px">
					<button type="button" style="margin-bottom: 20px"  class="btn btn-toolbar" onclick="refresh()"><i class="fa fa-refresh"></i></button>
					<script>
						function refresh() {
						    location.reload();
						}
					</script>
				</div>
				
			</div>
		</div> -->
		
	</section>

	<div class="row">
		<div class="col-md-3">
			<button type="button" style="margin-bottom: 20px; margin-right: 10px" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Foto</button>

			<button type="button" style="margin-bottom: 20px"  class="btn btn-toolbar" onclick="refresh()"><i class="fa fa-refresh"></i></button>
			<script>
				function refresh() {
				    location.reload();
				}
			</script>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">

			<?php
				$tampil = $img->tampil_gmbr();
				while ($data = $tampil->fetch_object()){

						?>
						<div class="imga">
							<a href="assets/img/<?php echo $data->image; ?>" data-fancybox="images" data-caption="<?php echo $data->title." ". $data->tgl ?>">
								<img style="object-fit: cover;" src="assets/img/<?php echo $data->image; ?>"></img>
							</a>
							<div class="del">
								<a href="?page=galeri&act=del&id=<?php echo $data->id ?>" onclick="return confirm ('Delete this image ?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
								</a>
							</div>
						</div>
			<?php
			}
			?>

			<div id="tambah" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Tambah Foto</h3>
						</div>						
						<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="tgl">Tanggal</label>
									<input type="text" name="tgl" class="form-control" id="tgl" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="title">Title</label>
									<input type="text" name="title" class="form-control" id="title" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="image">Upload Your Image</label>
									<input type="file" name="image" class="form-control" id="image" required>
								</div>
								<div class="modal-footer">
									<button type="reset" class="btn btn-danger">Reset</button>
									<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
								</div>
							</div>
						</form>
						<?php
						if(@$_POST['tambah']){
							$tgl = $connection->conn->real_escape_string($_POST['tgl']);
							$title = $connection->conn->real_escape_string($_POST['title']);

							$extensi = explode(".", $_FILES['image']['name']);
							$image = "img-".$tgl.".".end($extensi);
							$sumber = $_FILES['image']['tmp_name'];
							$upload = move_uploaded_file($sumber, "assets/img/".$image);
							if ($upload) {
								$img->tambah_gmbr($tgl, $title, $image);
								?>
									<script>
									alert('Upload Foto Berhasil');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=galeri" />
								<?php
							}else{
								echo "<script>alert('Upload Foto Gagal!')</script";
							}
						}								
						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}else if (@$_GET['act'] == 'del') {
	$gmbr_awal = $img->tampil_gmbr($_GET['id'])->fetch_object()->image;
	unlink("assets/img/".$gmbr_awal);

	$img->delete_gmbr($_GET['id']);
	header("location: ?page=galeri");
}	 