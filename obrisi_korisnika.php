
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

        location.href = "korisnici.php";

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
            <h2>Brisanje korisnika</h2>

            <?php
            
            require_once "includes/baza.php";
            $baza = new Baza();
            
            $id_korisnika = $_GET['id'];
            $poruka= "";

            $upit_dohvati = "SELECT slika_profila FROM korisnik WHERE id_korisnika=$id_korisnika";
            $rezultat = $baza -> dohvatiDB($upit_dohvati);
            while($red = $rezultat -> fetch_array()){

                $slika_profila = $red["slika_profila"];

            }

            $upit_brisi = "DELETE FROM korisnik WHERE id_korisnika=$id_korisnika";
            $status = $baza -> promijeniDB($upit_brisi);
            if($status){
                $poruka = "Uspjesno brisanje korisnika!";
                if(is_file($slika_profila)){

                    unlink($slika_profila);

                }
            }else{
                $poruka = "Neuspjesno brisanje korisnika";
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