<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal-guru.inc.php');
	include_once('includes/jadwal-ujian.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$JadwalGuru = new JadwalGuru($db);
	$JadwalUjian = new JadwalUjian($db);
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

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Jadwal</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Guru</th>
									<th>Ujian</th>
                                    <th>Tgl dan Waktu</th>
									<th>Penguji</th>
									<th>Tempat</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwalgurus = $JadwalGuru->readAll(); while ($row = $jadwalgurus->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=$row['nama_guru']?></td>
									<td><?=$row['nama_ujian']?></td>
                                    <td><?=$row['tgl_ujian']?></td>
									<td><?=$row['nama_penguji']?></td>
									<td><?=$row['tempat']?></td>
									<td><?=$row['status']?></td>
									<td>
										<?php if($row['status'] != 'verifikasi'): ?>
											<a class="dropdown-item link-action" href="jadwal-guru-update.php?id=<?php echo $row['id_jadwal_guru']; ?>"><i class="dw dw-edit-1"></i> Verifikasi</a> | 
										<?php endif; ?>
										<a class="dropdown-item link-action" href="jadwal-guru-delete.php?id=<?php echo $row['id_jadwal_guru']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
								<?php 
									$no++;
									endwhile; 
								?>
							</tbody>
						</table>
					</div>
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
