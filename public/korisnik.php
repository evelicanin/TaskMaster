<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in_as_korisnik(); ?>
<!-- header -->
<?php include("../includes/layouts/header.php"); ?>
<?php 
$logovani_korisnik = $_SESSION["username"];
$taskovi_set = find_all_taskovi_korisnika($logovani_korisnik); 
$korisnik_ime_i_prezime = find_ime_i_prezime_logovanog_korisnika($logovani_korisnik); 
$ime_i_prezime = mysqli_fetch_assoc($korisnik_ime_i_prezime);
?>
<?php 



if(isset($_POST['reset-submit'])) 
{
	$password = mysql_prep($_POST["signin-password"]);
	$new_password = mysql_prep($_POST["signin-password-new"]);
	$confirm_password = mysql_prep($_POST["confirm_password"]);
	
	$hashed_password_new = password_encrypt($_POST["signin-password-new"]);
		
	$found_korisnik = attempt_login_as_korisnik($logovani_korisnik, $password);
		
	if ((!has_presence($password)) or (!has_presence($new_password))  or (!has_presence($confirm_password)) )
	{
      // Failure - ako nije popunjana cijela forma
	  $_SESSION["message_level"] = "red"; 
      $_SESSION["message"] = "Morate popuniti sva polja formulara !!!";
    }
	else if (!$found_korisnik) 
	{          
        // Failure - nije unesen ispravan trenutni password
	    $_SESSION["message_level"] = "red"; 
        $_SESSION["message"] = "Pogriješili ste kod unosa Vaše trenutne lozinke !!!"; 
	} 	
	else if ($found_korisnik) 
	{          
        if ($new_password != $confirm_password)
		{
	    $_SESSION["message_level"] = "red"; 
	    $_SESSION["message"] = "Niste ponovili novu lozinku ispravno, polja se ne slažu !!!"; 	
		}
		else if ($new_password == $confirm_password)
		{
			// ovdje dodati funkciju(e) koja radi update passworda u app_users i u korisnici
			$query  = "UPDATE korisnici SET ";
			$query .= "hashed_password = '{$hashed_password_new}' ";
			$query .= "WHERE username = '{$logovani_korisnik}' ";
			$query .= "LIMIT 1";
			
			$result = mysqli_query($connection, $query);
	
			$query2  = "UPDATE app_users SET ";
			$query2 .= "hashed_password = '{$hashed_password_new}' ";
			$query2 .= "WHERE username = '{$logovani_korisnik}' ";
			$query2 .= "LIMIT 1";
			
			$result2 = mysqli_query($connection, $query2);			
			
			if (($result && mysqli_affected_rows($connection) >= 0) and  ($result2 && mysqli_affected_rows($connection) >= 0) )
			{
				// Success
	            $_SESSION["message_level"] = "green"; 
				$_SESSION["message"] = "Uspješno promjenjena lozinka !!!";
			} else 
			{
				// Failure
			    $_SESSION["message_level"] = "red"; 
				$_SESSION["message"] = "Neuspješno promjenjena lozinka !!!";
			}
			
		}
	} 
}
else {
  // This is probably a GET request
} // end: if (isset($_POST['reset-submit']))

?>

