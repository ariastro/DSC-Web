<?php
include 'models/m_event.php';

$evnt = new mEvent($connection);

if (@$_GET['act'] == '') {
?>

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

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Event <small>Event/Workshop</small></h1>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12" style="margin-bottom: 50px;">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="datatables">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tanggal Event</th>
						<th>Nama Event</th>
						<th>Lokasi</th>
						<th>Kategori</th>
						<th>Kuota</th>
						<th>Jadwal</th>
						<th><i class="fas fa-cogs"></i> Action</th>
					</tr>	
				</thead>

				<tbody>
					<?php
					$no = 1;
					$tampil = $evnt->tampil();
					while ($data = $tampil->fetch_object()) {
						
					?>
					<tr>
						<td align="center"><?php echo $no++ .".";?></td>
						<td><?php echo $data->tgl; ?></td>
						<td><?php echo $data->nama_event; ?></td>
						<td><?php echo $data->lokasi; ?></td>
						<td><?php echo $data->kategori; ?></td>
						<td><?php echo $data->kuota; ?></td>
						<td>
							<a href="<?php echo $data->jadwal; ?>">
							<?php echo $data->jadwal; ?>
							</a></td>
						<td align="center">
							<a id="edit_event" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-tgl="<?php echo $data->tgl; ?>" data-nama_event="<?php echo $data->nama_event; ?>"data-lokasi="<?php echo $data->lokasi; ?>" data-kategori="<?php echo $data->kategori; ?>" data-kuota="<?php echo $data->kuota; ?>" data-jadwal="<?php echo $data->jadwal; ?>" >
								<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Edit</button>
							</a>
							<a href="?page=event&act=del&id=<?php echo $data->id ?>" onclick="return confirm ('Delete this data ?')">
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
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Event</button>

			<div id="tambah" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title" align="center">Tambah Event</h3>
						</div>						
						<form method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="tgl">Tanggal Event</label>
									<input type="text" name="tgl" class="form-control" id="tgl" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="nama_event">Nama Event</label>
									<input type="text" name="nama_event" class="form-control" id="nama_event" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="lokasi">Lokasi</label>
									<input type="text" name="lokasi" class="form-control" id="lokasi" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="kategori">Kategori</label></br>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
										  <label class="btn btn-danger" active>
										  	<input type="radio" name="kategori" value="Seminar" id="kategori" required> Seminar 
										  </label>
										  <label class="btn btn-info">
										    <input type="radio" name="kategori" value="Workshop" id="kategori"> Workshop
										  </label>
										</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="kuota">Kuota</label>
									<input type="number" name="kuota" class="form-control" id="kuota" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="jadwal">Jadwal</label>
									<input type="text" name="jadwal" class="form-control" id="jadwal">
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
							$nama_event = $connection->conn->real_escape_string($_POST['nama_event']);
							$lokasi = $connection->conn->real_escape_string($_POST['lokasi']);
							$kategori = $connection->conn->real_escape_string($_POST['kategori']);
							$kuota = $connection->conn->real_escape_string($_POST['kuota']);
							$jadwal = $connection->conn->real_escape_string($_POST['jadwal']);

							$sqlQuery = "INSERT INTO event VALUES('', '$tgl', '$nama_event', '$lokasi', '$kategori', '$kuota', '$jadwal')";

							if(mysqli_query($connection->conn, $sqlQuery)){
								?>
									<script>
									alert('penyimpanan data berhasil');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=event" />
								<?php
							}
								else{
									?>
									<script>
									alert('penyimpanan data gagal');
									</script>
									<meta http-equiv="refresh" content="0; url=?page=event" />
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
							<h3 name ="editt" class="modal-title" align="center">Edit Event</h3>
						</div>						
						<form id="form" enctype="multipart/form-data" autocomplete="off">
							<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="tgl">Tanggal Event</label>
									<input type="hidden" name="id" id="id">
									<input type="text" name="tgl" class="form-control" id="tgl" required autofocus>
								</div>
								<div class="form-group">
									<label class="control-label" for="nama_event">Nama Event</label>
									<input type="text" name="nama_event" class="form-control" id="nama_event" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="lokasi">Lokasi</label>
									<input type="text" name="lokasi" class="form-control" id="lokasi" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="kategori">Kategori</label></br>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
										  <label class="btn btn-danger" active>
										  	<input type="radio" name="kategori" value="Seminar" id="kategori" required>Seminar
										  </label>
										  <label class="btn btn-info">
										    <input type="radio" name="kategori" value="Workshop" id="kategori">Workshop
										  </label>
										</div>
								</div>
								<div class="form-group">
									<label class="control-label" for="kuota">Kuota</label>
									<input type="number" name="kuota" class="form-control" id="kuota" required>
								</div>
								<div class="form-group">
									<label class="control-label" for="jadwal">Jadwal</label>
									<input type="text" name="jadwal" class="form-control" id="jadwal">
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
			$(document).on("click", "#edit_event", function(){
					var id = $(this).data('id');
					var tgl = $(this).data('tgl');
					var nama_event = $(this).data('nama_event');
					var lokasi = $(this).data('lokasi');
					var kategori = $(this).data('kategori');
					var kuota = $(this).data('kuota');
					var jadwal = $(this).data('jadwal');
					$("#modal-edit #id").val(id);
					$("#modal-edit #tgl").val(tgl);
					$("#modal-edit #nama_event").val(nama_event);

				    if(kategori == "Seminar") {
				        $('#modal-edit #kategori').filter('[value=Seminar]').prop('checked', true);
				        $('#modal-edit #kategori').filter('[value=Workshop]').prop('checked', false);
				    }else {
				    	$('#modal-edit #kategori').filter('[value=Workshop]').prop('checked', true);
				    	$('#modal-edit #kategori').filter('[value=Seminar]').prop('checked', false);
				    }

					$("#modal-edit #lokasi").val(lokasi);
					$("#modal-edit #kuota").val(kuota);
					$("#modal-edit #jadwal").val(jadwal);
			})

			$(document).ready(function(e){
				$("#form").on("submit", (function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_event.php',
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
	$evnt->delete($_GET['id']);
	header("location: ?page=event");
}	 