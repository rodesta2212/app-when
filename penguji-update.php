<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/penguji.inc.php');
	include_once('includes/user.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID.');

	$Penguji = new Penguji($db);
	$Penguji->id_penguji = $id;
	$Penguji->readOne();

	$User = new User($db);
	$User->id_user = $id_user;
	$User->readOne();
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
			$Penguji->id_penguji = $_POST["id_penguji"];
			$Penguji->nama = $_POST["nama"];
			$Penguji->alamat = $_POST["alamat"];
			$Penguji->telp = $_POST["telp"];

			// update user
			$User->id_user = $_POST["id_user"];
			$User->username = $_POST["username"];
			$User->password = $_POST["password"];
			$User->role = $_POST["role"];

			if ($Penguji->update() && $User->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='penguji.php'</script>";
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Update Penguji</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
					<!-- hidden -->
					<input type="hidden" name="id_penguji" value="<?php echo $Penguji->id_penguji; ?>">
					<input type="hidden" name="id_user" value="<?php echo $User->id_user; ?>">
					<input type="hidden" name="role" value="<?php echo $User->role; ?>">
					<div style="padding-right:15px;">
                        <!-- <a href="ujian-create"> -->
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        <!-- </a> -->
                    </div>
					<!-- horizontal Basic Forms Start -->
					<div class="pd-20 mb-30">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="nama" value="<?php echo $Penguji->nama; ?>">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="alamat" value="<?php echo $Penguji->alamat; ?>">
						</div>
						<div class="form-group">
							<label>Telpon</label>
							<input type="number" class="form-control" name="telp" value="<?php echo $Penguji->telp; ?>">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="<?php echo $User->username; ?>">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control" name="password" value="<?php echo $User->password; ?>">
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
