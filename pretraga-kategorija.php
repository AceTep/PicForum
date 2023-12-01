<?php
session_start();
    //uključivanje vanjske PHP skripte s definicjom klase Baza()
    require_once "includes/baza.php";
    if(!isset($_SESSION["status"])){
        $_SESSION["status"] = "undefine";
    }
    //dohvacanje get parametra sa zahjevom

    $pojam = $_GET["parametar"];
    //kreiranje objekta iz klase Baza()
    $baza = new Baza();
    
    //definicija SQL upita koji se šalje MYSQL bazi podataka
    $upit="SELECT kategorija.id_kategorije, ime_kategorije, slika_kategorije, COUNT(*) AS 'broj' FROM kategorija INNER JOIN fotografija ON kategorija.id_kategorije = fotografija.id_kategorije  
    WHERE lower(ime_kategorije) LIKE lower( '$pojam%')
    GROUP BY ime_kategorije  ORDER BY ime_kategorije";
    //šaljemo SQL upit MYSQL-u pozivom metode dohvatiDB()
    $rezultat = $baza -> dohvatiDB($upit);

    // ugradnja dohvaćenih podataka iz baze u željenji HTML format
    echo "<div class='kategorije'>"; 
    while($red = $rezultat->fetch_array()){
        $id_kategorije=$red["id_kategorije"];

        if($_SESSION["status"] == 1){
        echo "<a href='fotografije.php?id=$id_kategorije'>";
        echo "<div class = 'slika' ><img src='".$red["slika_kategorije"]."' alt='".$red["ime_kategorije"]."' width='150' height='200'/></a>
        <p>".$red["ime_kategorije"]."(".$red["broj"].")</p></div>"; }
        else{
            echo "<a href='#' onclick='porukaPrijava(); return false;'>";
            echo "<div class = 'slika' ><img src='".$red["slika_kategorije"]."' alt='".$red["ime_kategorije"]."' width='150' height='200'/></a>
            <p>".$red["ime_kategorije"]."(".$red["broj"].")</p></div>";
        }


        
    }
    echo "</div>"; 

                   
?>