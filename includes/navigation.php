<nav id="navigacija" class="t-kolona-12 d-kolona-12">		
    <input type="checkbox" id="oznaci" />
    <label for="oznaci" class="prikazi_gumbic">
        <i class="fas fa-ellipsis-h"></i>
    </label>
    <ul>
        <li><a href="index.php">Početna</a></li>
        <?php 
        if(!isset($_SESSION["status"])){
            $_SESSION["status"] = "undifine";
        }
        if(!isset($_SESSION["tip_id"])){
            $_SESSION["tip_id"] = "undifine";
        }
        
        
        if($_SESSION["status"] == 1) {
        echo 
        "<li><a href='unos-fotografije.php'>Dodaj fotografiju</a></li>
         <li><a href='korisnici.php'>Korisnički podaci</a></li>";}
        
         if($_SESSION["status"] == 1 AND ($_SESSION["tip_id"] == 1 OR $_SESSION["tip_id"] == 2)){
             echo "<li><a href='kategorije.php'>Kategorije</a></li>";
         }    
        ?>       
        <label for="oznaci" class="sakrij_gumbic">
            <i class="fas fa-times"></i>
        </label>
    </ul>
</nav>