<div class="container">

	<header id="navtop">
		<a href="korisnik.php" class="logo fleft">
			<img src="img/logo2.png" id="logoimg">
			<div class="fleft grid__item color-9">
				<a class="link link--ilin" href="korisnik.php"><span>TASK</span><span>MASTER</span></a>
			</div>
		</a>
		<nav class="main-nav fright cl-effect-5">
			<ul>
				<!-- linkovi koji pozivaju modal -->
				<li>
					<a href="#0" 
					   class="dr-icon dr-icon-lock2 cd-reset ">
					   <span data-hover="Promjena lozinke">Promjena lozinke</span>
					</a>
				</li>
			</ul>		
    <!-- kod liste iznad, li > a je dobio klasu cd-reset > zove modal za password -->		
	<!-- kod liste ispod, li > a > span je dobio klasu cd-contact -->	
	<!-- jer ako dodijelim klasu cd-contact elementu li > a	-->
	<!-- onda ne zna da presalta tab sa prvog na drugi (password na kontakt -->			
	<!-- li iz prvog ul-a mora biti po strukturi drugaciji od li iz drugog ul-a -->			
			<ul>
				<!-- linkovi koji pozivaju modal -->
				<li>
				    <a href="#0" 
					class="dr-icon dr-icon-mail" >
					<span class="cd-contact" data-hover="Kontakt">Kontakt</span>
					</a>
				</li>
			</ul>			
			<ul>
				<li>
					<a href="logout.php" 
					   class="cd-contact dr-icon dr-icon-switch">
					   <span data-hover="Logout">Logout</span>
					</a>
				</li>
			</ul>
		</nav>
	</header>
		
	<!-- modal -->
	<div class="cd-user-modal"> <!-- modalni prozor za promjenu passworda ili slanje maila -->
		<div class="cd-user-modal-container"> <!-- modalov kontejner -->
			<ul class="cd-switcher">
				<li><a href="#0">Promjena lozinke</a></li>
				<li><a href="#0">Kontakt</a></li>
			</ul>

			<div id="cd-reset"> <!-- reset password forma -->
				<form class="cd-form" id="reset_pass" name="reset_pass" action="korisnik.php" method="post">				
					<p class="fieldset">
						<label class="normaltext">
                        Da biste promijenili Vašu lozinku, potrebno je da
						unesete Vašu trenutno aktivnu lozinku, zatim unesete
                        novu lozinku i zatim ponovite unos nove lozinke 
						i kliknete na 'SPASI'.
					    Promjenom lozinke s Vaše strane postajete jedina osoba koja zna lozinku
						jer se lozinka šifrira i čuva u bazi u šifriranom obliku tako da niko ne može pročitati istu.
						</label>
					</p>
					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" 
						       id="signin-password" 
						       name="signin-password" 
							   type="text"  
							   placeholder="Trenutna lozinka">
						<a href="#0" class="hide-password">Sakrij</a>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" 
						       id="signin-password-new" 
						       name="signin-password-new" 
							   type="text"  
							   placeholder="Nova lozinka">
						<a href="#0" class="hide-password">Sakrij</a>
					</p>
					
					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" 
						       id="confirm_password" 
						       name="confirm_password" 
							   type="text"  
							   placeholder="Ponovi novu lozinku">
						<a href="#0" class="hide-password">Sakrij</a>
					</p>
					

	                     <button type="submit" name="reset-submit" 
						         value="Spasi" 
								 style="font-size:28px;"
								 class="btn btn-lg 
								 btn-block 
								 btn-primary
								 dr-icon 
								 dr-icon-check"
								> SPASI
						</button>				

				</form>
			</div> <!-- cd-reset -->

			<div id="cd-contact"> <!-- sign up form -->
				<form class="cd-form" name="contactform" id="contactform" action="contact-us.php" method="post">
					<p class="fieldset">
						<label class="normaltext">
						Ukoliko imate bilo kakvih dodatnih pitanja, stojimo Vam na raspolaganju. Popunite formular ispod i Vaša poruka će biti proslijeđena našem glavnom administratoru.
						Odgovor ćete dobiti na dole navedenu e-mail adresu.
						</label>
					</p>
					<p class="fieldset">
						<label class="image-replace cd-username" for="signup-name">
						Ime i prezime</label>
						<input class="full-width has-padding has-border" 
							   id="signup-name" 
							   name="signup-name" 
							   type="text" placeholder="Unesite svoje ime i prezime">
					</p>
					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-mail</label>
						<input class="full-width has-padding has-border" 
						       id="signup-email" 
							   name="signup-email"
							   type="email" 
							   placeholder="Unesite Vaš e-mail">
					</p>
					<p class="fieldset">
						<label for="signup-message" style="font-size:18px;">
						Unesite vašu poruku</label>
		    <textarea id="signup-message" name="signup-message" class="full-width has-padding has-border"></textarea>
					</p>
	                     <button type="submit" name="contact-submit" id="contact-submit"
						         value="Spasi" 
								 style="font-size:28px;"
								 class="btn btn-lg 
								 btn-block 
								 btn-primary
								 dr-icon 
								 dr-icon-check"
								> posalji
						</button>	
				</form>
			</div> <!-- cd-contact -->
			
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->
	<!-- modal -->

	<div class="container">

	    <div class="style-nav"></div>
				<!--<h2>Taskovi</h2>-->
                <h1><span class="dark">TASKOVI</span></h1>
					<?php			
				    // ako je korisnik kreiran, ili ako je doslo do greske
					// izbaci alert-success (zeleni message koji se pojavi nakon redirecta)
                    if (has_presence($_SESSION["message"])	)
                    {		
                        if ($_SESSION["message_level"] === "red")
						{					
							 echo   
								'<div class="alert alert-dismissible alert-danger">
								<button type="button" class="close" data-dismiss="alert">×</button>'
								;
							 echo  message();	
							 echo  '</div>';
						}
						else if ($_SESSION["message_level"] === "green")
						{					
							 echo   
								'<div class="alert alert-dismissible alert-success">
								<button type="button" class="close" data-dismiss="alert">×</button>'
								;
							 echo  message();	
							 echo  '</div>';
						}
				    }
			    ?>			
				<button style="font-size:16px; margin-right:5px;" class="xls_save dr-icon dr-icon-file-excel btn btn-default ">&nbsp;&nbsp;xls</button>
				<button style="font-size:16px;" class="pdf_save dr-icon dr-icon-file-pdf btn btn-default ">&nbsp;&nbsp;pdf</button>						

				
				<?php $errors = errors(); ?>
		        <?php echo form_errors($errors); ?>		
  	 
	            <?php echo'	
			        <div class="search_div">
					<input type="text" class="search_input" name="search" id="id_search" placeholder="Pretraga taskova ..."/>
					<span style="font-size:20px;margin-left:5px;" class="dr-icon dr-icon-search"></span>								
				    </div>		



				
					<table class="table table-striped table-hover table-responsive sortable  searchable css_class">
					    <thead>
							<tr>
							  <th>ID</th>
							  <th>NASLOV</th>
							  <th>OPERATER</th>
							</tr>
					    </thead>
						<tbody>
							<tr id="noresults">
								<td>Nema takvih slogova !!!</td>
							</tr>
						';
                ?>
				
				<?php while($task = mysqli_fetch_assoc($taskovi_set)) { ?>
				<?php $id_task = $task["id_task"]; ?>
				  <tr>
					<td><?php echo htmlentities($task["id_task"]); ?></td>
					<td><?php echo '<a href="'. 'task_korisnik.php?id_task='.$id_task. '">' .htmlentities($task["naslov"]).'</a>'; ?></td>
					<td><?php echo htmlentities($task["imeoperatera"]); ?></td>
				  </tr>
				<?php } ?>
                <?php echo' 
					</tbody>
					</table>';
				?>

	</div> <!--main-->
	<div class="style-nav"></div>
			<p class="fright dr-icon dr-icon-user">
				<?php echo $ime_i_prezime["ime_prezime"] ?>
				: <span class="blue">logovani korisnik</span>
			</p>
</div> 

<!-- footer -->
<?php include("../includes/layouts/footer.php"); ?>
