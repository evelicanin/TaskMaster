<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php
confirm_logged_in_as_operater(); ?>
<?php
$logovani_korisnik = $_SESSION["username"];
$admin_ime_i_prezime = find_ime_i_prezime_logovanog_admina_ili_operatera($logovani_korisnik);
$ime_i_prezime = mysqli_fetch_assoc($admin_ime_i_prezime);
?>
<?php

	$_SESSION["message"] = "";
	$_SESSION["message_level"] = "";

  $id_task = $_GET["id_task"];
	$komentar = $_GET["komentar"];
  $user_dodao_komentar = $ime_i_prezime["ime_prezime"];

	// mail lista za slanje maila o novom komentaru
	$task_mailovi_set = find_task_mail_list_operater($id_task);

	// pozivamo funkciju za dodavanje komentara
	$insert_result_kom = dodaj_komentar($id_task,$user_dodao_komentar,$komentar);

	if ($insert_result_kom && mysqli_affected_rows($connection) >= 0)
	{

		$akcija = 'NOVI KOMENTAR';

		// insert u tabelu historije
		$insert_ist  = "INSERT INTO task_istorija (";
		$insert_ist .= "  akcija, id_task, logovani_user, vrijeme_izmjene";
		$insert_ist .= ") VALUES (";
		$insert_ist .= "  '{$akcija}', '{$id_task}', '{$user_dodao_komentar}', now() ";
		$insert_ist .= ")";
		$insert_result_ist = mysqli_query($connection, $insert_ist);

		// slanje maila prema korisniku, operateru i adminu da je nesto izmjenjeno
		// ovo su aderse na koje treba da ide mail o izmjeni taska
			while($mailovi = mysqli_fetch_array($task_mailovi_set))
			{
					$adrese[] = $mailovi["email"];
			}
			$to = implode(", ", $adrese);

			$subject = "NOVI KOMENTAR OPERATERA";

			$message  = "------------------------------------------------------------------------------------------------------------------------";
			$message .= '<br /><br />';
			$message .= "MOLIMO DA NE ODGOVARATE NA OVU PORUKU PUTEM MAILA !!!";
			$message .= '<br /><br />';
			$message .= "------------------------------------------------------------------------------------------------------------------------";
			$message .= '<br /><br />';
			$message .= 'KOMENTAR OPERATERA';
			$message .= '<br />';
			$message .= 'task id : ' .$id_task;
			$message .= '<br />';
			$message .= $komentar;
			$message .= '<br /><br />';
			$message .= "PRIJAVITE SE NA APLIKACIJU : ";
			$message .= '<a href = "http://178.62.252.220/aplikacija/public/login.php">KLIKNITE OVDJE</a>';
			$message .= '<br /><br />';

			$headers  = 'From: taskmaster@mail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			mail($to,$subject,$message,$headers);

		// Success
		$_SESSION["message_level"] = "green";
		$_SESSION["message"] = "Uspješno ste dodali komentar!";

		 redirect_to("task_operater.php?id_task=$id_task");

	}
	else
	{

		// Failure
		$_SESSION["message_level"] = "red";
		$_SESSION["message"] = "Došlo je do greške !!!";
		redirect_to("task_operater.php?id_task=$id_task");
	}

?>
