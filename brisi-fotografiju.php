<?php require "includes/session/provjera-uredi-fotografiju.php" ?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Obriši fotografiju";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Brisanje fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, brisanje fotografije"; 
    include "includes/head.php";
   ?>

<script>

    function natrag(id){

        location.href = "fotografije.php?id="+id;

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
            <h2>Brisanje fotogrfije</h2>

            <?php
            
            require_once "includes/baza.php";
            $baza = new Baza();
            
            $id_fotografije = $_GET['id'];
            $poruka= "";

            $upit_dohvati = "SELECT url, id_kategorije FROM fotografija WHERE id_fotografije=$id_fotografije";
            $rezultat = $baza -> dohvatiDB($upit_dohvati);
            while($red = $rezultat -> fetch_array()){

                $url = $red["url"];
                $id_kategorije = $red["id_kategorije"];

            }

            $upit_brisi = "DELETE FROM fotografija WHERE id_fotografije=$id_fotografije";
            $status = $baza -> promijeniDB($upit_brisi);
            if($status){
                $poruka = "Uspjesno brisanje fotografije!";
                if(is_file($url)){

                    unlink($url);

                }
            }else{
                $poruka = "Neuspjesno brisanje fotografije";
            }


            
            ?>
        <div>
            
            <p><?php echo $poruka;?></p>
            <button type="button" onclick="natrag(<?php echo $id_kategorije;?>)">U redu</button>
        </div>
        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>