<?php require "includes/session/provjera-prijava.php" ?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Lista fotografija";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Lista fotografija odabranih kategorija."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, lista fotografija"; 
    include "includes/head.php";
   ?>
<script>

    function brisi(id){
        
        var odgovor= confirm("Želite li trajno obrisati fotografiju i njene komentare?");
        if(odgovor == true){
            location.href="brisi-fotografiju.php?id=" + id;
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
                <!--sadržaj-->             
                    <?php
                    if(!isset($_SESSION["korisnik_id"])){
                        $_SESSION["korisnik_id"] = "undifine";
                    }
                    if(!isset($_SESSION["status"])){
                        $_SESSION["status"] = "undifine";
                    }
                    if(!isset($_SESSION["tip_id"])){
                        $_SESSION["tip_id"] = "undifine";
                    }

                    require_once "includes/baza.php";
                     
                    $id_kategorije= $_GET["id"];
                     $baza = new Baza();
                    
                     $upit_moderator = "SELECT id_korisnika FROM kategorija WHERE id_kategorije = $id_kategorije";
                     $rezultat_moderator = $baza -> dohvatiDB($upit_moderator);
                    while($red_moderator = $rezultat_moderator -> fetch_array()){
                        $moderator = $red_moderator["id_korisnika"];
                    }

                     $upit_naslov = "SELECT ime_kategorije FROM kategorija WHERE id_kategorije = $id_kategorije";
                     $rezultat_naslov = $baza -> dohvatiDB($upit_naslov);
    	             while($red_naslov = $rezultat_naslov ->fetch_array()){
                        echo "<h1 class='naslov_kategorije'>".$red_naslov["ime_kategorije"]."</h1>";
                    }


                    $upit_fotografije= "SELECT fotografija.id_fotografije, fotografija.id_korisnika,  naslov, url, ime_prezime FROM fotografija INNER JOIN korisnik ON fotografija.id_korisnika = korisnik.id_korisnika WHERE id_kategorije = $id_kategorije" ;
                    $rezultat_fotografije = $baza -> dohvatiDB($upit_fotografije);
                    
                    if($rezultat_fotografije->num_rows != 0 ){
                        echo "<div class='kategorije'>"; 
                        while($red_fotografija = $rezultat_fotografije->fetch_array()){
                            $id_fotografije=$red_fotografija["id_fotografije"];
                            $autor=$red_fotografija["id_korisnika"];
                            echo "<a href='detalji-fotografije.php?id=$id_fotografije'><div class = 'slika_foto' ><img src = '".$red_fotografija["url"]."' alt='".$red_fotografija["naslov"]."' width='300' height='350'/></a>";
                            echo "<p>".$red_fotografija["naslov"].", ".$red_fotografija["ime_prezime"]."</p><hr>";

                        if($_SESSION["status"] == 1 AND ($_SESSION["tip_id"] == 1 OR $_SESSION["korisnik_id"] == $moderator OR $_SESSION["korisnik_id"] == $autor)){
                            echo "<a href='uredi-fotografiju.php?id=$id_fotografije' title='Uredite fotografiju'>Uredi</a> ";
                            echo "<a href='#' onclick='brisi($id_fotografije); return false' title='Obrišite fotografiju'>Obiši</a><br>";
                        }
                            echo "</div>";
                        }
                        echo "</div>"; 
                    }else{
                        echo "<h4>Nema fotografija u kategoriji</h4>";
                    }

                    ?>

            </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>