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

    <script>
        function natrag(){
            location.href="kategorije.php";
        }
    </script>
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
        <section id="sadrzaj" class="tkolona12 dkolona12">
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

                    if(empty(trim($_POST['Naziv_Kategorije']))){
                        $poruka .= "Naziv Kategorije je obavezno polje za unos.<br>";
                    }else{
                        $Naziv_Kategorije = strip_tags($_POST["Naziv_Kategorije"]);
                    }

                    if(empty(trim($_FILES['Slika_Kategorije']['name']))){
                        $poruka .="Morate odabrati sliku za unos.<br>";
                    }
                    
                        
                    if(empty(trim($_POST['ID_Korisnika']))){
                        $poruka .= "Odaberite moderatora kategorije.<br>";
                    }else{
                        $ID_Korisnika = strip_tags($_POST["ID_Korisnika"]);
                    }

                    //u slučaju uspješne validacije, upload slike na server
                    if(empty($poruka)){

                        $lokacija_datoteke = "slike/kategorije/"; 
                        $lokacija_datoteke = $lokacija_datoteke.basename($_FILES['Slika_Kategorije']['name']); 
    
                        $dozvoljeni_format = array("gif", "jpeg", "jpg", "png");
                        $temp = explode(".", $_FILES["Slika_Kategorije"]["name"]);
                        $ekstenzija = end($temp);
    
                        if ($_FILES["Slika_Kategorije"]["size"] < 2097152 && in_array($ekstenzija, $dozvoljeni_format)){
                            if ($_FILES["Slika_Kategorije"]["error"] > 0){
                                $poruka .= "Greška: ".$_FILES["Slika_Kategorije"]["error"]."</br>" ;
                            }
                            else{
                                if (file_exists($lokacija_datoteke)){
                                    $poruka .= "Već postoji slika pod navedenim nazivom.<br/>Molimo promijenite naziv datoteke.<br/>";
                                }
                                else{
                                    move_uploaded_file($_FILES["Slika_Kategorije"]["tmp_name"],$lokacija_datoteke);
                                }
                            }
                        }
                        else{
                            $poruka .= "Pokušavate postaviti preveliku datoteku (veću od 2MB) ili datoteku u pogrešnom formatu!<br/>";
                        }

                    }

                    //U slučaju uspješne validacije i uspješnog prebacivanja slike na server, unos podataka u bazu
                    if(empty($poruka)){

                        $upit_slike = "INSERT INTO kategorija (Naziv_Kategorije, Slika_Kategorije, ID_Korisnika) values('$Naziv_Kategorije','$lokacija_datoteke',$ID_Korisnika)";

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
        <?php
            include "includes/footer.php";
        ?> 
    </div>
</body>
</html>