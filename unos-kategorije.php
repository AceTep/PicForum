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
        <section id="unos" class="tkolona12 dkolona12">
        <h2>Unos Kategorije</h2>
        <form method="POST" action="unos-kategorije-spremi.php" enctype="multipart/form-data">
            <label for="Naziv_Kategorije">Naziv kategorije*</label>
            <input type="text" name="Naziv_Kategorije" id="Naziv_Kategorije" required />
            <br><br>
            <label for="Slika_Kategorije">Slika Kategorije*</label>
            <input type="file" name="Slika_Kategorije" id="Slika_Kategorije" required><br><br>
            <label for="ID_Korisnika">Moderator kategorije*</label>
            <select name="ID_Korisnika" id="ID_Korisnika" required>
                <?php 
                    require_once 'includes/baza.php';
                    $baza = new Baza();

                    $upit = "SELECT ID_Korisnika, Korisničko_ime FROM korisnik WHERE ID_GrupeKorisnika=2";
                    $rezultat = $baza -> dohvatiDB($upit);
                    while($red = $rezultat ->fetch_array()){
                        echo "<option value='".$red['ID_Korisnika']."'>".$red['Korisničko_ime']."</option>";
                    }

                ?>
            </select> <br><br>
            <input type="submit" value="U redu" name="submit" class="gumbic">     
                  
        </section>
    </div>

    <div class="red">
        <?php
            include "includes/footer.php";
        ?> 
    </div>
</body>
</html>