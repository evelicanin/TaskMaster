<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php confirm_logged_in_as_korisnik(); ?>
<?php
$logovani_korisnik = $_SESSION["username"];
?>
<?php

$_SESSION["message"] = "";
$_SESSION["message_level"] = "";

if(isset($_POST['contact-submit']))
{

    $email_to = "velicanin.edis@gmail.com";
    $email_subject = "Kontakt poruka od strane korisnika : ".$logovani_korisnik;

    function died($error)
	{
		echo 'html';// ovdje moze bruka html-a da se ubaci

		// your error code can go here
		echo $error;
		// echo "Please go back and fix these errors.<br /><br />";
		die();
    }

    // validation expected data exists

    if(
	    !isset($_POST['signup-name']) ||
      !isset($_POST['signup-email']) ||
		  !isset($_POST['signup-message'])
       )
	{
      // died('Morate popuniti navedena polja formulara !!!');
      // Failure - ako nije popunjana cijela forma
	  $_SESSION["message_level"] = "red";
    $_SESSION["message"] = "Morate popuniti sva polja kontakt formulara !!!";
	  redirect_to("korisnik.php");
    }

    $signup_name = mysql_prep($_POST['signup-name']); // required
    $email_from = mysql_prep($_POST['signup-email']); // required
    $signup_message = mysql_prep($_POST['signup-message']); // required

    $error_message = "";
    $string_exp = "/^[A-Za-z .'-]+$/";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (
	(!preg_match($string_exp,$signup_name))or
    (!preg_match($email_exp,$email_from)) or
    (strlen($signup_message) < 2)
	)
	{
      // $error_message .= 'Neispravno popunjena forma !!! ';
	  $_SESSION["message_level"] = "red";
    $_SESSION["message"] = "Niste ispravno popunili formu. Molimo ponovite unos.";
	  redirect_to("korisnik.php");
	}


 // edis
 /*
  if(strlen($error_message) > 0)
  {
    died($error_message);
  }
 */

    $email_message = "\n\n";

    function clean_string($string)
	{
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Ime i prezime korisnika: ".clean_string($signup_name)."\n";
    $email_message .= "E-mail adresa korisnika: ".clean_string($email_from)."\n";
    $email_message .= "Poruka korisnika: ".clean_string($signup_message)."\n";

// create email headers

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $email_message, $headers);
	    $_SESSION["message_level"] = "green";
      $_SESSION["message"] = "Uspješno ste proslijedili poruku adminstratoru. ";
      redirect_to("korisnik.php");

?>



<!-- include your own success html here -->



<?php

}

?>
