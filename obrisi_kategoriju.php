
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

    function natrag(){

        location.href = "kategorije.php";

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
            
            $id_kategorije = $_GET['id'];
            $poruka= "";

            $upit_dohvati = "SELECT slika_kategorije FROM kategorija WHERE id_kategorije=$id_kategorije";
            $rezultat = $baza -> dohvatiDB($upit_dohvati);
            while($red = $rezultat -> fetch_array()){

                $slika_kategorije = $red["slika_kategorije"];

            }

            $upit_brisi = "DELETE FROM kategorija WHERE id_kategorije=$id_kategorije";
            $status = $baza -> promijeniDB($upit_brisi);
            if($status){
                $poruka = "Uspjesno brisanje kategorije!";
                if(is_file($slika_kategorije)){

                    unlink($slika_kategorije);

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
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>