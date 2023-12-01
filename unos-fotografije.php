<?php require "includes/session/provjera-prijava.php" ?>

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
            <h2>Unos fotografije</h2>

            <form method="POST" action="unos-fotografije-spremi.php" enctype="multipart/form-data">
                <label for="naslov">Naslov fotografije*</label><br>
                <input type="text" name="naslov" id="naslov" required />
                <br><br>
        
                <label for="url">Fotografija*</label><br>
                <input type="file" name="url" id="url" required><br><br>

                <label for="opis">Opis Fotografije*</label><br>
                <textarea name="opis" id="opis" rows="6" cols="24" required></textarea><br><br>
                
                <label for="id_kategorije">Katoegorija*</label><br>
                <select name="id_kategorije" id="id_kategorije" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit_kategorije = "SELECT id_kategorije, ime_kategorije FROM kategorija ORDER BY ime_kategorije";
                    $rezultat_kategorije = $baza -> dohvatiDB($upit_kategorije);
                    while($red_kategorije = $rezultat_kategorije ->fetch_array()){

                        echo "<option value='".$red_kategorije['id_kategorije']."'>".$red_kategorije['ime_kategorije']."</option>";

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