<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Fotografije";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos fotografije"; 
    include "includes/head.php";
   ?>
   <script> 
   
        function natrag(){
            location.href="index.php";
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
                <h2>Unos fotografije</h2>
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

                    if(empty(trim($_POST['naslov']))){
                        $poruka .= "Naslov fotografije je obavezno polje za unos.<br>";
                    }else{
                        $naslov = strip_tags($_POST["naslov"]);
                    }

                    if(empty(trim($_FILES['url']['name']))){
                        $poruka .="Morate odabrati sliku za unos.<br>";
                    }
                    
                    if(empty(trim($_POST['opis']))){
                        $poruka .= "Opis fotografije je obavezno polje za unos.<br>";
                    }else{
                        $opis = strip_tags($_POST["opis"]);
                    }
                        
                    if(empty(trim($_POST['id_kategorije']))){
                        $poruka .= "Odaberite kategoriju fotografije.<br>";
                    }else{
                        $id_kategorije = strip_tags($_POST["id_kategorije"]);
                    }

                    // do postavljana kontrole pristupa autor svake nove foto biti ce korisnik s id 1
                    if(!isset($_SESSION["korisnik_id"])){
                        $_SESSION["korisnik_id"] = "undifine";
                    }
                    $id_korisnika = $_SESSION["korisnik_id"];

                    //u slučaju uspješne validacije, upload slike na server
                    if(empty($poruka)){

                        $lokacija_datoteke = "images/fotografije/"; 
                        $lokacija_datoteke = $lokacija_datoteke.basename($_FILES['url']['name']); 
    
                        $dozvoljeni_format = array("gif", "jpeg", "jpg", "png");
                        $temp = explode(".", $_FILES["url"]["name"]);
                        $ekstenzija = end($temp);
    
                        if ($_FILES["url"]["size"] < 2097152 && in_array($ekstenzija, $dozvoljeni_format)){
                            if ($_FILES["url"]["error"] > 0){
                                $poruka .= "Greška: ".$_FILES["url"]["error"]."</br>" ;
                            }
                            else{
                                if (file_exists($lokacija_datoteke)){
                                    $poruka .= "Već postoji slika pod navedenim nazivom.<br/>Molimo promijenite naziv datoteke.<br/>";
                                }
                                else{
                                    move_uploaded_file($_FILES["url"]["tmp_name"],$lokacija_datoteke);
                                }
                            }
                        }
                        else{
                            $poruka .= "Pokušavate postaviti preveliku datoteku (veću od 2MB) ili datoteku u pogrešnom formatu!<br/>";
                        }

                    }

                    //U slučaju uspješne validacije i uspješnog prebacivanja slike na server, unos podataka u bazu
                    if(empty($poruka)){

                        $upit_slike = "INSERT INTO fotografija (naslov, opis, url, id_korisnika, id_kategorije) values('$naslov','$opis','$lokacija_datoteke',$id_korisnika, $id_kategorije)";

                        $status = $baza -> promijeniDB($upit_slike);


                        if($status){
                            $poruka .= "Uspješan unos nove fotografije.";
                        }else{
                            $poruka .= "Greška kod unosa.";
                        }
                        
                    }                    

                ?>

                <!-- Vračanje poruke-->
                <div id="poruka">
                    <p>
                        <?php echo $poruka;?>
                        <input type="button" value="U redu" onclick="natrag()">
                    </p>
                </div>
        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>