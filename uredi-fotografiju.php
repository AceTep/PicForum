<?php require "includes/session/provjera-uredi-fotografiju.php" ?>

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
                $id_fotografije = $_GET['id'];
                $upit = "SELECT naslov, opis, url, id_kategorije FROM fotografija WHERE id_fotografije = $id_fotografije";
                $rezultat = $baza -> dohvatiDB($upit);
                while($red = $rezultat -> fetch_array()){
                    $naslov = $red["naslov"];
                    $opis= $red["opis"];
                    $url = $red["url"];
                    $id_kategorije = $red["id_kategorije"];

                }
            ?>




            <h2>Unos fotografije</h2>

            <form method="POST" action="uredi-fotografiju-spremi.php" enctype="multipart/form-data">
                <input type="hidden" name="id_fotografije" value="<?php echo $id_fotografije;?>">
                
             
                <label for="naslov">Naslov fotografije*</label><br>
                <input type="text" name="naslov" id="naslov" required  value="<?php echo $naslov;?>"/>
                <br><br>

             
                
                <label for="url">Fotografija*</label><br>
                <input type="file" name="url" id="url"><br>
                <img src="<?php echo $url;?>" alt="<?php echo $naslov;?>" width="30%" height="20%">
                <br>

                <label for="opis">Opis Fotografije*</label><br>
                <textarea name="opis" id="opis" rows="6" cols="24" required ><?php echo $opis;?></textarea><br><br>
                
                <label for="id_kategorije">Kategorija*</label><br>
                <select name="id_kategorije" id="id_kategorije" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit_kategorije = "SELECT id_kategorije, ime_kategorije FROM kategorija ORDER BY id_kategorije=$id_kategorije DESC";
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