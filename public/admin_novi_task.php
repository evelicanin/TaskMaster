<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php confirm_logged_in_as_admin(); ?>
<!-- header -->
<?php include("../includes/layouts/header.php"); ?>
<?php
$logovani_korisnik = $_SESSION["username"];
// ime i prezime logovanog admina ili operatera iz baze dohvatam na osnovu usernamea logovanog korisnika
$admin_ime_i_prezime = find_ime_i_prezime_logovanog_admina_ili_operatera($logovani_korisnik); 
$ime_i_prezime = mysqli_fetch_assoc($admin_ime_i_prezime);
?>
<!-- dohvatamo ime i prezime svih korisnika (da bi ih prikazali u dropdown listi -->
<?php $korisnici_set = find_ime_i_prezime_svih_korisnika(); ?>
<!-- dohvatamo ime i prezime svih operatera (da bi ih prikazali u dropdown listi -->
<?php $operateri_set = find_ime_i_prezime_svih_operatera(); ?>
<?php
if (isset($_POST['submit'])) {

	// Obrada forme	
	$naslov = mysql_prep($_POST["naslov"]);
	
	$kor = (int)$_POST['korisnik'];
	
	$tip = mysql_prep($_POST["tip"]);
	$oprema = mysql_prep($_POST["oprema"]);
	$pn = mysql_prep($_POST["pn"]);
	$sn = mysql_prep($_POST["sn"]);
	$opis = mysql_prep($_POST["opis"]);
	
	$ope = (int)$_POST['operater'];

				
	if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("admin_taskovi.php");
	}
	
	// insert u tabelu taskova
	$query  = "INSERT INTO taskovi (";
	$query .= " id_korisnik, id_operater, naslov, tip_uredjaja, dodatna_oprema, pn_broj, sn_broj, opis_problema, id_status";
	$query .= ") VALUES (";
	$query .= "  '{$kor}', '{$ope}', '{$naslov}', '{$tip}', '{$oprema}', '{$pn}', '{$sn}', '{$opis}', '1'";
	$query .= ")";
	$result = mysqli_query($connection, $query);
	
	if ($result)
	{
		// Success
		$_SESSION["message"] = "Novi task je kreiran.";
		redirect_to("admin_taskovi.php");
	} else {
		// Failure
		$_SESSION["message"] = "Došlo je do greške prilikom kreiranja operatera! Molimo ponovite proces.";
		redirect_to("admin_taskovi.php");
	}
	
} else {
	// This is probably a GET request
	//redirect_to("admin_novi_task.php");
	// ne radi nista
}
?>
<?php
	if (isset($connection)) { mysqli_close($connection); }
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
		
			<h1><span class="dark" style="text-align:center;">Novi task</span></h1>	
			<p class="warning">
			Za unos novog taska popunite formular ispod! Ukoliko pogriješite, dobit ćete upute za ispravan unos.
			</p>

			<form id="novi_task" action="admin_novi_task.php" method="post" name="novi_task">	
				<ul>
					<li>
						<label for="naslov">Naslov:</label>
						<input type="text" name="naslov" id="naslov" required class="required" >
					</li>						
					<li>
					    <label for="Korisnik">Korisnik kojem pripada task:</label>
						<select name="korisnik"> 
						    <option>Izaberite korisnika</option>
							<?php
                                while($korisnik = mysqli_fetch_assoc($korisnici_set))
                                {
									echo '<option>';
									echo htmlentities($korisnik["id_korisnik"]);
									echo ' ';
									echo htmlentities($korisnik["ime_prezime"]);
									echo '</option>';
							    }
							?>
						</select>						
					</li>	
					<li>
						<label for="tip">Tip uređaja:</label>
						<input type="text" name="tip" id="tip" required class="required" >
					</li>
					<li>
						<label for="oprema">Dodatna oprema:</label>
						<input type="text" name="oprema" id="oprema" >
					</li>						
					<li>
						<label for="pn">PN (product number):</label>
						<input type="text" name="pn" id="pn" required class="required" >
					</li>					
					<li>
						<label for="pn">SN (serial number):</label>
						<input type="text" name="sn" id="sn" required class="required" >
					</li>					
					<li>
						<label for="opis">Opis problema:</label>
						<textarea name="opis" id="opis" cols="100" rows="6" ></textarea>
					</li>						
					<li>
						<label for="Operator">Operater taska:</label>
						<select name="operater"> 
						    <option>Izaberite operatera</option>
							<?php
                                while($operater = mysqli_fetch_assoc($operateri_set))
                                {
									echo '<option>';
									echo htmlentities($operater["id_operater"]);
									echo ' ';
									echo htmlentities($operater["ime_prezime"]);
									echo '</option>';
							    }
							?>
						</select>		
					</li>						

					<li>
						<button type="submit" id="submit" name="submit"
                                style="font-size:28px;"						
						        class="submit 
								       btn btn-lg btn-block btn-primary 
									   dr-icon dr-icon-floppy-disk"
									   > &nbsp;Spasi
						</button>
					</li>	
				</ul>			
			</form>
		
		
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
<?php include("../includes/layouts/footer_admin_novi_task.php"); ?>