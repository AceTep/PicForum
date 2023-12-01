    <!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Korisnika";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos fotografije"; 
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
        <div class="unos">   
            <h2>Unos Korisnika</h2>

            <form method="POST" action="unos_korisnika_spremi.php" enctype="multipart/form-data">

                <label for="korisnicko_ime">Korisnicko ime*</label><br>
                <input type="text" name="korisnicko_ime" id="korisnicko_ime" required />
                <br><br>

                <label for="lozinka">Lozinka*</label><br>
                <input type="password" name="lozinka1" id="lozinka" required><br><br>
                <input type="password" name="lozinka2" id="lozinka" required><br><br>

                <label for="ime_prezime">Ime i prezime*</label><br>
                <input type="text" name="ime_prezime" id="ime_prezime" required><br><br>

                <label for="email">Email*</label><br>
                <input type="text" name="email" id="email" required><br><br>

                <label for="adresa">Adresa</label><br>
                <input type="text" name="adresa" id="adresa"><br><br>

                <label for="broj_mobitela">Broj mobitela</label><br>
                <input type="text" name="broj_mobitela" id="broj_mobitela" ><br><br>
                
                <label for="slika_kategorije">Slika Profila*</label><br>
                <input type="file" name="slika_profila" id="slika_profila" required><br><br>

                <label for="id_grupe">Grupa korisnika*</label><br>
                <select name="id_grupe" id="id_grupe" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit = "SELECT id_grupe, naziv_grupe FROM grupa_korisnika";
                    $rezultat = $baza -> dohvatiDB($upit);
                    while($red = $rezultat ->fetch_array()){

                        echo "<option value='".$red['id_grupe']."'>".$red['naziv_grupe']."</option>";

                    }

                ?>
                  
                </select> <br><br>
                <input type="submit" value="U redu" name="submit">     
            </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>