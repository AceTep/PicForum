<!DOCTYPE html>
<html lang="hr">
<head>
    <?php
    $title="Foto | Album - brisanje komentara";
    $description="Web aplikacija za besplatno dijeljenje fotografija. Brisanje odabranog komentara.";
    $keyword="fotografije, brisanje, komentari, ocjene";
    include "includes/head.php";
    ?>

    <script>
        function natrag(id){
            location.href="fotografija-detalji.php?id="+id;
        }
    </script>

</head>
<body>
    <div class="red">
        <?php
            include "includes/navigation.php";
        ?>
    </div>
    <div class="red">
        <?php
        include "includes/header.php";
        ?>
     <div class="red">
        <section id="sadrzaj" class="tkolona12 dkolona12">
            <!-- sadržaj -->
            <h2>Brisanje komentara</h2>

               <?php

                    require_once "includes/baza.php";
                    $baza = new baza();
                    $ID_Komentara =  $_GET["id"];
                    $poruka ="";

                    $upit_podaci = "select ID_Fotografije, ID_Komentara, Tekst_Komentara, Datum_Komentara, Ocjena from komentar where ID_Komentara = $ID_Komentara";
                    $rezultat = $baza->dohvatiDB($upit_podaci);

                    while($red = $rezultat->fetch_array()){
                        $Tekst_Komentara = $red["Tekst_Komentara"];
                        $Ocjena = $red["Ocjena"];
                        $Datum_Komentara = $red["Datum_Komentara"];
                        $ID_Fotografije = $red["ID_Fotografije"];
                    }

                    $upit_brisi = "delete from komentar where ID_Komentara = $ID_Komentara";
                    $status = $baza->promijeniDB($upit_brisi);

                    if($status){
                        $poruka = "Uspješno brisanje komentara.";
                    }
                    else{
                        $poruka = "Neuspješno brisanje komentara.";
                    }

               ?>

               <div>
                   <p>
                       <?php
                        echo $poruka;
                       ?>
                   </p>

                   <button type="button" onclick="natrag(<?php echo $ID_Fotografije; ?>)">Uredu</button>
               </div>

        </section>
    </div>

    <div class="red">
        <?php
            include "includes/footer.php";
        ?> 
    </div>
</body>
</html>