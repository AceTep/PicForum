<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Komentara";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos komentara."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos komentara"; 
    include "includes/head.php";
   ?>
   <script> 
   
        function natrag(id){
            var id_fotografije = id;
            location.href="detalji-fotografije.php?id="+id_fotografije;
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
                <h2>Unos Komentara</h2>
                <?php
                    //ispis greske i prekidanje skripte, ako se datoteci pokuša pristupiti izravno    
                  

                    if(!isset($_POST["submit"])){
                        echo "Ne možete pristupiti datoteci bez predaje podataka forme.";
                        exit;
                    }

                    require_once 'includes/baza.php';
                    $baza = new Baza();
                    $poruka = "";

                    //validacija podatak

                    if(empty(trim($_POST['komentar']))){
                        $poruka .= "Komentar je obavezno polje za unos.<br>";
                    }else{
                        $komentar = strip_tags($_POST["komentar"]);
                    }

                    if(empty(trim($_POST['ocjena']))){
                        $poruka .= "Ocjena je obavezno polje za unos.<br>";
                    }else{
                        $ocjena = strip_tags($_POST["ocjena"]);
                    }
                        
                    if(empty(trim($_POST['id_fotografije']))){
                        $poruka .= "id_fotografije.<br>";
                    }else{
                        $id_fotografije = strip_tags($_POST["id_fotografije"]);
                    }
                        

                    // do postavljana kontrole pristupa autor svake nove foto biti ce korisnik s id 1
                    if(!isset($_SESSION["korisnik_id"])){
                        $_SESSION["korisnik_id"] = "undifine";
                    }
                    $id_korisnika = $_SESSION["korisnik_id"];


                    //U slučaju uspješne validacije i uspješnog prebacivanja slike na server, unos podataka u bazu
                    if(empty($poruka)){

                        $upit_komentara = "INSERT INTO komentar (ocjena, komentar, id_fotografije, id_korisnika) values($ocjena,'$komentar', $id_fotografije, $id_korisnika)";

                        $status = $baza -> promijeniDB($upit_komentara);


                        if($status){
                            $poruka .= "Uspješan unos novog komentara.";
                        }else{
                            $poruka .= "Greška kod unosa.";
                        }
                        
                    }                    

                ?>

                <!-- Vračanje poruke-->
                <div id="poruka">
                    <p>
                        <?php echo $poruka;?>
                        <input type="button" value="U redu" onclick="natrag(<?php echo $id_fotografije;?>)">
                    </p>
                </div>
        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>