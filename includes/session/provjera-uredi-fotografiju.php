<?php
session_start();
/* ako korisnik nije prijavljen (nisu postavljene sesijske varijable $_SESSION['korisnicko_ime'], $_SESSION['lozinka'] i $_SESSION['tip_id']) vrati ga na početnu stranicu */
if((!isset($_SESSION['korisnicko_ime'])) || (!isset($_SESSION['lozinka'])) || (!isset($_SESSION['tip_id']))){
	echo "<script>location.href = 'index.php';</script>";
	exit;
}
require_once "includes/session/autentifikacija.php";
$korisnicki_podaci = autentifikacija($_SESSION['korisnicko_ime'],$_SESSION['lozinka']);
$baza = new Baza();
$id_fotografije = $_GET["id"];

/* iz baze dohvati moderatora kategorije u kojoj se nalazi fotografija koja se uređuje */
/* NAPOMENA: prilagodite nazive kolona i tablica onima koje ste koristili u vašoj bazi podataka (naziv varijable $fotografija_id ne mijenjate) */
$upit_moderator = "SELECT kategorija.id_korisnika from kategorija where kategorija.id_kategorije = (select fotografija.id_kategorije from fotografija where id_fotografije = $id_fotografije)";
$rezultat_moderator = $baza->dohvatiDB($upit_moderator);
while($red = $rezultat_moderator->fetch_array()){
		/* NAPOMENA: prilagodite naziv korišten u polju $red[] nazivu kolone iz vaše baze podataka */
		$moderator = $red["id_korisnika"];
	}

/* iz baze dohvati autora fotografije koja se uređuje */
/* NAPOMENA: prilagodite nazive kolona i tablica onima koje ste koristili u vašoj bazi podataka (naziv varijable $fotografija_id ne mijenjate) */
$upit_autor = "SELECT id_korisnika from fotografija where id_fotografije = $id_fotografije";
$rezultat_autor = $baza->dohvatiDB($upit_autor);
while($red = $rezultat_autor->fetch_array()){
	/* NAPOMENA: prilagodite naziv korišten u polju $red[] nazivu kolone iz vaše baze podataka */
	$autor = $red["id_korisnika"];
}

/* ako su sesijski podaci postavljeni, provjeri da li u bazi postoji korisnik s istim podacima => ako ne, vrati korisnika na početnu stranicu */
/* dodatno, provjeri da li je korisnik autor fotografije koja se uređuje, moderator kategorije u kojoj se ona nalazi ili da li je u grupi administrator  => ako ništa od toga nije, vrati ga na početnu stranicu */
if(($_SESSION['korisnicko_ime'] != $korisnicki_podaci[1]) || ($_SESSION['lozinka'] != $korisnicki_podaci[2]) || ($_SESSION['korisnik_id'] != $autor) && ($_SESSION['korisnik_id'] != $moderator) && ($_SESSION["tip_id"] != 1)){
	echo "<script>location.href = 'index.php';</script>";
	exit;
}

?>