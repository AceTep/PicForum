<?php
    require "includes/session/provjera-prijava.php";
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <?php
    $title="Foto | Album - lista kategorija";
    $description="Web aplikacija za besplatno dijeljenje fotografija. Lista unesenih kategorija.";
    $keyword="kategorije, dijeljenje, uredivanje, fotograije";
    include "includes/head.php";
    ?>

    <script>
        function natrag(){
        location.href = "kategorije.php";
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
                <h2>Brisanje fotogrfije</h2>

        <?php

        require_once "includes/baza.php";
        $baza = new Baza();

        $ID_Kategorije = $_GET['id'];
        $poruka= "";

        $upit_dohvati = "SELECT Slika_Kategorije FROM kategorija WHERE ID_Kategorije=$ID_Kategorije";
        $rezultat = $baza -> dohvatiDB($upit_dohvati);
        while($red = $rezultat -> fetch_array()){

            $Slika_Kategorije = $red["Slika_Kategorije"];

        }

        $upit_brisi = "DELETE FROM kategorija WHERE ID_Kategorije=$ID_Kategorije";
        $status = $baza -> promijeniDB($upit_brisi);
        if($status){
            $poruka = "Uspjesno brisanje kategorije!";
            if(is_file($Slika_Kategorije)){

                unlink($Slika_Kategorije);

            }
        }else{
            $poruka = "Neuspjesno brisanje kategorije";
        }



        ?>
        <div>

        <p><?php echo $poruka;?></p>
        <button type="button" onclick="natrag()">U redu</button>
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