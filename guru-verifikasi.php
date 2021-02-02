<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/guru.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Guru = new Guru($db);
	$Guru->id_guru = $id;
	$Guru->readOne();
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
		// gambar fc izajah
		if(isset($_FILES['fc_ijazah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_ijazah']['name']);
			$file_size =$_FILES['fc_ijazah']['size'];
			$file_tmp =$_FILES['fc_ijazah']['tmp_name'];
			$file_type=$_FILES['fc_ijazah']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc sk sekolah
		if(isset($_FILES['fc_sk_sekolah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_sk_sekolah']['name']);
			$file_size =$_FILES['fc_sk_sekolah']['size'];
			$file_tmp =$_FILES['fc_sk_sekolah']['tmp_name'];
			$file_type=$_FILES['fc_sk_sekolah']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc sk GTT
		if(isset($_FILES['fc_sk_gtt'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_sk_gtt']['name']);
			$file_size =$_FILES['fc_sk_gtt']['size'];
			$file_tmp =$_FILES['fc_sk_gtt']['tmp_name'];
			$file_type=$_FILES['fc_sk_gtt']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc kartu angggota muhammadiyah
		if(isset($_FILES['fc_kartu_anggota_muhammadiyah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_kartu_anggota_muhammadiyah']['name']);
			$file_size =$_FILES['fc_kartu_anggota_muhammadiyah']['size'];
			$file_tmp =$_FILES['fc_kartu_anggota_muhammadiyah']['tmp_name'];
			$file_type=$_FILES['fc_kartu_anggota_muhammadiyah']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc sk kartu keluarga
		if(isset($_FILES['fc_kartu_keluarga'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_kartu_keluarga']['name']);
			$file_size =$_FILES['fc_kartu_keluarga']['size'];
			$file_tmp =$_FILES['fc_kartu_keluarga']['tmp_name'];
			$file_type=$_FILES['fc_kartu_keluarga']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar sk membaca Al Quran
		if(isset($_FILES['sk_membaca_alquran'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_membaca_alquran']['name']);
			$file_size =$_FILES['sk_membaca_alquran']['size'];
			$file_tmp =$_FILES['sk_membaca_alquran']['tmp_name'];
			$file_type=$_FILES['sk_membaca_alquran']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc sk aktif kegiatan muhammadiyah
		if(isset($_FILES['sk_aktif_kegiatan_muhammadiyah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_aktif_kegiatan_muhammadiyah']['name']);
			$file_size =$_FILES['sk_aktif_kegiatan_muhammadiyah']['size'];
			$file_tmp =$_FILES['sk_aktif_kegiatan_muhammadiyah']['tmp_name'];
			$file_type=$_FILES['sk_aktif_kegiatan_muhammadiyah']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		// gambar fc sk pernyataan ketentuan dikdasmen
		if(isset($_FILES['sk_pernyataan_ketentuan_dikdasmen'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_pernyataan_ketentuan_dikdasmen']['name']);
			$file_size =$_FILES['sk_pernyataan_ketentuan_dikdasmen']['size'];
			$file_tmp =$_FILES['sk_pernyataan_ketentuan_dikdasmen']['tmp_name'];
			$file_type=$_FILES['sk_pernyataan_ketentuan_dikdasmen']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			if($file_size > 20097152){
				$errors[]='File size must be excately 20 MB';
			}
			
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				// echo "Success";
				
			}else{
				print_r($errors);
			}
		}

		if ($_POST) {
			$Guru->id_guru = $_POST["id_guru"];
			$Guru->nama = $_POST["nama"];
			$Guru->tgl_lahir = $_POST["tgl_lahir"];
			$Guru->jenis_kelamin = $_POST["jenis_kelamin"];
			$Guru->telp = $_POST["telp"];
			$Guru->email = $_POST["email"];
			$Guru->tempat_kelahiran = $_POST["tempat_kelahiran"];
			$Guru->agama = $_POST["agama"];
			$Guru->pendidikan = $_POST["pendidikan"];
			$Guru->nama_lembaga = $_POST["nama_lembaga"];
			$Guru->tahun_ijazah = $_POST["tahun_ijazah"];
			$Guru->jumlah_program_study = $_POST["jumlah_program_study"];
			$Guru->alamat = $_POST["alamat"];
			$Guru->status_perkawinan= $_POST["status_perkawinan"];
			$Guru->tanggal_mulai_bertugas = $_POST["tanggal_mulai_bertugas"];
			$Guru->tingkatan = $_POST["tingkatan"];
			$Guru->status = $_POST["status"];

			if (!empty($_FILES['fc_ijazah']['name'])){
				$Guru->fc_ijazah = $_FILES['fc_ijazah']['name'];
			} else{
				$Guru->fc_ijazah = $Guru->fc_ijazah;
			}

			if (!empty($_FILES['fc_sk_sekolah']['name'])){
				$Guru->fc_sk_sekolah = $_FILES['fc_sk_sekolah']['name'];
			} else{
				$Guru->fc_sk_sekolah = $Guru->fc_sk_sekolah;
			}

			if (!empty($_FILES['fc_sk_gtt']['name'])){
				$Guru->fc_sk_gtt = $_FILES['fc_sk_gtt']['name'];
			} else{
				$Guru->fc_sk_gtt = $Guru->fc_sk_gtt;
			}

			if (!empty($_FILES['fc_kartu_anggota_muhammadiyah']['name'])){
				$Guru->fc_kartu_anggota_muhammadiyah = $_FILES['fc_kartu_anggota_muhammadiyah']['name'];
			} else{
				$Guru->fc_kartu_anggota_muhammadiyah = $Guru->fc_kartu_anggota_muhammadiyah;
			}

			if (!empty($_FILES['fc_kartu_keluarga']['name'])){
				$Guru->fc_kartu_keluarga = $_FILES['fc_kartu_keluarga']['name'];
			} else{
				$Guru->fc_kartu_keluarga = $Guru->fc_kartu_keluarga;
			}

			if (!empty($_FILES['sk_pernyataan_ketentuan_dikdasmen']['name'])){
				$Guru->sk_pernyataan_ketentuan_dikdasmen = $_FILES['sk_pernyataan_ketentuan_dikdasmen']['name'];
			} else{
				$Guru->sk_pernyataan_ketentuan_dikdasmen = $Guru->sk_pernyataan_ketentuan_dikdasmen;
			}

			if (!empty($_FILES['sk_membaca_alquran']['name'])){
				$Guru->sk_membaca_alquran = $_FILES['sk_membaca_alquran']['name'];
			} else{
				$Guru->sk_membaca_alquran = $Guru->sk_membaca_alquran;
			}

			if (!empty($_FILES['sk_aktif_kegiatan_muhammadiyah']['name'])){
				$Guru->sk_aktif_kegiatan_muhammadiyah = $_FILES['sk_aktif_kegiatan_muhammadiyah']['name'];
			} else{
				$Guru->sk_aktif_kegiatan_muhammadiyah = $Guru->sk_aktif_kegiatan_muhammadiyah;
			}

			// var_dump($_FILES['fc_ijazah']['name']);

			if ($Guru->verifikasi()) {
				echo '<script language="javascript">';
				echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='guru.php'</script>";
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Verifikasi Data Guru</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<!-- hidden -->
						<input type="hidden" name="id_guru" value="<?php echo $Guru->id_guru; ?>">
						<input type="hidden" name="nama" value="<?php echo $Guru->nama; ?>">
						<input type="hidden" name="status" value="verifikasi">

						<!-- horizontal Basic Forms Start -->
						<div class="pd-20 mb-30" style="display: inline-block;">
							<h5 class="text-blue"><?php echo ucwords($Guru->nama); ?> <?php echo ucwords($Guru->status); ?></h5><br/>
							<div class="row">
								<div class="form-group col-6">
									<label>Tempat Kelahiran</label>
									<input type="text" class="form-control" name="tempat_kelahiran" value="<?php echo $Guru->tempat_kelahiran; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Email</label>
									<input type="text" class="form-control" name="email" value="<?php echo $Guru->email; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Tanggal Lahir</label>
									<input type="text" class="form-control" name="tgl_lahir" value="<?php echo $Guru->tgl_lahir; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Jenis Kelamin</label>
									<input type="text" class="form-control" name="jenis_kelamin" value="<?php echo $Guru->jenis_kelamin; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>No Telp</label>
									<input type="text" class="form-control" name="telp" value="<?php echo $Guru->telp; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Alamat</label>
									<input type="text" class="form-control" name="alamat" value="<?php echo $Guru->alamat; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Agama</label>
									<input type="text" class="form-control" name="agama" value="<?php echo $Guru->agama; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Pendidikan</label>
									<input type="text" class="form-control" name="pendidikan" value="<?php echo $Guru->pendidikan; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Nama Lembaga</label>
									<input type="text" class="form-control" name="nama_lembaga" value="<?php echo $Guru->nama_lembaga; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Tahun Ijazah</label>
									<input type="text" class="form-control" name="tahun_ijazah" value="<?php echo $Guru->tahun_ijazah; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Jumlah Program Study</label>
									<input type="text" class="form-control" name="jumlah_program_study" value="<?php echo $Guru->jumlah_program_study; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Tingkatan</label>
									<input type="text" class="form-control" name="tingkatan" value="<?php echo $Guru->tingkatan; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Status Perkawinan</label>
									<input type="text" class="form-control" name="status_perkawinan" value="<?php echo $Guru->status_perkawinan; ?>" readonly>
								</div>
								<div class="form-group col-6">
									<label>Tanggal Mulai Bertugas</label>
									<input type="text" class="form-control" name="tanggal_mulai_bertugas" value="<?php echo $Guru->tanggal_mulai_bertugas; ?>" readonly>
								</div>
							</div>
							<br/><h5 class="text-blue">Lampiran Data Guru</h5><br/>
							<div class="row">
								<div class="form-group col-6">
									<label>Fc Ijazah</label> : 
									<a href="upload/<?php echo $Guru->fc_ijazah; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>Fc Sk Sekolah</label> : 
									<a href="upload/<?php echo $Guru->fc_sk_sekolah; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>FC Sk Gtt</label> : 
									<a href="upload/<?php echo $Guru->fc_sk_gtt; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>FC Kartu Anggota Muhammadiyah</label> : 
									<a href="upload/<?php echo $Guru->fc_kartu_anggota_muhammadiyah; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>FC Kartu Keluarga</label> : 
									<a href="upload/<?php echo $Guru->fc_kartu_keluarga; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>Sk Membaca Al Quran</label> : 
									<a href="upload/<?php echo $Guru->sk_membaca_alquran; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>Sk Aktif Kegiatan Muhammadiyah</label> : 
									<a href="upload/<?php echo $Guru->sk_aktif_kegiatan_muhammadiyah; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								<div class="form-group col-6">
									<label>Sk Pernyataan Ketentuan Dikdasmen</label> : 
									<a href="upload/<?php echo $Guru->sk_pernyataan_ketentuan_dikdasmen; ?>" target="_blank" style="color:red;">Lihat File</a>
								</div>
								
							</div>
							<div style="padding-right:15px;">
								<button type="submit" class="btn btn-success float-right">Verifikasi</button>
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
