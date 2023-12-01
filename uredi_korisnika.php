<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Uredi fotografiju";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Uređivanje fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, uređivanje fotografije"; 
    include "includes/head.php";
   ?>

</head>
<body>
    <div class="red">
        <?php include "includes/navigation.php"; ?>
        
    </div>


    <div class="red">
          <?php include "includes/header.php"; ?>
          <section id="sadrzaj" class="t-kolona-12 d-kolona-12">
          <h2>Uredi Korisnika</h2>
          <div class="unos">   

          <?php
                require_once "includes/baza.php";
                $baza = new Baza();
                $id_korisnika = $_GET['id'];
                $upit = "SELECT korisnicko_ime, ime_prezime, email, adresa, broj_mobitela, slika_profila, id_grupe FROM korisnik WHERE id_korisnika = $id_korisnika";
                $rezultat = $baza -> dohvatiDB($upit);
                while($red = $rezultat -> fetch_array()){
                    $korisnicko_ime = $red["korisnicko_ime"];
                    $ime_prezime = $red["ime_prezime"];
                    $email= $red["email"];
                    $adresa= $red["adresa"];
                    $broj_mobitela= $red["broj_mobitela"];
                    $slika_profila= $red["slika_profila"];
                    $id_grupe   = $red["id_grupe"];
                }
            ?>


        <form method="POST" action="uredi_korisnika_spremi.php" enctype="multipart/form-data">
        <input type="hidden" name="id_korisnika" value="<?php echo $id_korisnika;?>">
        <label for="korisnicko_ime">Korisnicko ime*</label><br>
        <input type="text" name="korisnicko_ime" id="korisnicko_ime" value="<?php echo $korisnicko_ime;?>" required />
        
        <br><br>

        <label for="lozinka">Lozinka*</label><br>
        <input type="password" name="lozinka1" id="lozinka" required><br><br>
        <input type="password" name="lozinka2" id="lozinka" required><br><br>

        <label for="ime_prezime">Ime i prezime*</label><br>
        <input type="text" name="ime_prezime" id="ime_prezime" value="<?php echo $ime_prezime;?>" required><br><br>

        <label for="email">Email*</label><br>
        <input type="text" name="email" id="email" value="<?php echo $email;?>" required><br><br>

        <label for="adresa">Adresa</label><br>
        <input type="text" name="adresa" id="adresa" value="<?php echo $adresa;?>"><br><br>

        <label for="broj_mobitela">Broj mobitela</label><br>
        <input type="text" name="broj_mobitela" id="broj_mobitela" value="<?php echo $broj_mobitela;?>"><br><br>

        <label for="slika_kategorije">Slika Profila*</label><br>
        <input type="file" name="slika_profila" id="slika_profila"><br><br>
        <img src="<?php echo $slika_profila;?>" alt="<?php echo $korisnicko_ime;?>" width="30%" height="20%">

        <?php 
        if($_SESSION["tip_id"] == 1){

            echo '<br><br><label for="id_grupe">Grupa korisnika*</label><br>
            <select name="id_grupe" id="id_grupe" required>';
            require_once 'includes/baza.php';
            $baza = new Baza();

            $upit = "SELECT id_grupe, naziv_grupe FROM grupa_korisnika ORDER BY id_grupe DESC";
            $rezultat = $baza -> dohvatiDB($upit);
            while($red = $rezultat ->fetch_array()){

                echo "<option value='".$red['id_grupe']."'>".$red['naziv_grupe']."</option>";

            }
        }
        echo "</select><br><br>";
        ?> 
        <input type="submit" value="U redu" name="submit">     
            </form>
            
        </div>
            </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>