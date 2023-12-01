<?php require "includes/session/provjera-prijava.php" ?>

<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Detalj Fotografije";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Detalji odabrane fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, lista fotografija, detalji fotografije"; 
    include "includes/head.php";
   ?>
   <script>

    function brisi(id){
    
    var odgovor= confirm("Želite li trajno obrisati komentar?");
    if(odgovor == true){
        location.href="obrisi_komentar.php?id=" + id;
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
                    
                    require_once "includes/baza.php";
                    
                     $id_fotografije= $_GET["id"];
                     $baza = new Baza();

                     $upit_fotografije= "SELECT naslov, opis, url, ime_prezime FROM fotografija INNER JOIN korisnik ON fotografija.id_korisnika = korisnik.id_korisnika WHERE id_fotografije = $id_fotografije" ;
                     $rezultat_fotografije_detalj = $baza -> dohvatiDB($upit_fotografije);
                     echo "<div class='kategorije'>"; 
                         while($red_fotografija_detalj = $rezultat_fotografije_detalj->fetch_array()){             
                            echo "<div class='detalj'><img src = '".$red_fotografija_detalj["url"]."' alt='".$red_fotografija_detalj["naslov"]."'/>";
                             echo "<p>".$red_fotografija_detalj["naslov"].", ".$red_fotografija_detalj["ime_prezime"].", ".$red_fotografija_detalj["opis"]."</p></div>";
                         }
                         
                         
                     $upit_komentara= "SELECT id_komentara, ocjena, komentar, korisnicko_ime, slika_profila FROM komentar INNER JOIN korisnik ON komentar.id_korisnika = korisnik.id_korisnika WHERE id_fotografije = $id_fotografije" ;
                     $rezultat_komentara = $baza -> dohvatiDB($upit_komentara);
                     
                         while($red_komentara = $rezultat_komentara->fetch_array()){
        
                            $id_komentara = $red_komentara["id_komentara"];
                             echo "<div class='komentar'><img src = '".$red_komentara["slika_profila"]."' alt='".$red_komentara["korisnicko_ime"]."'/>";
                             echo "<p>".$red_komentara["korisnicko_ime"].", ".$red_komentara["komentar"].", ".$red_komentara["ocjena"]."</p>
                             <button id='button'> <a href='#' onclick='brisi($id_komentara); return false' title='Obrišite fotografiju'>Obiši</a></button></div>";
                         }
                
                         echo "</div>"; 
                         
                        echo "<button id='gumb'><a href='unos-komentara.php?id=$id_fotografije'>Komentiraj</a></button>";

                    ?>
            </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>