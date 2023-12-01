<!DOCTYPE html>
<html lang="hr">
    <head>
        <?php
        $title="Foto | Album - prijava";
        $description="Prijava u Web aplikaciju za besplatno dijeljenje fotografija.";
        $keyword="fotografije, dijeljenje, komentaranje, kategorije, prijava";
        include "includes/head.php";
        ?>

        <?php
            if(!isset($_SESSION)){
                session_start();
            }

            if(!isset($_SESSION["status"])){
                $_SESSION["status"] = "undefined";
            }

            if($_SESSION["status"] ==1){
                require "index.php";
                exit;
            }
        ?>
    </head>

    <body>
        <div class="red">
            <?php
                include "includes/prijava-navigation.php";
            ?>
        </div>
        <div class="red">
            <?php
            include "includes/header.php";
            ?>
        </div> 
        <div class="red" id="centriraj">
            <aside id="prijava"class="tkolona12 dkolona5">
                <form action="includes/session/otvori-sesiju.php" method="POST">
                    <h2>Prijava</h2>
                    <label for="korisnicko_ime">Korisnično ime:</label>
                    <input type="text" id="korisnicko_ime" name="korisnicko_ime" required/><br/>
                    <label for="lozinka">Lozinka:</label>
                    <input type="password" id="lozinka" name="lozinka" required/><br/>
                    <input type="submit" value="U redu" class="gumbic"/>
                </form>
            </aside>
        </div>	
    </body>
</html>
