<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/guru.inc.php');
    include_once("includes/user.inc.php");

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID.');

	$Guru = new Guru($db);
	$Guru->id_guru = $id;
	$Guru->readOne();

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
			$Guru->fc_ijazah = $_POST["fc_ijazah"];
			$Guru->status_perkawinan= $_POST["status_perkawinan"];
			$Guru->tanggal_mulai_bertugas = $_POST["tanggal_mulai_bertugas"];
			$Guru->fc_sk_sekolah = $_POST["fc_sk_sekolah"];
			$Guru->fc_sk_gtt = $_POST["fc_sk_gtt"];
			$Guru->fc_kartu_anggota_muhammadiyah = $_POST["fc_kartu_anggota_muhammadiyah"];
			$Guru->fc_kartu_keluarga = $_POST["fc_kartu_keluarga"];
			$Guru->sk_membaca_alquran = $_POST["sk_membaca_alquran"];
			$Guru->sk_lulus_tes_muhammadiyah = $_POST["sk_lulus_tes_muhammadiyah"];
			$Guru->sk_aktif_kegiatan_muhammadiyah = $_POST["sk_aktif_kegiatan_muhammadiyah"];
			$Guru->sk_pernyataan_ketentuan_dikdasmen = $_POST["sk_pernyataan_ketentuan_dikdasmen"];
			$Guru->tingkatan = $_POST["tingkatan"];
			if ($Guru->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='index.php'</script>";
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
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="vendors/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0"><?php echo ucwords($Guru->nama); ?></h5>
							<p class="text-center text-muted font-14"><?php echo ucwords($Guru->status); ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email :</span>
										<?php echo $Guru->email; ?>
									</li>
									<li>
										<span>No Telp :</span>
										<?php echo $Guru->telp; ?>
									</li>
									<li>
										<span>Alamat :</span>
										<?php echo $Guru->alamat; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Profile</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Setting Tab start -->
										<div class="tab-pane fade show active" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form method="POST" enctype="multipart/form-data">
												<!-- hidden -->
												<input type="hidden" name="id_guru" value="<?php echo $Guru->id_guru; ?>">
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Profil</h4>
															<div class="form-group">
																<label>Nama Lengkap</label>
																<input class="form-control form-control-lg" type="text" name="nama" value="<?php echo $Guru->nama; ?>">
															</div>
															<div class="form-group">
																<label>Tempat Kelahiran</label>
																<input class="form-control form-control-lg" type="text" name="tempat_kelahiran" value="<?php echo $Guru->tempat_kelahiran; ?>">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $Guru->email; ?>">
															</div>
															<div class="form-group">
																<label>Tanggal Lahir</label>
																<input class="form-control form-control-lg" type="date" name="tgl_lahir" value="<?php echo $Guru->tgl_lahir; ?>">
															</div>
															<div class="form-group">
																<label>Jenis Kelamin</label>
																<div class="d-flex">
																	<?php if($Guru->jenis_kelamin == 'laki'): ?>
																	<div class="custom-control custom-radio mb-5 mr-20">
																		<input type="radio" id="customRadio4" name="jenis_kelamin" value="laki" class="custom-control-input" checked>
																		<label class="custom-control-label weight-400" for="customRadio4">Laki - laki</label>
																	</div>
																	<div class="custom-control custom-radio mb-5">
																		<input type="radio" id="customRadio5" name="jenis_kelamin" value="perempuan" class="custom-control-input">
																		<label class="custom-control-label weight-400" for="customRadio5">Perempuan</label>
																	</div>
																	<?php else: ?>
																		<div class="custom-control custom-radio mb-5 mr-20">
																			<input type="radio" id="customRadio4" name="jenis_kelamin" value="laki" class="custom-control-input">
																			<label class="custom-control-label weight-400" for="customRadio4">Laki - laki</label>
																		</div>
																		<div class="custom-control custom-radio mb-5">
																			<input type="radio" id="customRadio5" name="jenis_kelamin" value="perempuan" class="custom-control-input" checked>
																			<label class="custom-control-label weight-400" for="customRadio5">Perempuan</label>
																		</div>
																	<?php endif; ?>
																</div>
															</div>
															<div class="form-group">
																<label>No Telpon</label>
																<input class="form-control form-control-lg" type="text" name="telp" min="0" value="<?php echo $Guru->telp; ?>">
															</div>
															<div class="form-group">
																<label>Alamat</label>
																<textarea class="form-control" name="alamat" ><?php echo $Guru->alamat; ?></textarea>
															</div>
															<div class="form-group">
																<label>Agama</label>
																<input class="form-control form-control-lg" type="text" name="agama" value="<?php echo $Guru->agama; ?>">
															</div>
															<div class="form-group">
																<label>Pendidikan</label>
																<input class="form-control form-control-lg" type="text" name="pendidikan" value="<?php echo $Guru->pendidikan; ?>">
															</div>
															<div class="form-group">
																<label>Nama lembaga</label>
																<input class="form-control form-control-lg" type="text" name="nama_lembaga" value="<?php echo $Guru->nama_lembaga; ?>">
															</div>
															<div class="form-group">
																<label>Tahun Ijazah</label>
																<input class="form-control form-control-lg" type="text" name="tahun_ijazah" value="<?php echo $Guru->tahun_ijazah; ?>">
															</div>
															<div class="form-group">
																<label>Jumlah Program Study</label>
																<input class="form-control form-control-lg" type="text" name="jumlah_program_study" value="<?php echo $Guru->jumlah_program_study; ?>">
															</div>
															<div class="form-group">
																<label>Tingkatan</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" name="tingkatan">
																	<option value="SD" <?php if($Guru->tingkatan == 'SD'): ?> selected <?php endif; ?>>SD</option>
																	<option value="SMP" <?php if($Guru->tingkatan == 'SMP'): ?> selected <?php endif; ?> >SMP</option>
																	<option value="SMA" <?php if($Guru->tingkatan == 'SMA'): ?> selected <?php endif; ?> >SMA</option>
																</select>
															</div>
															<div class="form-group">
																<label>Status Perkawinan</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" name="status_perkawinan">
																	<option value="belum menikah" <?php if($Guru->status_perkawinan == 'belum menikah'): ?> selected <?php endif; ?>>Belum Menikah</option>
																	<option value="menikah" <?php if($Guru->status_perkawinan == 'menikah'): ?> selected <?php endif; ?> >Menikah</option>
																</select>
															</div>
															<div class="form-group">
																<label>Tanggal Mulai Bertugas</label>
																<input class="form-control form-control-lg" type="date" name="tanggal_mulai_bertugas" value="<?php echo $Guru->tanggal_mulai_bertugas; ?>">
															</div>
															<div class="form-group mb-0">
																<!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
																<button type="submit" class="btn btn-success">Simpan</button>
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Lampiran</h4>
															<div class="form-group">
																<label>FC Ijazah:</label>
																<input class="form-control form-control-lg" type="text" name="fc_ijazah" value="<?php echo $Guru->fc_ijazah; ?>">
															</div>
															<div class="form-group">
																<label>Fc Sk Sekolah:</label>
																<input class="form-control form-control-lg" type="text" name="fc_sk_sekolah" value="<?php echo $Guru->fc_sk_sekolah; ?>">
															</div>
															<div class="form-group">
																<label>FC Sk Gtt:</label>
																<input class="form-control form-control-lg" type="text" name="fc_sk_gtt" value="<?php echo $Guru->fc_sk_gtt; ?>">
															</div>
															<div class="form-group">
																<label>FC Kartu Anggota Muhammadiyah:</label>
																<input class="form-control form-control-lg" type="text" name="fc_kartu_anggota_muhammadiyah" value="<?php echo $Guru->fc_kartu_anggota_muhammadiyah; ?>">
															</div>
															<div class="form-group">
																<label>FC Kartu Keluarga:</label>
																<input class="form-control form-control-lg" type="text" name="fc_kartu_keluarga" value="<?php echo $Guru->fc_kartu_keluarga; ?>">
															</div>
															<div class="form-group">
																<label>Sk Membaca Al Quran:</label>
																<input class="form-control form-control-lg" type="text" name="sk_membaca_alquran" value="<?php echo $Guru->sk_membaca_alquran; ?>">
															</div>
															<div class="form-group">
																<label>SK Lulus Tes Muhammadiyah:</label>
																<input class="form-control form-control-lg" type="text" name="sk_lulus_tes_muhammadiyah" value="<?php echo $Guru->sk_lulus_tes_muhammadiyah; ?>">
															</div>
															<div class="form-group">
																<label>Sk Aktif Kegiatan Muhammadiyah:</label>
																<input class="form-control form-control-lg" type="text" name="sk_aktif_kegiatan_muhammadiyah" value="<?php echo $Guru->sk_aktif_kegiatan_muhammadiyah; ?>">
															</div>
															<div class="form-group">
																<label>Sk Pernyataan Ketentuan Dikdasmen:</label>
																<input class="form-control form-control-lg" type="text" name="sk_pernyataan_ketentuan_dikdasmen" value="<?php echo $Guru->sk_pernyataan_ketentuan_dikdasmen; ?>">
															</div>
															<div class="form-group mb-0">
																<!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
</body>
</html>