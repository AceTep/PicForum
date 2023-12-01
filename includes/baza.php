<?php
    //definicija baze
    class Baza{
        
        //definicija privatnih konstanta s podacima za pristup MYSQL sustav za upravljanje bazom podataka

        private const SERVER = "localhost";
        private const KORISNICKO_IME = "4h_ucenik25";
        private const LOZINKA = "4h_ucenik25@ess";
        private const BAZA_PODATAKA = "4h_ucenik25";

        //definicija private metode za povezivanje na MYSQL sustav

        private function spojiDB() {
            
            //kreiranje objekta iz klase mysqli -> povezivanje na MYSQL sustav
            $veza = new mysqli(self::SERVER, self::KORISNICKO_IME, self::LOZINKA, self::BAZA_PODATAKA);
            
            //provjera da li je povezivanje na bazu uspjelo 

            if($veza -> connect_errno){
                die("Greška kod povezivanja na MYSQL sustav: ".$veza->connect_errno. " , ".$veza->connect_error);
            }

            //postavljanje charset-a (šaljemo SQL upit MYSQL sustavu)
            $veza->query("set names 'utf8'");

            //vraćanje objekta koji predstavljaju konekciju s bazom
            return $veza;

        }

        //definicija javne metode za dohvačanje podataka -> dostupna iz bilo kojeg dijela programa
        public function dohvatiDB($upit){
            //povetivanje na MYSQL sustav pozivom privatne metode spojiDB()
            $veza = $this -> spojiDB();

            //šaljemo SQL upit za koji će vratiti podatke
            $rezultat = $veza -> query($upit);
            
            //provjera da li MYSQL nije vratio grešku
            
            if(!$rezultat){
                die("Greška kod izvršavanja upita: ".$veza->errno. " , ".$veza->error);          
            }

            //zatvaranje konekcije s MYSQL sustavom
            $veza -> close();
            
            //skripti koja je pozvala metodu vraćamo dohvaćene podatke iz baze
            return $rezultat; 
        }        
        //definicija javne metode za promjenu podataka -> dostupna iz bilo kojeg dijela programa
        public function promijeniDB($upit){

             //povezivanje na MYSQL sustav pozivom privatne metode spojiDB()
             $veza = $this -> spojiDB();

             //šaljemo SQL upit za koji će vratiti podatke
             $rezultat = $veza -> query($upit);
             
             //provjera da li MYSQL nije vratio grešku
             
             if(!$rezultat){
                 die("Greška kod izvršavanja upita: ".$veza->errno. " , ".$veza->error);          
             }
             
             //provjera da li je upit obuhvatio barem jedan redak podataka
             if($veza ->affected_rows != 0){
                //zatvaranje konekcije s MYSQL sustavom
                $veza -> close();
            
                //vraćamo true
                return true;
             }
             else{
                //zatvaranje konekcije s MYSQL sustavom
                $veza -> close();
                
                //vraćamo false
                return false; 
             }

        }

    } 

?>