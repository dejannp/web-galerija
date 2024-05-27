<?php
$succes = '';
$error = '';
@include('config.php');

// Provjera da li su podaci poslani metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dobijanje podataka iz forme
    $naslov = $_POST['naslov'];
    $opis = $_POST['opis'];
    
    if (empty($naslov) || empty($opis)) {
        $error = 'Sva polja moraju biti popunjena!';
    } else {
        // Provjera da li galerija već postoji
        $checkQuery = "SELECT * FROM galerija WHERE ime='$naslov'";
        $result = $conn->query($checkQuery);
        
        if ($result->num_rows > 0) {
            $error = 'Galerija s ovim imenom već postoji!';
        } else {
            // SQL upit za dodavanje nove galerije
            $query = "INSERT INTO galerija (ime, opis) VALUES ('$naslov', '$opis')";
            
            // Izvršavanje upita
            if ($conn->query($query)) {
                $succes = 'Galerija uspješno dodana!';
            } else {
                $error = 'Došlo je do greške!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dodaj Galeriju</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script>
   window.onload = function() {
       <?php if (!empty($succes)) { ?>
           alert('<?php echo $succes; ?>');
       <?php } elseif (!empty($error)) { ?>
           alert('<?php echo $error; ?>');
       <?php } ?>
   }
   </script>
</head>
<body>
   
<div class="form-container">
    <form action="" method="post">
        <H3>Dodaj galeriju</H3>
        <label for="naslov">Ime galerije:</label>
        <input type="text" id="naslov" name="naslov" required placeholder="Unesite ime galerije">
        <label for="opis">Opis:</label><br>
        <input type="text" id="opis" name="opis" required placeholder="Unesite opis galerije">
        <input type="submit" value="Dodaj galeriju" class="form-btn">
        <a href="testadmin.php">Nazad na admin stranicu</a>
    </form>  
</div>



</body>
</html>
