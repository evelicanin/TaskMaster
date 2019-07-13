<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php confirm_logged_in_as_operater(); ?>
<!-- header -->
<?php include("../includes/layouts/header.php"); ?>
<?php 
$logovani_korisnik = $_SESSION["username"];

// ime i prezime logovanog admina ili operatera iz baze dohvatam na osnovu 
// usernamea logovanog korisnika
$admin_ime_i_prezime = find_ime_i_prezime_logovanog_admina_ili_operatera($logovani_korisnik); 
$ime_i_prezime = mysqli_fetch_assoc($admin_ime_i_prezime);

$korisnici_set = find_all_korisnici(); // svi korisnici aplikacije iz baze 
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
					<a href="operater_korisnici.php" 
					   class="dr-icon dr-icon-users">
                       <span data-hover="Korisnici">Korisnici</span>
					</a>
				</li>
			</ul>		
			<ul>
				<li>
				    <a href="operater_taskovi.php" 
					   class="dr-icon dr-icon-paper-stack">
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
			<a  href="operater_novi_korisnik.php"
			     style="font-size:16px; margin-right:5px;" 
			     class="col-full dr-icon dr-icon-user btn btn-lg btn-default ">
				 &nbsp;&nbsp;+ Dodaj korisnika
			</a>	

			
				<!--<h2>Korisnici</h2>-->
                <h1><span class="dark">KORISNICI</span></h1>
				<?php			
				    // ako je korisnik kreiran, ili ako je doslo do greske
					// izbaci alert-success (zeleni message koji se pojavi nakon redirecta)
                    if (has_presence($_SESSION["message"])	)
                    {					
					 echo   
						'<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>'
						;
					 echo  message();	
					 echo  '</div>';
					 }
			    ?>
				
				<?php $errors = errors(); ?>
		        <?php echo form_errors($errors); ?>	
				<button style="font-size:16px; margin-right:5px;" class="xls_save dr-icon dr-icon-file-excel btn btn-default ">&nbsp;&nbsp;xls</button>
				<button style="font-size:16px;" class="pdf_save dr-icon dr-icon-file-pdf btn btn-default ">&nbsp;&nbsp;pdf</button>						
				
	            <?php echo'	
			        <div class="search_div">
					<input type="text" class="search_input" name="search" id="id_search" placeholder="Pretraga korisnika ..."/>
					<span style="font-size:20px;margin-left:5px;" class="dr-icon dr-icon-search"></span>								
				    </div>							
					<table class="table table-striped table-hover sortable resizable searchable css_class">
					    <thead>
							<tr>
							  <th>IME I PREZIME</th>
							  <th>USERNAME</th>
							</tr>
					    </thead>
						<tbody>
							<tr id="noresults">
								<td>Nema takvih slogova !!!</td>
							</tr>
						';
                ?>
				
				<?php while($korisnik = mysqli_fetch_assoc($korisnici_set)) { ?>
				  <tr>
					<td><?php echo htmlentities($korisnik["ime"]).' '.htmlentities($korisnik["prezime"]); ?></td>
					<td><?php echo '<a href="#">' .htmlentities($korisnik["username"]).'</a>'; ?></td>	
				  </tr>
				<?php } ?>
                <?php echo' 
					</tbody>
					</table>';
				?>
				

			
	</div> <!--main-->
	</br>
	</br>
	</br>
	
    <div class="style-nav"></div>
			<p class="fright dr-icon dr-icon-user">
				<?php echo $ime_i_prezime["ime_prezime"] ?>
				: <span class="blue">operater</span>
			</p>
</div>
<!-- footer -->
<?php include("../includes/layouts/footer.php"); ?>