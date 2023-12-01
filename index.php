<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Foto | Album";
   $description = "Web aplikacija za besplatno dijelenje fotografija"; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije"; 
    include "includes/head.php";
   ?>
   <script src="js/ajax.js"></script>
   <script>
        function porukaPrijava(){
            alert("Za pristup fotografijama potreban je prijava!");
        }
   </script>
</head>
<body>
    <div class="red">
        <?php include "includes/navigation.php"; ?>
    <?php
        if(!isset($_SESSION["korisnicko_ime"])){
            $_SESSION["korisnicko_ime"] = "undifine";
        }
        if(!isset($_SESSION["status"])){
            $_SESSION["status"] = "undifine";
        }
    ?>
        
    </div>


    <div class="red">
         <?php include "includes/header.php"; ?>
         
            <section id="sadrzaj" class="t-kolona-9 <?php if($_SESSION["status"] == 1){echo "d-kolona-12";}else{echo "d-kolona-9";}?>">
                <div>  
                    <?php
                        if($_SESSION["status"] == 1){
                            echo "<p>Dobro došao ".$_SESSION["korisnicko_ime"]."! ";
                            echo "<a href='includes/session/zatvori-sesiju.php'>Odjava</a></p>";
                        }
                    
                    ?>
                    <label>Kategorije: </label>
                    <input type="text" id="trazilica" onKeyUp="pretraga()">
                </div>
                <section id="prikaz-kategorija">
                </section>
            </section>
                <?php if($_SESSION["status"] != 1){
                    include "includes/aside.php";
                }
                 ?>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>