<?php session_start();?>
<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Uređivanje fotografije";
   $description = "Uređivanje odabrane fotografije."; 
   $keywords = "uredi fotografiju"; 
    include "includes/head.php";
   ?>
      <script> 
   
        function natrag(id){
            location.href="detalji-fotografije.php?id="+id;
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
                <h2>Uređivanje fotografije</h2>
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
                       $url = "";
                    }else{
                        $url = $_FILES['url']['name'];
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

                    if(empty(trim($_POST['id_fotografije']))){
                        $poruka .= "Nije dostavljen ID fotografije <br>";
                    }else{
                        $id_fotografije = strip_tags($_POST["id_fotografije"]);
                    }


                    //u slučaju uspješne validacije i ako je odabrana nova fotografija, upload slike na server
                    if(empty($poruka) && !empty($url)){

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

                    //U slučaju uspješne validacije i (uspješnog prebacivanja slike na server), anzuriranje podataka u bazi 
                    if(empty($poruka)){

                        if(!empty($url)){
                            
                            $upit = "UPDATE fotografija SET naslov='$naslov', opis='$opis', url='$lokacija_datoteke', id_kategorije=$id_kategorije WHERE id_fotografije =  $id_fotografije";
                            
                        }else{

                            $upit = "UPDATE fotografija SET naslov='$naslov', opis='$opis', id_kategorije=$id_kategorije WHERE id_fotografije =  $id_fotografije";                   

                        }

                        $status = $baza -> promijeniDB($upit);
                        if($status){
                            $poruka .= "Uspješno anžuriranje fotografije";
                        }else{
                            $poruka .= "Neuspješno anžuriranje fotografije";
                        }

                    }                    

                ?>

                <!-- Vračanje poruke-->
                <div id="poruka">
                    <p>
                        <?php echo $poruka;?>
                        <input type="button" value="U redu" onclick="natrag(<?php echo $id_fotografije; ?>)">
                    </p>
                </div>
        </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>