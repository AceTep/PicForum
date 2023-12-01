<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Obriši komentar";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Brisanje komentara."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, brisanje komentara"; 
    include "includes/head.php";
   ?>

<script>

    function natrag(id){

        location.href = "detalji-fotografije.php?id="+id;

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
            <h2>Brisanje komentara</h2>

            <?php
            
            require_once "includes/baza.php";
            $baza = new Baza();
            
            $id_komentara = $_GET['id'];
            $poruka= "";

            $upit_dohvati = "SELECT id_fotografije FROM komentar WHERE id_komentara=$id_komentara";
            $rezultat = $baza -> dohvatiDB($upit_dohvati);
            while($red = $rezultat -> fetch_array()){

                $id_fotografije = $red["id_fotografije"];

            }

            $upit_brisi = "DELETE FROM komentar WHERE id_komentara=$id_komentara";
            $status = $baza -> promijeniDB($upit_brisi);
            if($status){
                $poruka = "Uspjesno brisanje komentara!";
            }else{
                $poruka = "Neuspjesno brisanje komentara";
            }


            
            ?>
        <div>
            
            <p><?php echo $poruka;?></p>
            <button type="button" onclick="natrag(<?php echo $id_fotografije;?>)">U redu</button>
        </div>
        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>