<?php require "includes/session/provjera-prijava.php" ?>

<!DOCTYPE html>
<html lang="hr">
<head>
   <?php
   $title = "Unos Komentara";
   $description = "Web aplikacija za besplatno dijelenje fotografija. Unos komentara."; 
   $keywords = "dijelenje fotografija, komentiranje, kategorije, unos komentara"; 
    include "includes/head.php";
   ?>
</head>
<body>
    <div class="red">
        <?php include "includes/navigation.php"; ?>
        
    </div>


    <div class="red">
          <?php include "includes/header.php"; 
          $id_fotografije=$_GET['id'];

          ?>
          <section id="sadrzaj" class="t-kolona-12 d-kolona-12">
        <div class="unos">   
            <h2>Unos Komentara</h2>

            <form method="POST" action="unos-komentara-spremi.php" enctype="multipart/form-data">
                <label for="komentar">Komentar*</label><br>
                <textarea name="komentar" id="komentar" rows="6" cols="24" required></textarea><br><br>
                <input type="hidden" value="<?php echo $id_fotografije; ?>" name="id_fotografije">
                
                <label for="ocjena">Ocjena*</label><br>
                <input type="radio"  name="ocjena" value="1">1
                <input type="radio"  name="ocjena" value="2">2
                <input type="radio"  name="ocjena" value="3">3
                <input type="radio"  name="ocjena" value="4">4
                <input type="radio"  name="ocjena" value="5">5
                <br><br>          


                <input type="submit" value="U redu" name="submit">        

            </form>
            
        </div>
             
            </section>
    </div>
    <div class="red">
        <?php include "includes/footer.php"; ?>
    </div>
    
</body>
</html>