<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Fotografije";
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
            <h2>Unos Kategorije</h2>

            <form method="POST" action="unos_kategorije_spremi.php" enctype="multipart/form-data">
                <label for="ime_kategorije">Ime kategorije*</label><br>
                <input type="text" name="ime_kategorije" id="ime_kategorije" required />
                <br><br>
                <label for="slika_kategorije">Slika Kategorije*</label><br>
                <input type="file" name="slika_kategorije" id="slika_kategorije" required><br><br>
                <label for="id_korisnika">Moderator kategorije*</label><br>
                <select name="id_korisnika" id="id_korisnika" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit = "SELECT id_korisnika, korisnicko_ime FROM korisnik WHERE id_grupe=2";
                    $rezultat = $baza -> dohvatiDB($upit);
                    while($red = $rezultat ->fetch_array()){

                        echo "<option value='".$red['id_korisnika']."'>".$red['korisnicko_ime']."</option>";

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