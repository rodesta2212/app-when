<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/jadwal-guru.inc.php');
	include_once('includes/jadwal-ujian.inc.php');
	include_once('includes/ujian.inc.php');
	include_once('includes/penguji.inc.php');
	include_once('includes/guru.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$JadwalGuru = new JadwalGuru($db);
	$JadwalUjian = new JadwalUjian($db);
	$Ujian = new Ujian($db);
	$Penguji = new Penguji($db);
	$Guru = new Guru($db);

	$JadwalGuru->id_jadwal_guru = $id;
	$JadwalGuru->readOne();
?>

<!-- header -->
<?php include("header.php"); ?>

<body>
	<!-- head navbar -->
	<?php include("head-navbar.php"); ?>

	<!-- right sidebar -->
	<?php include("right-sidebar.php"); ?>

	<!-- left sidebar -->
    <?php include("left-sidebar.php"); ?>
    
	<div class="mobile-menu-overlay"></div>

    <?php
		if($_POST){
			// update ujian
			$JadwalGuru->id_jadwal_guru = $_POST["id_jadwal_guru"];
			$JadwalGuru->id_jadwal_ujian = $_POST["id_jadwal_ujian"];
            $JadwalGuru->id_guru = $_POST["id_guru"];
			$JadwalGuru->status = $_POST["status"];
			$JadwalGuru->nilai = $_POST["nilai"];

			if ($JadwalGuru->updateNilai()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				
			} else {
				echo '<script language="javascript">';
                echo 'alert("Data Gagal Terkirim")';
                echo '</script>';
			}
		}
	?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Nilai</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<!-- hidden -->
						<input type="hidden" name="id_jadwal_guru" value="<?php echo $JadwalGuru->id_jadwal_guru; ?>">
						<input type="hidden" name="id_jadwal_ujian" value="<?php echo $JadwalGuru->id_jadwal_ujian; ?>">
						<input type="hidden" name="status" value="verifikasi">
						<div style="padding-right:15px;">
							<!-- <a href="ujian-create"> -->
								<button type="submit" class="btn btn-success float-right">Simpan</button>
							<!-- </a> -->
						</div>
						<!-- horizontal Basic Forms Start -->
						<div class="pd-20 mb-30">
							<div class="form-group">
								<label>Guru</label>
								<div>
									<select class="custom-select col-12" name="id_guru" readonly>
										<?php $no=1; $gurus = $Guru->readAll(); while ($row = $gurus->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_guru']?>" <?php if($JadwalGuru->id_guru == $row['id_guru'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Ujian</label>
								<div>
									<select class="custom-select col-12" name="id_ujian" readonly>
										<?php $no=1; $ujians = $Ujian->readAll(); while ($row = $ujians->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_ujian']?>" <?php if($JadwalGuru->id_ujian == $row['id_ujian'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Tanggal Ujian</label>
								<input type="text" class="form-control" name="tgl_ujian" value="<?php echo $JadwalGuru->tgl_ujian; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Penguji</label>
								<div>
									<select class="custom-select col-12" name="id_penguji" readonly>
										<?php $no=1; $pengujis = $Penguji->readAll(); while ($row = $pengujis->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_penguji']?>" <?php if($JadwalGuru->id_penguji == $row['id_penguji'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Tempat</label>
								<input type="text" class="form-control" name="tempat" value="<?php echo $JadwalGuru->tempat; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Status</label>
								<input type="text" class="form-control" name="nama_status" value="<?php echo $JadwalGuru->status; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Nilai</label>
								<input type="number" min="0" max="100" class="form-control" name="nilai" value="<?php echo $JadwalGuru->nilai; ?>">
							</div>
						</div>
					</form>
				</div>
				<!-- Simple Datatable End -->
			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
