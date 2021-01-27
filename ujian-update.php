<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/ujian.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Ujian = new Ujian($db);
	$Ujian->id_ujian = $id;
	$Ujian->readOne();
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
			$Ujian->id_ujian = $_POST["id_ujian"];
            $Ujian->nama = $_POST["nama"];
            $Ujian->nilai_lulus = $_POST["nilai_lulus"];

			if ($Ujian->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='ujian.php'</script>";
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
					<input type="hidden" name="id_ujian" value="<?php echo $Ujian->id_ujian; ?>">
					<div style="padding-right:15px;">
                        <!-- <a href="ujian-create"> -->
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        <!-- </a> -->
                    </div>
					<!-- horizontal Basic Forms Start -->
					<div class="pd-20 mb-30">
						
							<div class="form-group">
								<label>Nama Ujian</label>
								<input type="text" class="form-control" name="nama" value="<?php echo $Ujian->nama; ?>">
							</div>
							<div class="form-group">
								<label>Nilai Lulus</label>
								<input type="number" class="form-control" name="nilai_lulus" value="<?php echo $Ujian->nilai_lulus; ?>">
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
