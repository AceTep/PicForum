<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Korisnici";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Lista kategorija"; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, lista kategorija"; 
    include "includes/head.php";
   ?>
<script>

function brisi(id){
    
    var odgovor= confirm("Želite li trajno obrisati korisnika?");
    if(odgovor == true){
        location.href="obrisi_korisnika.php?id=" + id;
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
            <h2>Uređivanje korisnika</h2>
            <?php if($_SESSION["tip_id"] == 1){echo'      <button><a href="unos_korisnika.php">Dodaj Korisnika</a></button>';}?>
            
      
            <?php
                    
                    require_once "includes/baza.php";
                    
                     $baza = new Baza();
                    $id_korisnika = $_SESSION["korisnik_id"];
                     if($_SESSION["tip_id"] == 1){
                     $upit="SELECT id_korisnika, korisnicko_ime, slika_profila, id_grupe FROM korisnik GROUP BY korisnicko_ime  ORDER BY korisnicko_ime";}
                     else{
                        $upit="SELECT id_korisnika, korisnicko_ime, slika_profila, id_grupe FROM korisnik WHERE id_korisnika = $id_korisnika GROUP BY korisnicko_ime  ORDER BY korisnicko_ime";
                     }

                     //šaljemo SQL upit MYSQL-u pozivom metode dohvatiDB()
                     $rezultat = $baza -> dohvatiDB($upit);
 
                     // ugradnja dohvaćenih podataka iz baze u željenji HTML format
                     echo "<div class='kategorije'>"; 
                     while($red = $rezultat->fetch_array()){
                         $id_grupe= $red["id_grupe"];
                         $id_korisnika=$red["id_korisnika"];
                         echo "<div class = 'slika' ><img src='".$red["slika_profila"]."' alt='".$red["korisnicko_ime"]."' width='150' height='200'/>
                         <p>".$red["korisnicko_ime"]."</p>"; 

                         if($id_grupe == 1){

                            echo "<a href='uredi_korisnika.php?id=$id_korisnika' title='Uredite kategoriju'>Uredi</a> ";

                         }else{
                            echo "<a href='uredi_korisnika.php?id=$id_korisnika' title='Uredite kategoriju'>Uredi</a> ";
                            echo "<a href='#' onclick='brisi($id_korisnika); return false' title='Obrišite Korisnika'>Obiši</a><br>";
                        }
                            echo "</div>";
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