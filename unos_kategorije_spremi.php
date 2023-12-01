<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Kategorije";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos Kategorije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos Kategorije"; 
    include "includes/head.php";
   ?>
   <script> 
   
        function natrag(){
            location.href="kategorije.php";
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
                <h2>Unos Kategorije</h2>
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

                    if(empty(trim($_POST['ime_kategorije']))){
                        $poruka .= "Ime Kategorije je obavezno polje za unos.<br>";
                    }else{
                        $ime_kategorije = strip_tags($_POST["ime_kategorije"]);
                    }

                    if(empty(trim($_FILES['slika_kategorije']['name']))){
                        $poruka .="Morate odabrati sliku za unos.<br>";
                    }
                    
                        
                    if(empty(trim($_POST['id_korisnika']))){
                        $poruka .= "Odaberite moderatora kategorije.<br>";
                    }else{
                        $id_korisnika = strip_tags($_POST["id_korisnika"]);
                    }

                    //u slučaju uspješne validacije, upload slike na server
                    if(empty($poruka)){

                        $lokacija_datoteke = "images/kategorije/"; 
                        $lokacija_datoteke = $lokacija_datoteke.basename($_FILES['slika_kategorije']['name']); 
    
                        $dozvoljeni_format = array("gif", "jpeg", "jpg", "png");
                        $temp = explode(".", $_FILES["slika_kategorije"]["name"]);
                        $ekstenzija = end($temp);
    
                        if ($_FILES["slika_kategorije"]["size"] < 2097152 && in_array($ekstenzija, $dozvoljeni_format)){
                            if ($_FILES["slika_kategorije"]["error"] > 0){
                                $poruka .= "Greška: ".$_FILES["slika_kategorije"]["error"]."</br>" ;
                            }
                            else{
                                if (file_exists($lokacija_datoteke)){
                                    $poruka .= "Već postoji slika pod navedenim nazivom.<br/>Molimo promijenite naziv datoteke.<br/>";
                                }
                                else{
                                    move_uploaded_file($_FILES["slika_kategorije"]["tmp_name"],$lokacija_datoteke);
                                }
                            }
                        }
                        else{
                            $poruka .= "Pokušavate postaviti preveliku datoteku (veću od 2MB) ili datoteku u pogrešnom formatu!<br/>";
                        }

                    }

                    //U slučaju uspješne validacije i uspješnog prebacivanja slike na server, unos podataka u bazu
                    if(empty($poruka)){

                        $upit_slike = "INSERT INTO kategorija (ime_kategorije, slika_kategorije, id_korisnika) values('$ime_kategorije','$lokacija_datoteke',$id_korisnika)";

                        $status = $baza -> promijeniDB($upit_slike);


                        if($status){
                            $poruka .= "Uspješan unos nove kategorije.";
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