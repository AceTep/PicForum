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
                        $slika_kategorije = "";
                    }else{
                        $slika_kategorije=$_FILES['slika_kategorije']['name'];
                    }
                    
                        
                    if(empty(trim($_POST['id_korisnika']))){
                        $poruka .= "Odaberite moderatora kategorije.<br>";
                    }else{
                        $id_korisnika = strip_tags($_POST["id_korisnika"]);
                    } 
                    if(empty(trim($_POST['id_kategorije']))){
                        $poruka .= "Nije dostavljen ID kategorije.<br>";
                    }else{
                        $id_kategorije = strip_tags($_POST["id_kategorije"]);
                    }

                    //u slučaju uspješne validacije, upload slike na server
                    if(empty($poruka) && !empty($slika_kategorije)){

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
                    if(empty($poruka)){

                        if(!empty($slika_kategorije)){
                            
                            $upit = "UPDATE kategorija SET ime_kategorije='$ime_kategorije',  slika_kategorije='$lokacija_datoteke', id_korisnika=$id_korisnika WHERE id_kategorije =  $id_kategorije";
                            
                        }else{

                            $upit = "UPDATE kategorija SET ime_kategorije='$ime_kategorije', id_korisnika=$id_korisnika WHERE id_kategorije =  $id_kategorije";                   

                        }

                        $status = $baza -> promijeniDB($upit);
                        if($status){
                            $poruka .= "Uspješno anžuriranje kategorije";
                        }else{
                            $poruka .= "Neuspješno anžuriranje kategorije";
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