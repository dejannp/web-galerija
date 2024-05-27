<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Upload Image Form</title>

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="upload.php" method="post" enctype="multipart/form-data">
      <h3>Dodaj sliku</h3>
      
     
      <label for="image_name">Unesite ime slike:</label>
      <input type="text" name="image_name" required placeholder="Ime slike">
      <label for="image_type">Odaberite ID galerije u koju želite dodati sliku:</label>
      <select name="image_type" id="image_type">
         <?php
            // Povezivanje na bazu podataka
            include 'config.php';

            // Izvršavanje upita za dohvaćanje ID-eva galerija
            $query = "SELECT ID FROM galerija";
            $result = mysqli_query($conn, $query);

            // Prolazak kroz rezultate i stvaranje opcija za select
            while ($row = mysqli_fetch_assoc($result)) {
               echo "<option value='{$row['ID']}'>{$row['ID']}</option>";
            }

            // Oslobađanje resursa
            mysqli_free_result($result);

            // Zatvaranje konekcije
            mysqli_close($conn);
         ?>
      </select>
      <label for="image_path">Odaberite putanju slike:</label>
      <input type="file" name="image_path" required accept=".jpg, .png, .jpeg, .gif, .svg" placeholder="Enter image path">
      <input type="submit" name="submit" value="Dodaj" class="form-btn">

      
      <a href="testadmin.php">Nazad na admin stranicu</a>
   </form>
</div>

</body>
</html>
