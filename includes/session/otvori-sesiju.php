<?php
require "autentifikacija.php";

if (!isset($_POST['korisnicko_ime'])) {
	$_POST['korisnicko_ime'] = "undefine"; 
}
if (!isset($_POST['lozinka'])) {
	$_POST['lozinka'] = "undefine"; 
}
$korisnicko_ime = $_POST['korisnicko_ime'];
$lozinka = md5($_POST['lozinka']);
$korisnicki_podaci = autentifikacija($korisnicko_ime ,$lozinka);

if(($korisnicko_ime == $korisnicki_podaci[1]) && ($lozinka == $korisnicki_podaci[2]) && (!empty($korisnicki_podaci[1])) && (!empty($korisnicki_podaci[2]))){
	session_start();
	$_SESSION['korisnik_id'] = $korisnicki_podaci[0];
	$_SESSION['korisnicko_ime'] = $korisnicki_podaci[1];
	$_SESSION['lozinka'] = $korisnicki_podaci[2];
	$_SESSION['tip_id'] = $korisnicki_podaci[3];
	$_SESSION['status'] = 1;
	echo "<script>location.href = '../../index.php';</script>";
}
else{
	/* ako prijava nije uspjela, radimo sljedeće:
		1. bacamo poruku greške
		2. vraćamo korisnika na početnu stranicu bez otvaranja korisničke sesije
	*/
	echo "<meta charset='utf-8' />";
	echo "<script>alert('Pogrešna prijava!');</script>";
	echo "<script>location.href = '../../index.php';</script>";
	exit;
}
?>