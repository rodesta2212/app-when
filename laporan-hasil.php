<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/jadwal-guru.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $JadwalGuru = new JadwalGuru($db);
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
						<h4 class="text-blue h4"><i class="dw dw-analytics-11"></i> Laporan Hasil Seleksi</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
                                    <th>No</th>
									<th>Nama Guru</th>
                                    <th>Nilai Rata - Rata</th>
                                    <th>Status</th>
								</tr>
							</thead>
							<tbody>
                            <?php $no=1; $jadwalgurus = $JadwalGuru->readAllHasil(); while ($row = $jadwalgurus->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
                                    <td><?=$no?></td>
									<td><?=$row['nama_guru']?></td>
                                    <td><?=$row['avg_nilai']?></td>
                                    <td><?=$row['keterangan']?></td>
								</tr>
                                <?php $no++; endwhile; ?>
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
