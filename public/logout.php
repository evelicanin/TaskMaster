<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	// v1: simple logout
	// session_start();
	/*
	if (isset($_SESSION["admin_id"]))    {$_SESSION["admin_id"] = null;     }	
	if (isset($_SESSION["operater_id"])) {$_SESSION["operater_id"] = null;	}	
	if (isset($_SESSION["korisnik_id"])) {$_SESSION["korisnik_id"] = null;	}	
	*/
	/*
	$_SESSION["admin_id"] = null;     	
	$_SESSION["operater_id"] = null;	
	$_SESSION["korisnik_id"] = null;		
	$_SESSION["username"] = null;		
	
	session_start();
	
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
	   setcookie(session_name(), '', time()-42000, '/');
	 }
	 */
    session_start();
    session_destroy();
    unset($_SESSION);
    session_regenerate_id(true);
    header('LOCATION: login.php');
?>

<?php
	// v2: destroy session
	// assumes nothing else in session to keep
	// session_start();
	// $_SESSION = array();
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
	// session_destroy(); 
	// redirect_to("login.php");
?>
