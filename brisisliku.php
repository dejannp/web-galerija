<?php
$error = '';
$success = '';
@include('config.php');

// Provjera da li su podaci poslani metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['slika_name'])) {
    // Dobijanje podataka iz forme
    $slika_name = $_POST['slika_name'];
    
    // Provjera da li je slika izabrana
    if (empty($slika_name)) {
        $error = 'Morate izabrati sliku!';
    } else {
        // SQL upit za brisanje slike
        $deleteQuery = "DELETE FROM slika WHERE name='$slika_name'";
        
        // Izvršavanje upita
        if ($conn->query($deleteQuery)) {
            $success = 'Slika uspješno izbrisana!';
        } else {
            $error = 'Došlo je do greške prilikom brisanja slike!';
        }
    }
}

// Dohvatanje svih slika za prikaz u select kontroli
$images = $conn->query("SELECT name FROM slika");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Izbriši Sliku</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script>
   window.onload = function() {
       <?php if (!empty($success)) { ?>
           alert('<?php echo $success; ?>');
       <?php } elseif (!empty($error)) { ?>
           alert('<?php echo $error; ?>');
       <?php } ?>
   }
   </script>
</head>
<body>
   
<div class="form-container">
    <form action="" method="post">
        <h3>OBRIŠI SLIKU</h3>
        <label for="slika_name">Izaberite sliku za brisanje:</label>
        <select id="slika_name" name="slika_name" required>
            <option value="">Izaberite sliku</option>
            <?php
            if ($images->num_rows > 0) {
                while ($row = $images->fetch_assoc()) {
                    echo "<option value='{$row['name']}'>{$row['name']}</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Izbriši sliku" class="form-btn">
        <a href="testadmin.php">Nazad na admin stranicu</a>
    </form>
</div>

</body>
</html>
