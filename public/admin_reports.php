<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php confirm_logged_in_as_admin(); ?>

<?php include("../includes/layouts/header.php"); ?>
<?php
$logovani_korisnik = $_SESSION["username"];
$admin_ime_i_prezime = find_ime_i_prezime_logovanog_admina_ili_operatera($logovani_korisnik);
$ime_i_prezime = mysqli_fetch_assoc($admin_ime_i_prezime);
?>

<div class="container">

	<header id="navtop">
		<a href="admin.php" class="logo fleft">
			<img src="img/logo2.png" id="logoimg">
			<div class="fleft grid__item color-9">
				<a class="link link--ilin" href="admin.php"><span>TASK</span><span>MASTER</span></a>
			</div>
		</a>

		<nav class="fright cl-effect-5">
			<ul>
				<li>
				    <a href="admin_operateri.php" class="dr-icon dr-icon-head">
				        <span data-hover="Operateri">Operateri</span>
				    </a>
				</li>
			</ul>
			<ul>
				<li>
					<a href="admin_korisnici.php" class="dr-icon dr-icon-users">
                        <span data-hover="Korisnici">Korisnici</span>
					</a>
				</li>
			</ul>
			<ul>
				<li>
				    <a href="admin_taskovi.php" class="dr-icon dr-icon-paper-stack">
					    <span data-hover="Taskovi">Taskovi</span>
					</a>
				</li>
			</ul>
		    <ul>
				<li>
				    <a href="logout.php" class="dr-icon dr-icon-switch">
					    <span data-hover="Logout">Logout</span>
				    </a>
				</li>
			</ul>
		</nav>
	</header>

	<div class="container">
	    <div class="style-nav"></div>
			</br>
	    </br>

			<nav class="col-full cl-effect-1">

				<a class="effect" href="task_reports.php">
				  <span class="dr-icon dr-icon-file-text2"></span>
					<span class="dr-icon dr-icon-chart5">&nbsp;&nbsp;&nbsp;Statistika taskova</span>
				</a>

				<div class="style-zero"></div>
				<div class="style-one"></div>

				<a class="effect" href="operater_reports.php">
					  <span class="dr-icon dr-icon-head"></span>
				    <span class="dr-icon dr-icon-chart2">&nbsp;&nbsp;&nbsp;Statistika operatera</span>
				</a>

				<div class="style-zero"></div>
				<div class="style-one"></div>

				<a class="effect" href="korisnik_reports.php">
					  <span class="dr-icon dr-icon-user"></span>
				    <span class="dr-icon dr-icon-chart">&nbsp;&nbsp;&nbsp;Statistika korisnika</span>
				</a>

				<div class="style-zero"></div>
				<div class="style-one"></div>


			</nav>




	</div> <!--main-->

	</br>
	</br>
	</br>

    <div class="style-nav"></div>
			<p class="fright dr-icon dr-icon-user">
				<?php echo $ime_i_prezime["ime_prezime"] ?>
				: <span class="blue">admin</span>
			</p>
</div>



<!-- footer -->
<?php include("../includes/layouts/footer.php"); ?>
