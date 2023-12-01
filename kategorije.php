<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Kategorije";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Lista kategorija"; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, lista kategorija"; 
    include "includes/head.php";
   ?>
<script>

function brisi(id){
    
    var odgovor= confirm("Želite li trajno obrisati kategoriju?");
    if(odgovor == true){
        location.href="obrisi_kategoriju.php?id=" + id;
    }
}

</script>
</head>
<body>
    <div class="red">
        <?php include "includes/navigation.php"; ?>
        
    </div>


    <div class="red">
          <?php include "includes/header.php"; ?>
          <section id="sadrzaj" class="t-kolona-12 d-kolona-12">
            <h2>Uređivanje kategorija</h2>
            <?php if($_SESSION["tip_id"] == 1){echo' <button><a href="unos_kategorije.php">Dodaj Kategoriju</a></button>';}?>
           
            <?php
                    
                    require_once "includes/baza.php";
                    
                     $baza = new Baza();
                 
                     $upit="SELECT id_kategorije, ime_kategorije, slika_kategorije FROM kategorija GROUP BY ime_kategorije ORDER BY ime_kategorije";
                     //šaljemo SQL upit MYSQL-u pozivom metode dohvatiDB()
                     $rezultat = $baza -> dohvatiDB($upit);
 
                     // ugradnja dohvaćenih podataka iz baze u željenji HTML format
                     echo "<div class='kategorije'>"; 
                     while($red = $rezultat->fetch_array()){
                         $id_kategorije=$red["id_kategorije"];
                         echo "<div class = 'slika' ><img src='".$red["slika_kategorije"]."' alt='".$red["ime_kategorije"]."' width='150' height='200'/>
                         <p>".$red["ime_kategorije"]."</p>"; 
                         echo "<a href='uredi_kategoriju.php?id=$id_kategorije' title='Uredite kategoriju'>Uredi</a> ";
                         echo "<a href='#' onclick='brisi($id_kategorije); return false' title='Obrišite kategoriju'>Obiši</a><br></div>";
                     }

        
                    ?>
        <div>
        </div>

        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>