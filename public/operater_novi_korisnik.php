<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php confirm_logged_in_as_operater(); ?>
<!-- header -->
<?php include("../includes/layouts/header.php"); ?>
<?php
$logovani_korisnik = $_SESSION["username"];
// ime i prezime logovanog admina ili operatera iz baze dohvatam na osnovu usernamea logovanog korisnika
$admin_ime_i_prezime = find_ime_i_prezime_logovanog_admina_ili_operatera($logovani_korisnik); 
$ime_i_prezime = mysqli_fetch_assoc($admin_ime_i_prezime);
?>
<?php
if (isset($_POST['submit'])) {

	// Obrada forme	
	$name = mysql_prep($_POST["name"]);
	$lastname = mysql_prep($_POST["lastname"]);
	$username = mysql_prep($_POST["username"]);
	$telefon = mysql_prep($_POST["telefon"]);
	$email = mysql_prep($_POST["email"]);
	
	// dohvati password i kriptuj ga
	$hashed_password = password_encrypt($_POST["password"]);
			
	if (!empty($errors)) {
		$_SESSION["errors"] = $errors;
		redirect_to("operater_korisnici.php");
	}
	
	// insert u tabelu
	$query  = "INSERT INTO korisnici (";
	$query .= "  ime, prezime, username, telefon, email, hashed_password";
	$query .= ") VALUES (";
	$query .= "  '{$name}', '{$lastname}', '{$username}', '{$telefon}', '{$email}', '{$hashed_password}' ";
	$query .= ")";
	$result = mysqli_query($connection, $query);

	// insert u tabelu app_users
	$query2  = "INSERT INTO app_users (";
	$query2 .= " username, hashed_password, administrator, operater, korisnik";
	$query2 .= ") VALUES (";
	$query2 .= "  '{$username}', '{$hashed_password}', '0', '0', '1' ";
	$query2 .= ")";
	$result2 = mysqli_query($connection, $query2);		
	
	if ($result && $result2)
	{
		// Success
		$_SESSION["message"] = "Novi korisnik je kreiran.";
		redirect_to("operater_korisnici.php");
	} else {
		// Failure
		$_SESSION["message"] = "Došlo je do greške prilikom kreiranja korisnika! Molimo ponovite proces.";
		redirect_to("operater_korisnici.php");
	}
	
} else {
	// This is probably a GET request
	//redirect_to("admin_novi_korisnik.php");
	// ne radi nista
}
?>
<?php
	if (isset($connection)) { mysqli_close($connection); }
?>

<div class="container">
	
	<header id="navtop">
		<a href="operater.php" class="logo fleft">
			<img src="img/logo2.png" id="logoimg">
			<div class="fleft grid__item color-9">
				<a class="link link--ilin" href="operater.php"><span>TASK</span><span>MASTER</span></a>
			</div>
		</a>
		<nav class="fright cl-effect-5">
			<ul>
				<li>
					<a href="operater_korisnici.php" class="dr-icon dr-icon-users">
                        <span data-hover="Korisnici">Korisnici</span>
					</a>
				</li>
			</ul>		
			<ul>
				<li>
				    <a href="operater_taskovi.php" class="dr-icon dr-icon-paper-stack">
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

			<h1><span class="dark" style="text-align:center;">Novi korisnik</span></h1>	
			<p class="warning">
			Za unos novog taska popunite formular ispod! Ukoliko pogriješite, dobit ćete upute za ispravan unos.
			</p>	
			<form id="novi_korisnik" action="operater_novi_korisnik.php" method="post" name="novi_korisnik">	
				<ul>
					<li>
						<label for="name">Ime:</label>
						<input type="text" name="name" id="name" required class="required" >
					</li>					
					<li>
						<label for="lastname">Prezime:</label>
						<input type="text" name="lastname" id="lastname" required class="required" >
					</li>
					<li>
						<label for="username">Username:</label>
						<input type="text" name="username" id="username" required class="required" >
					</li>						
					<li>
						<label for="telefon">Telefon:</label>
						<input type="text" name="telefon" id="telefon" required class="required" >
					</li>					
					<li>
					    <label for="email">Email:</label>
						<input type="email" name="email" id="email" required placeholder="mail@gmail.com" class="required email">
					</li>						
					<li>
						<label for="password">Password:</label>
						<input type="password" name="password" id="password" required class="required" >
					</li>					
					<li>
						<label for="confirm_password">Ponovi password</label>
						<input id="confirm_password" name="confirm_password" type="password" >
					</li>						
					<li>
	                     <button type="submit" name="submit" 
						         value="Kreiraj korisnika" 
								 style="font-size:28px;"
								 class="btn btn-lg 
								 btn-block 
								 btn-primary 
								 dr-icon 
								 dr-icon-floppy-disk"
								> &nbsp;SPASI
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
				<?php echo $ime_i_prezime["ime_prezime"] ?>: <span class="blue">admin</span>
			</p>
			
<!-- footer -->
<?php include("../includes/layouts/footer_operater_novi_korisnik.php"); ?>
