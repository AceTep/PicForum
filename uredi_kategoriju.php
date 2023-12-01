
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
          <div class="unos">   

          <?php
                require_once "includes/baza.php";
                $baza = new Baza();
                $id_kategorije = $_GET['id'];
                $upit = "SELECT ime_kategorije, slika_kategorije, id_korisnika FROM kategorija WHERE id_kategorije = $id_kategorije";
                $rezultat = $baza -> dohvatiDB($upit);
                while($red = $rezultat -> fetch_array()){
                    $ime_kategorije = $red["ime_kategorije"];
                    $slika_kategorije= $red["slika_kategorije"];
                    $id_korisnika= $red["id_korisnika"];
                }
            ?>




            <h2>Uredi Kategoriju</h2>

            <form method="POST" action="uredi_kategoriju_spremi.php" enctype="multipart/form-data">
                <input type="hidden" name="id_kategorije" value="<?php echo $id_kategorije;?>">
                
                <label for="ime_kategorije">Ime kategorije*</label><br>
                <input type="text" name="ime_kategorije" id="ime_kategorije" value="<?php echo $ime_kategorije;?>" required />
                <br><br>

                <label for="slika_kategorije">Slika Kategorije*</label><br>
                <input type="file" name="slika_kategorije" id="slika_kategorije" ><br>
                <img src="<?php echo $slika_kategorije;?>" alt="<?php echo $ime_kategorije;?>" width="30%" height="20%"><br><br>

                <label for="id_korisnika">Moderator kategorije*</label><br>
                <select name="id_korisnika" id="id_korisnika" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit = "SELECT id_korisnika, korisnicko_ime FROM korisnik WHERE id_grupe=2 ORDER BY id_korisnika = $id_korisnika DESC";
                    $rezultat = $baza -> dohvatiDB($upit);
                    while($red = $rezultat ->fetch_array()){

                        echo "<option value='".$red['id_korisnika']."'>".$red['korisnicko_ime']."</option>";

                    }

                ?>
                  
                </select> <br><br>
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