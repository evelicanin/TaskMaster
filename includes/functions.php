<?php

/////////////////////////////////////////////////////////////////////////////////
// FUNKCIJA ZA REDIREKCIJU  ////////////////////////////////////////////////////
	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

/////////////////////////////////////////////////////////////////////////////////
// PROVJERA POLJA NA FORMI (IMA/NEMA UNOS) /////////////////////////////////////
	function has_presence($value) {
		return isset($value) && $value !== "";
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// PASSWORD KRIPTOVANJE ////////////////////////////////////////////////////////////////////////////////
	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length) {
		// Not 100% unique, not 100% random, but good enough for a salt
		// MD5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));

	    // Valid characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

        // But not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+', '.', $base64_string);

	    // Truncate string to the correct length
		$salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

/////////////////////////////////////////////////////////////////////////////////
//// LOGIN ALL FUNCTIONS ////////////////////////////////////////////////////////
//// LOGIN AS ADMIN f-je ////////////////////////////////////////////////////////
	function attempt_login_as_admin($username, $password)
	{
		$admin = find_admin_by_username($username);
		if ($admin)
		{
			// found admin, now check password
			if (password_check($password, $admin["hashed_password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		}
		else
		{
			// admin not found
			return false;
		}
	}
		function find_admin_by_username($username) {
			global $connection;

			$safe_username = mysqli_real_escape_string($connection, $username);

			$query  = "SELECT * ";
			$query .= "FROM app_users ";
			$query .= "WHERE username = '{$safe_username}' ";
			$query .= "AND administrator = 1 ";
			$query .= "LIMIT 1";
			$admin_set = mysqli_query($connection, $query);
			confirm_query($admin_set);
			if($admin = mysqli_fetch_assoc($admin_set)) {
				return $admin;
			} else {
				return null;
			}
		}
//// LOGIN AS OPERATER f-je ////////////////////////////////////////////////////////
	function attempt_login_as_operater($username, $password)
	{
		$operater = find_operater_by_username($username);
		if ($operater)
		{
			// found admin, now check password
			if (password_check($password, $operater["hashed_password"])) {
				// password matches
				return $operater;
			} else {
				// password does not match
				return false;
			}
		}
		else
		{
			// admin not found
			return false;
		}
	}
		function find_operater_by_username($username) {
			global $connection;

			$safe_username = mysqli_real_escape_string($connection, $username);

			$query  = "SELECT * ";
			$query .= "FROM app_users ";
			$query .= "WHERE username = '{$safe_username}' ";
			$query .= "AND administrator = 0 ";
			$query .= "AND operater = 1 ";
			$query .= "LIMIT 1";
			$operater_set = mysqli_query($connection, $query);
			confirm_query($operater_set);
			if($operater = mysqli_fetch_assoc($operater_set)) {
				return $operater;
			} else {
				return null;
			}
		}
//// LOGIN AS KORISNIK f-je ////////////////////////////////////////////////////////
	function attempt_login_as_korisnik($username, $password)
	{
		$korisnik = find_korisnik_by_username($username);
		if ($korisnik)
		{
			// found admin, now check password
			if (password_check($password, $korisnik["hashed_password"])) {
				// password matches
				return $korisnik;
			} else {
				// password does not match
				return false;
			}
		}
		else
		{
			// admin not found
			return false;
		}
	}
		function find_korisnik_by_username($username) {
			global $connection;

			$safe_username = mysqli_real_escape_string($connection, $username);

			$query  = "SELECT * ";
			$query .= "FROM app_users ";
			$query .= "WHERE username = '{$safe_username}' ";
			$query .= "AND korisnik = 1 ";
			$query .= "LIMIT 1";
			$korisnik_set = mysqli_query($connection, $query);
			confirm_query($korisnik_set);
			if($korisnik = mysqli_fetch_assoc($korisnik_set)) {
				return $korisnik;
			} else {
				return null;
			}
		}


	function mysql_prep($string) {
		global $connection;

		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

	function find_all_korisnici() {
		global $connection;

		$query  = "SELECT * ";
		$query .= "FROM korisnici ";
		$query .= "ORDER BY id_korisnik ASC";
		$korisnici_set = mysqli_query($connection, $query);
		confirm_query($korisnici_set);
		return $korisnici_set;
	}

	function find_ime_i_prezime_svih_korisnika() {
		global $connection;

		$query  = "SELECT id_korisnik, concat(ime,' ',prezime)ime_prezime ";
		$query .= "FROM korisnici ";
		$query .= "ORDER BY id_korisnik ASC";
		$korisnici_set = mysqli_query($connection, $query);
		confirm_query($korisnici_set);
		return $korisnici_set;
	}
	function find_ime_i_prezime_logovanog_korisnika($username) {
		global $connection;

		$safe_username = mysqli_real_escape_string($connection, $username);

		$query  = "SELECT id_korisnik, concat(ime,' ',prezime)ime_prezime ";
		$query .= "FROM korisnici ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "ORDER BY id_korisnik ASC";
		$korisnik_set = mysqli_query($connection, $query);
		confirm_query($korisnik_set);
		return $korisnik_set;
	}
	function find_ime_i_prezime_logovanog_admina_ili_operatera($username) {
		global $connection;

		$safe_username = mysqli_real_escape_string($connection, $username);

		$query  = "SELECT concat(ime,' ',prezime)ime_prezime ";
		$query .= "FROM operateri ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$operater_set = mysqli_query($connection, $query);
		confirm_query($operater_set);
		return $operater_set;
	}

	function find_all_operateri() {
		global $connection;

		$query  = "SELECT * ";
		$query .= "FROM operateri ";
		$query .= "ORDER BY id_operater ASC";
		$operater_set = mysqli_query($connection, $query);
		confirm_query($operater_set);
		return $operater_set;
	}

	function find_ime_i_prezime_svih_operatera() {
		global $connection;

		$query  = "SELECT id_operater, concat(ime,' ',prezime)ime_prezime ";
		$query .= "FROM operateri ";
		$query .= "ORDER BY id_operater ASC";
		$operater_set = mysqli_query($connection, $query);
		confirm_query($operater_set);
		return $operater_set;
	}
    // ako je logovan admin, dohvati sve taskve svih korisnika
	function find_all_taskovi() {
		global $connection;

		$query  = "SELECT t.id_task id_task, t.naslov naslov, concat(k.ime,' ',k.prezime) imekorisnika, concat(o.ime,' ',o.prezime) imeoperatera  ";
		$query .= "FROM taskovi t, korisnici k, operateri o ";
		$query .= "WHERE t.id_korisnik = k.id_korisnik ";
		$query .= "AND t.id_operater = o.id_operater ";
		$query .= "ORDER BY id_task ASC";
		$taskovi_set = mysqli_query($connection, $query);
		confirm_query($taskovi_set);
		return $taskovi_set;
	}
	function find_task_by_id($id_task) {
		global $connection;

		$query  = "SELECT concat(k.ime,' ',k.prezime) ime_korisnika,k.username username_korisnika,k.email korisnik_email,k.telefon korisnik_telefon,concat(o.ime,' ',o.prezime) ime_operatera,o.username username_operatera,o.id_operater id_operatera, o.email email_operatera, t.id_task, t.naslov, t.tip_uredjaja, t.dodatna_oprema, t.pn_broj, t.sn_broj,t.opis_problema,t.task_start,t.task_rok,t.task_end, s.id_status id_status, s.status status ";
		$query .= "FROM taskovi t, korisnici k, operateri o, task_statusi s ";
		$query .= "WHERE t.id_korisnik = k.id_korisnik ";
		$query .= "AND t.id_operater = o.id_operater ";
		$query .= "AND t.id_status = s.id_status ";
		$query .= "AND t.id_task = '{$id_task}' ";
		$query .= "LIMIT 1";

		$task_set = mysqli_query($connection, $query);
		confirm_query($task_set);
		return $task_set;
	}
    // ako je logovan korisnik, dohvati sve taskve tog korisnika
	function find_all_taskovi_korisnika($username) {
		global $connection;

        $logovani_korisnik  = mysqli_real_escape_string($connection, $username);

		$query  = "SELECT t.id_task id_task, t.naslov naslov,  concat(k.ime,' ',k.prezime) imekorisnika, concat(o.ime,' ',o.prezime) imeoperatera  ";
		$query .= "FROM taskovi t, korisnici k, operateri o ";
		$query .= "WHERE t.id_korisnik = k.id_korisnik ";
		$query .= "AND t.id_operater = o.id_operater ";
		$query .= "AND k.username = '{$logovani_korisnik}' ";
		$query .= "ORDER BY id_task ASC";
		$taskovi_set = mysqli_query($connection, $query);
		confirm_query($taskovi_set);
		return $taskovi_set;
	}
    // ako je logovan operater, dohvati sve taskve tog operatera
	function find_all_taskovi_operatera($username) {
		global $connection;

        $logovani_korisnik  = mysqli_real_escape_string($connection, $username);

		$query  = "SELECT t.id_task id_task, t.naslov naslov,  concat(k.ime,' ',k.prezime) imekorisnika, concat(o.ime,' ',o.prezime) imeoperatera ";
		$query .= "FROM taskovi t, korisnici k, operateri o ";
		$query .= "WHERE t.id_korisnik = k.id_korisnik ";
		$query .= "AND t.id_operater = o.id_operater ";
		$query .= "AND o.username = '{$logovani_korisnik}' ";
		$query .= "ORDER BY id_task ASC";
		$taskovi_set = mysqli_query($connection, $query);
		confirm_query($taskovi_set);
		return $taskovi_set;
	}
	// admin updatuje task
	function admin_update_task($oper,$stat,$rok,$id_task) {
		global $connection;

		$query  = "UPDATE taskovi SET ";
		$query .= "id_operater = {$oper}, ";
		$query .= "task_rok = '{$rok}', ";
		$query .= "id_status = {$stat} ";
		$query .= "WHERE id_task = '{$id_task}' ";
		$query .= "LIMIT 1";

		$result = mysqli_query($connection, $query);
		confirm_query($result);
		return $result;
	}
	// operater updatuje task
	function operater_update_task($stat,$id_task) {
		global $connection;

		$query  = "UPDATE taskovi SET ";
		$query .= "id_status = {$stat} ";
		$query .= "WHERE id_task = '{$id_task}' ";
		$query .= "LIMIT 1";

		$result = mysqli_query($connection, $query);
		confirm_query($result);
		return $result;
	}
	// korisnik updatuje task
	function korisnik_update_task($stat,$id_task) {
		global $connection;

		$query  = "UPDATE taskovi SET ";
		$query .= "id_status = {$stat} ";
		$query .= "WHERE id_task = '{$id_task}' ";
		$query .= "LIMIT 1";

		$result = mysqli_query($connection, $query);
		confirm_query($result);
		return $result;
	}
	function find_all_task_statusi() {
		global $connection;

		$query  = "SELECT t.id_status id_status, t.status status ";
		$query .= "FROM task_statusi t ";
		$query .= "ORDER BY id_status ASC";
		$status_set = mysqli_query($connection, $query);
		confirm_query($status_set);
		return $status_set;
	}
 	function find_task_history($id_task) {
		global $connection;

		$query  = "SELECT * ";
		$query .= "FROM task_istorija ";
		$query .= "WHERE id_task = '{$id_task}' ";
		$query .= "ORDER BY id, vrijeme_izmjene ASC";
		$history_set = mysqli_query($connection, $query);
		confirm_query($history_set);
		return $history_set;
	}
	// admin dodaje komentar
	function dodaj_komentar($id_task,$user_dodao_komentar,$komentar) {
		global $connection;

		$insert_kom  = "INSERT INTO komentari (";
		$insert_kom .= "  id_task, logovani_user, komentar, datum_i_vrijeme";
		$insert_kom .= ") VALUES (";
		$insert_kom .= "  '{$id_task}', '{$user_dodao_komentar}', '{$komentar}', now() ";
		$insert_kom .= ")";

		$result = mysqli_query($connection, $insert_kom);
		confirm_query($result);
		return $result;
	}
 	function find_task_komentari($id_task) {
		global $connection;

		$query  = "SELECT * ";
		$query .= "FROM komentari ";
		$query .= "WHERE id_task = '{$id_task}' ";
		$query .= "ORDER BY id_komentar, datum_i_vrijeme ASC";
		$komentari_set = mysqli_query($connection, $query);
		confirm_query($komentari_set);
		return $komentari_set;
	}

////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// TASKMASTER REPORTS
////////////////////////////////////////////////////////////////////////////////
function taskovi_po_statusu() {
	global $connection;

	$query  = "SELECT task_statusi.status as status, COUNT(taskovi.id_status) as num  ";
	$query .= "FROM task_statusi ";
	$query .= "LEFT JOIN taskovi ON task_statusi.id_status = taskovi.id_status ";
	$query .= "GROUP BY task_statusi.status ";
	$query .= "order by task_statusi.id_status ASC";
	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
function ukupno_nedodijeljeno_taskova() {
	global $connection;

	$query  = "SELECT count(*) as num  ";
	$query .= "FROM taskovi  ";
	$query .= "WHERE id_operater = 1 ";
	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
function nedodijeljeni_taskovi() {
	global $connection;

	$query  = "SELECT id_task, naslov ";
	$query .= "FROM taskovi  ";
	$query .= "WHERE id_operater = 1 ";
	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
function ukupno_taskova() {
	global $connection;

	$query  = "SELECT count(*) as num  ";
	$query .= "FROM taskovi  ";
	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
function operater_statistika() {
	global $connection;
  // ZA SVAKOG OPERATERA IME I RPEZIME, ID, BROJ OTVORENIH, ANALIZIRANIH, PRIHVACENIH, ODBIJENIH, ZATVORENIH I UKUPAN BROJ TASKOVA
  // cijwli select u jednom redu
	//	$query  = "SELECT DISTINCT(concat(UPPER(O.IME),' ',UPPER(O.PREZIME))) AS IME_PREZIME, O.ID_OPERATER, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 1 AND ID_OPERATER = O.ID_OPERATER)  AS OTVORENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 2 AND ID_OPERATER = O.ID_OPERATER)  AS ANALIZIRANO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 3 AND ID_OPERATER = O.ID_OPERATER)  AS PRIHVACENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 4 AND ID_OPERATER = O.ID_OPERATER)  AS ODBIJENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 5 AND ID_OPERATER = O.ID_OPERATER) AS ZAVRSENO, (SELECT count(*) FROM TASKOVI WHERE ID_OPERATER = O.ID_OPERATER)  AS UKUPNO  ";
	// ali je preglednije ovako
	$query  = "SELECT DISTINCT(concat(UPPER(o.ime),' ',UPPER(o.prezime))) AS IME_PREZIME, o.id_operater,  ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 1 AND id_operater = o.id_operater)  AS OTVORENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 2 AND id_operater = o.id_operater)  AS ANALIZIRANO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 3 AND id_operater = o.id_operater)  AS PRIHVACENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 4 AND id_operater = o.id_operater)  AS ODBIJENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 5 AND id_operater = o.id_operater)  AS ZAVRSENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_operater = o.id_operater)  AS UKUPNO  ";
	$query .= "FROM operateri o ";
	$query .= "WHERE o.id_operater != 1 ";
	$query .= "ORDER BY UKUPNO DESC ";

	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
function korisnik_statistika() {
	global $connection;
  // ZA SVAKOG OPERATERA IME I RPEZIME, ID, BROJ OTVORENIH, ANALIZIRANIH, PRIHVACENIH, ODBIJENIH, ZATVORENIH I UKUPAN BROJ TASKOVA
  // cijwli select u jednom redu
	//	$query  = "SELECT DISTINCT(concat(UPPER(O.IME),' ',UPPER(O.PREZIME))) AS IME_PREZIME, O.ID_OPERATER, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 1 AND ID_OPERATER = O.ID_OPERATER)  AS OTVORENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 2 AND ID_OPERATER = O.ID_OPERATER)  AS ANALIZIRANO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 3 AND ID_OPERATER = O.ID_OPERATER)  AS PRIHVACENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 4 AND ID_OPERATER = O.ID_OPERATER)  AS ODBIJENO, (SELECT count(*) FROM TASKOVI WHERE ID_STATUS = 5 AND ID_OPERATER = O.ID_OPERATER) AS ZAVRSENO, (SELECT count(*) FROM TASKOVI WHERE ID_OPERATER = O.ID_OPERATER)  AS UKUPNO  ";
	// ali je preglednije ovako
	$query  = "SELECT DISTINCT(concat(UPPER(k.ime),' ',UPPER(k.prezime))) AS IME_PREZIME, k.id_korisnik,  ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 1 AND id_korisnik = k.id_korisnik)  AS OTVORENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 2 AND id_korisnik = k.id_korisnik)  AS ANALIZIRANO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 3 AND id_korisnik = k.id_korisnik)  AS PRIHVACENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 4 AND id_korisnik = k.id_korisnik)  AS ODBIJENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_status = 5 AND id_korisnik = k.id_korisnik)  AS ZAVRSENO, ";
	$query .= "(SELECT count(*) FROM taskovi WHERE id_korisnik = k.id_korisnik)  AS UKUPNO  ";
	$query .= "FROM korisnici k ";
	$query .= "ORDER BY UKUPNO DESC ";

	$taskovi_set = mysqli_query($connection, $query);
	confirm_query($taskovi_set);
	return $taskovi_set;
}
////////////////////////////////////////////////////////////////////////////////
// MAILOVI
////////////////////////////////////////////////////////////////////////////////
function find_task_mail_list_admin($id_task) {
	global $connection;
// salje mail  operateru i korisniku kada admin napravi izmjenu statusa, operatera ili roka izvrsenja
	$query  = "select k.email as email ";
	$query .= "from taskovi t, korisnici k  ";
	$query .= "where t.id_korisnik = k.id_korisnik  ";
	$query .= "and t.id_task = '{$id_task}'  "; // mail korisnika
	$query .= "union all ";
	$query .= "select o.email as email ";
	$query .= "from taskovi t, operateri o ";
	$query .= "where t.id_operater = o.id_operater ";
	$query .= "and t.id_task = '{$id_task}' "; // mail operatera

	$mailovi_set = mysqli_query($connection, $query);
	confirm_query($mailovi_set);
	return $mailovi_set;
}
function find_task_mail_list_operater($id_task) {
	global $connection;
// salje mail  adminu i korisniku kada operater napravi izmjenu statusa
	$query  = "select k.email as email ";
	$query .= "from taskovi t, korisnici k  ";
	$query .= "where t.id_korisnik = k.id_korisnik  ";
	$query .= "and t.id_task = '{$id_task}'  "; // mail korisnika
	$query .= "union all ";
	$query .= "select o.email as email ";
	$query .= "from operateri o ";
	$query .= "where o.administrator = 1 "; // mail admina

	$mailovi_set = mysqli_query($connection, $query);
	confirm_query($mailovi_set);
	return $mailovi_set;
}
function find_task_mail_list_korisnik($id_task) {
	global $connection;
// salje mail  adminu i operateru kada korisnik napravi izmjenu statusa
	$query  = "select o.email as email ";
	$query .= "from taskovi t, operateri o ";
	$query .= "where t.id_operater = o.id_operater ";
	$query .= "and t.id_task = '{$id_task}' "; // mail operatera
	$query .= "union all ";
	$query .= "select o.email as email ";
	$query .= "from operateri o ";
	$query .= "where o.administrator = 1 "; // mail admina

	$mailovi_set = mysqli_query($connection, $query);
	confirm_query($mailovi_set);
	return $mailovi_set;
}
////////////////////////////////////////////////////////////////////////////////
	function logged_in_as_admin()
	{
		return isset($_SESSION['admin_id']);
	}
	function logged_in_as_operater()
	{
		return isset($_SESSION['operater_id']);
	}
	function logged_in_as_korisnik()
	{
		return isset($_SESSION['korisnik_id']);
	}

	function confirm_logged_in_as_admin()
	{
		if (!logged_in_as_admin()) {
			redirect_to("login.php");
		}
	}
	function confirm_logged_in_as_operater()
	{
		if (!logged_in_as_operater()) {
			redirect_to("login.php");
		}
	}
	function confirm_logged_in_as_korisnik()
	{
		if (!logged_in_as_korisnik()) {
			redirect_to("login.php");
		}
	}

?>
