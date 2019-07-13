
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
$_SESSION["message"] = "";  //inicijalizacija poruke, tj. postavljamo da je prazna, da je nema
$username = "";

if (isset($_POST['submit'])) 
{
  // Process the form
  
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$found_admin    = attempt_login_as_admin($username, $password);
	$found_operater = attempt_login_as_operater($username, $password);
	$found_korisnik = attempt_login_as_korisnik($username, $password);
	
    if ((!has_presence($username)) or (!has_presence($password)) )
	{
      // Failure - ako assword ili username nije unesen
      $_SESSION["message"] = "Korisničko ime i/ili lozinka moraju biti uneseni !!! ";
    }	
    else if ($found_admin) 
	{
      // Success - logovan kao administrator
			// Mark user as logged in
			$_SESSION["admin_id"] = $found_admin["id_user"];
			$_SESSION["username"] = $found_admin["username"];
            redirect_to("admin.php");
    } 
    else if ($found_operater) 
	{
		// Success - logovan kao operater
			// Mark user as logged in 
			$_SESSION["operater_id"] = $found_operater["id_user"];
			$_SESSION["username"] = $found_operater["username"];
		    redirect_to("operater.php");	  
	} 	    
	else if ($found_korisnik) 
	{
		// Success - logovan kao korisnik
			// Mark user as logged in
			$_SESSION["korisnik_id"] = $found_korisnik["id_user"];
			$_SESSION["username"] = $found_korisnik["username"];
		    redirect_to("korisnik.php");	  
	} 	
	else 
	{
      // Failure
      $_SESSION["message"] = "Korisničko ime i/ili lozinka ne postoje! Molimo unesite ispravne podatke. ";
    }
  //}// if errors
} // isset 
else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>TASKMASTER // by ITS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="shortcut icon" type="image/png" href="favicon.png">
    
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootswatch.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body style="margin:0; padding:0;">
	
	<div class="limiter fadeInUp">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-43">
						Korisnička prijava
					</span>
					<div class="text-center w-full p-t-23">
                        <?php			
                            // ako je korisnik kreiran, ili ako je doslo do greske
                            // izbaci alert-success (zeleni message koji se pojavi nakon redirecta)
                            if (has_presence($_SESSION["message"])	)
                            {					
                             echo '<div class="alert alert-dismissible alert-danger">';
                             echo  message();	
                             echo  '</div>';
                             }
                        ?>	  
					</div>					
					<div class="wrap-input100 rs1 validate-input" data-validate = "Obavezno">
                        <input name="username" type="text" class="input100" value="<?php echo htmlentities($username); ?>" onfocus="this.value=''" />
						<span class="label-input100">Korisničko ime</span>
					</div>
					
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Obavezno">
                        <input name="password" type="password" class="input100" value="" onfocus="this.value=''" />
						<span class="label-input100">Lozinka</span>
					</div>

					<div class="container-login100-form-btn">
                        <input type="submit" name="submit" value="Prijava" class="login100-form-btn" />
					</div>
                                                        
				</form>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>