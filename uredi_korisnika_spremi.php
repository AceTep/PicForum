
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Uredi Korisnika";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos fotografije."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos fotografije"; 
    include "includes/head.php";
   ?>
   <script> 
   
        function natrag(){
            location.href="korisnici.php";
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
                <h2>Uredi Korisnika</h2>
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

                    if(empty(trim($_POST['korisnicko_ime']))){
                        $poruka .= "Korisničko ime je obavezno polje za unos.<br>";
                    }else{
                        $korisnicko_ime = strip_tags($_POST["korisnicko_ime"]);
                    }

                    
                    
                    if(empty(trim($_POST["lozinka1"])) OR empty(trim($_POST["lozinka1"]))){
                        $poruka .= "Upišite staru ili novu lozinku.<br>";
                    }elseif($_POST["lozinka1"] !== $_POST["lozinka2"]){
                        $poruka .= "Lozinke se moraju podudarati.<br>";
                    }else{
                        $lozinka1 = md5(strip_tags($_POST["lozinka1"]));
                    }

                    if(empty(trim($_POST['ime_prezime']))){
                        $poruka .= "Ime i prezime je obavezno polje za unos.<br>";
                    }else{
                        $ime_prezime = strip_tags($_POST["ime_prezime"]);
                    }

                    if(empty(trim($_POST['email']))){
                        $poruka .= "Email je obavezno polje za unos.<br>";
                    }else{
                        $email = strip_tags($_POST["email"]);
                    }

                    if(empty(trim($_POST['adresa']))){
                        $adresa = "";
                    }else{
                        $adresa = strip_tags($_POST["adresa"]);
                    }

                    if(empty(trim($_POST['broj_mobitela']))){
                        $broj_mobitela = "";
                    }else{
                        $broj_mobitela = strip_tags($_POST["broj_mobitela"]);
                    }

                    if(empty(trim($_FILES['slika_profila']['name']))){
                        $slika_profila ="";
                    }else{
                        $slika_profila = $_FILES['slika_profila']['name'];
                    }
                                            
                    if(empty(trim($_POST['id_grupe']))){
                        $poruka .= "Odaberite kategoriju fotografije.<br>";
                    }else{
                        $id_grupe = strip_tags($_POST["id_grupe"]);
                    }
                    if(empty(trim($_POST['id_korisnika']))){
                        $poruka .= "ID koirsnika nije dostavljen.<br>";
                    }else{
                        $id_korisnika = strip_tags($_POST["id_korisnika"]);
                    }

                    //u slučaju uspješne validacije, upload slike na server
                    if(empty($poruka) AND !empty($slika_profila)){

                        $lokacija_datoteke = "images/korisnici/"; 
                        $lokacija_datoteke = $lokacija_datoteke.basename($_FILES['slika_profila']['name']); 
    
                        $dozvoljeni_format = array("gif", "jpeg", "jpg", "png");
                        $temp = explode(".", $_FILES["slika_profila"]["name"]);
                        $ekstenzija = end($temp);
    
                        if ($_FILES["slika_profila"]["size"] < 2097152 && in_array($ekstenzija, $dozvoljeni_format)){
                            if ($_FILES["slika_profila"]["error"] > 0){
                                $poruka .= "Greška: ".$_FILES["slika_profila"]["error"]."</br>" ;
                            }
                            else{
                                if (file_exists($lokacija_datoteke)){
                                    $poruka .= "Već postoji slika pod navedenim nazivom.<br/>Molimo promijenite naziv datoteke.<br/>";
                                }
                                else{
                                    move_uploaded_file($_FILES["slika_profila"]["tmp_name"],$lokacija_datoteke);
                                }
                            }
                        }
                        else{
                            $poruka .= "Pokušavate postaviti preveliku datoteku (veću od 2MB) ili datoteku u pogrešnom formatu!<br/>";
                        }

                    }

                    //U slučaju uspješne validacije i uspješnog prebacivanja slike na server, unos podataka u bazu
                    if(empty($poruka)){
                        if(!empty($slika_profila)){
                            
                            if(empty($adresa) AND !empty($broj_mobitela)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', broj_mobitela = '$broj_mobitela', slika_profila='$lokacija_datoteke', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }elseif(empty($broj_mobitela) AND !empty($adresa)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', adresa='$adresa', slika_profila='$lokacija_datoteke', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }elseif(empty($adresa) AND empty($broj_mobitela)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email',  slika_profila='$lokacija_datoteke', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }else{
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', adresa='$adresa', broj_mobitela = '$broj_mobitela', slika_profila='$lokacija_datoteke', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika"; 
                            }

                        }else{
                            if(empty($adresa) AND !empty($broj_mobitela)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', broj_mobitela = '$broj_mobitela',  id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }elseif(empty($broj_mobitela) AND !empty($adresa)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', adresa='$adresa', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }elseif(empty($adresa) AND empty($broj_mobitela)){
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika";
                            }else{
                                $upit = "UPDATE korisnik SET korisnicko_ime='$korisnicko_ime', lozinka ='$lozinka1', email='$email', adresa='$adresa', broj_mobitela = '$broj_mobitela',  id_grupe='$id_grupe' WHERE id_korisnika = $id_korisnika"; 
                            }
                        }
                            

                        $status = $baza -> promijeniDB($upit);
                        if($status){
                            $poruka .= "Uspješno anžurirani podatci korisnika.";
                        }else{
                            $poruka .= "Greška kod anžuriranja.";
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