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

	$JadwalUjian = new JadwalUjian($db);
	$Ujian = new Ujian($db);
	$Penguji = new Penguji($db);
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
			// post jadwal ujian
			$JadwalUjian->id_jadwal_ujian = $_POST["id_jadwal_ujian"];
            $JadwalUjian->id_ujian = $_POST["id_ujian"];
			$JadwalUjian->tgl_ujian = $_POST["tgl_ujian"];
			$JadwalUjian->id_penguji = $_POST["id_penguji"];
			$JadwalUjian->tempat = $_POST["tempat"];

			if($JadwalUjian->insert()){
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Data Ujian</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div style="padding-right:15px;">
                        <!-- <a href="ujian-create"> -->
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button>
                        <!-- </a> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>ID Jadwal Ujian</th>
									<th>Ujian</th>
                                    <th>Tgl dan Waktu</th>
									<th>Penguji</th>
									<th>Tempat</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwalujians = $JadwalUjian->readAll(); while ($row = $jadwalujians->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$row['id_jadwal_ujian']?></td>
									<td><?=$row['nama_ujian']?></td>
                                    <td><?=$row['tgl_ujian']?></td>
									<td><?=$row['nama_penguji']?></td>
									<td><?=$row['tempat']?></td>
									<td>
                                        <!-- <a class="dropdown-item link-action" href="ujian-detail.php?id=<?php echo $row['id_jadwal_ujian']; ?>"><i class="dw dw-eye"></i> Detail</a> |  -->
										<a class="dropdown-item link-action" href="jadwal-ujian-update.php?id=<?php echo $row['id_jadwal_ujian']; ?>"><i class="dw dw-edit-1"></i> Edit</a> | 
										<a class="dropdown-item link-action" href="jadwal-ujian-delete.php?id=<?php echo $row['id_jadwal_ujian']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
                                <?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

                <!-- Modal Create-->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <form method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Jadwal Ujian</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- hidden form -->
									<input type="hidden" name="id_jadwal_ujian" value="<?php echo $JadwalUjian->getNewId(); ?>">
									<!-- hidden form -->
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Ujian<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<select class="custom-select col-12" name="id_ujian">
												<option selected disabled>Choose...</option>
												<?php $no=1; $ujians = $Ujian->readAll(); while ($row = $ujians->fetch(PDO::FETCH_ASSOC)) : ?>
													<option value="<?=$row['id_ujian']?>"><?=$row['nama']?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tanggal dan Waktu<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="datetime-local" class="form-control" name="tgl_ujian" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Penguji<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<select class="custom-select col-12" name="id_penguji">
												<option selected disabled>Choose...</option>
												<?php $no=1; $pengujis = $Penguji->readAll(); while ($row = $pengujis->fetch(PDO::FETCH_ASSOC)) : ?>
													<option value="<?=$row['id_penguji']?>"><?=$row['nama']?></option>
												<?php endwhile; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tempat<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="tempat" required>
										</div>
									</div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
