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

<?php
$ned_taskovi_set = ukupno_nedodijeljeno_taskova();
$ned_task = mysqli_fetch_assoc($ned_taskovi_set);
?>
<?php
$ukupno_taskova = ukupno_taskova();
$broj_svih_taskova =  mysqli_fetch_assoc($ukupno_taskova);
?>
<?php $nedodijeljeni_taskovi = nedodijeljeni_taskovi();?>
<?php
$operateri_statistika = operater_statistika();
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
			<nav class="col-full cl-effect-1">
				<a class="effect" href="admin_reports.php">
						<span class="dr-icon dr-icon-arrow-left"></span>
				</a>
				<div class="style-zero"></div>
				<div class="style-one"></div>
				</br>
			</nav>

			<div class="panel panel-primary">
				<div class="panel-heading">
				<h3 class="panel-title">UKUPNO TASKOVA</h3>
				</div>
				<div class="panel-body">
						<div class="style-data"></div>
						UKUPNO TASKOVA : <span style="color:blue;"><?php echo htmlentities($broj_svih_taskova["num"]); ?></span>
						<div class="style-data"></div>
						UKUPNO NEDODIJELJENIH TASKOVA : <span style="color:RED;"><?php echo htmlentities($ned_task["num"]);?></span>
						<div class="style-data"></div>


				</div>
		  </div>




				<?php
					while($operater_stat = mysqli_fetch_assoc($operateri_statistika))
					{

						echo '<div class="panel panel-operater">';
							echo '<div class="panel-heading">';
							  echo '<h3 class="panel-title">'.htmlentities($operater_stat["IME_PREZIME"]).' : ukupno taskova : '.htmlentities($operater_stat["UKUPNO"]).'</h3>';
							echo '</div>';
					    echo '<div class="panel-body">';

										//echo htmlentities($operater_stat["IME_PREZIME"]).' : ukupno taskova : '.htmlentities($operater_stat["UKUPNO"]);
										//echo '<div class="style-data-black"></div>';
										echo 'OTVORENI TASKOVI : '.htmlentities($operater_stat["OTVORENO"]);
										echo '<div class="style-data-black"></div>';
										echo 'ANALIZIRANI TASKOVI : '.htmlentities($operater_stat["ANALIZIRANO"]);
										echo '<div class="style-data-black"></div>';
										echo 'PRIHVACENI TASKOVI : '.htmlentities($operater_stat["PRIHVACENO"]);
										echo '<div class="style-data-black"></div>';
										echo 'ODBIJENI TASKOVI : '.htmlentities($operater_stat["ODBIJENO"]);
										echo '<div class="style-data-black"></div>';
										echo 'ZAVRSENI TASKOVI : '.htmlentities($operater_stat["ZAVRSENO"]);
										echo '<div class="style-data-black"></div>';

						  echo '</div>';
				  	echo '</div>';

					}
				?>













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
