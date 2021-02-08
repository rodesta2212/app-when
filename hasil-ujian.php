<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal-guru.inc.php');
	include_once('includes/jadwal-ujian.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$JadwalGuru = new JadwalGuru($db);
	$JadwalGuru->id_guru = $id;
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
									<th>Ujian</th>
                                    <th>Tgl dan Waktu</th>
									<th>Tempat</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $jadwalgurus = $JadwalGuru->readAllNilai(); while ($row = $jadwalgurus->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=$row['nama_ujian']?></td>
                                    <td><?=$row['tgl_ujian']?></td>
									<td><?=$row['tempat']?></td>
									<td>
										<?php if($row['nilai'] == null): ?>
											Belum di nilai
										<?php elseif($row['nilai'] >= $row['nilai_lulus']): ?>
											<?=$row['nilai']?>
										<?php elseif($row['nilai'] < $row['nilai_lulus']): ?>
											Tidak Lulus
										<?php endif; ?>
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
