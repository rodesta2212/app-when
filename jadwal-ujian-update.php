<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal-ujian.inc.php');
	include_once('includes/ujian.inc.php');
	include_once('includes/penguji.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$JadwalUjian = new JadwalUjian($db);
	$Ujian = new Ujian($db);
	$Penguji = new Penguji($db);

	$JadwalUjian->id_jadwal_ujian = $id;
	$JadwalUjian->readOne();
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
			$JadwalUjian->id_jadwal_ujian = $_POST["id_jadwal_ujian"];
            $JadwalUjian->id_ujian = $_POST["id_ujian"];
			$JadwalUjian->tgl_ujian = $_POST["tgl_ujian"];
			$JadwalUjian->id_penguji = $_POST["id_penguji"];
			$JadwalUjian->tempat = $_POST["tempat"];

			if ($JadwalUjian->update()) {
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Update Ujian</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<!-- hidden -->
						<input type="hidden" name="id_jadwal_ujian" value="<?php echo $JadwalUjian->id_jadwal_ujian; ?>">
						<div style="padding-right:15px;">
							<!-- <a href="ujian-create"> -->
								<button type="submit" class="btn btn-success float-right">Simpan</button>
							<!-- </a> -->
						</div>
						<!-- horizontal Basic Forms Start -->
						<div class="pd-20 mb-30">
							<div class="form-group">
								<label>Ujian</label>
								<div>
									<select class="custom-select col-12" name="id_ujian">
										<?php $no=1; $ujians = $Ujian->readAll(); while ($row = $ujians->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_ujian']?>" <?php if($JadwalUjian->id_ujian == $row['id_ujian'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Tanggal Ujian</label>
								<input type="datetime-local" class="form-control" name="tgl_ujian" value="<?php echo $JadwalUjian->tgl_ujian; ?>">
							</div>
							<div class="form-group">
								<label>Penguji</label>
								<div>
									<select class="custom-select col-12" name="id_penguji">
										<?php $no=1; $pengujis = $Penguji->readAll(); while ($row = $pengujis->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_penguji']?>" <?php if($JadwalUjian->id_penguji == $row['id_penguji'] ) echo 'selected' ?>><?=$row['nama']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Tempat</label>
								<input type="text" class="form-control" name="tempat" value="<?php echo $JadwalUjian->tempat; ?>">
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
