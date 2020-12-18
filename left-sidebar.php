    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<?php if ($_SESSION['role'] == 'dikdasmen'): ?>
						<!-- Dikdasmen -->
						<li>
							<a href="guru.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-mortarboard"></span><span class="mtext">Guru</span>
							</a>
						</li>
						<li>
							<a href="penguji.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-pencil"></span><span class="mtext">Penguji</span>
							</a>
						</li>
						<li>
							<a href="jadwal-ujian.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Jadwal Ujian</span>
							</a>
						</li>
					<?php elseif ($_SESSION['role'] == 'guru'): ?>
						<!-- Guru -->
						<li>
							<a href="jadwal-ujian.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Jadwal Ujian</span>
							</a>
						</li>
						<li>
							<a href="hasil-ujian.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-analytics5"></span><span class="mtext">Hasil Ujian</span>
							</a>
						</li>
					<?php else: ?>
						<!-- Penguji -->
						<li>
							<a href="jadwal-ujian.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Jadwal Ujian</span>
							</a>
						</li>
						<li>
							<a href="hasil-ujian.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-analytics5"></span><span class="mtext">Hasil Ujian</span>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>