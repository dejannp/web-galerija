<?php
$error = '';
$succes = '';
@include('config.php');

// Provjera da li su podaci poslani metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['galerija_id'])) {
    // Dobijanje podataka iz forme
    $galerija_id = $_POST['galerija_id'];
    
    // Provjera da li je galerija izabrana
    if (empty($galerija_id)) {
        $error = 'Morate izabrati galeriju!';
    } else {
        // SQL upit za brisanje galerije
        $deleteQuery = "DELETE FROM galerija WHERE id='$galerija_id'";
        
        // Izvršavanje upita
        if ($conn->query($deleteQuery)) {
            $succes = 'Galerija uspješno izbrisana!';
        } else {
            $error = 'Došlo je do greške prilikom brisanja galerije!';
        }
    }
}

// Dohvatanje svih galerija za prikaz u select kontroli
$galleries = $conn->query("SELECT id, ime FROM galerija");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Izbriši Galeriju</title>

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
        <h3>OBRIŠI GALERIJU</h3>
        <label for="galerija_id">Izaberite galeriju za brisanje:</label>
        <select id="galerija_id" name="galerija_id" required>
            <option value="">Izaberite galeriju</option>
            <?php
            if ($galleries->num_rows > 0) {
                while ($row = $galleries->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['id']}</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Izbriši galeriju" class="form-btn">
        <a href="testadmin.php">Nazad na admin stranicu</a>
    </form>
</div>




</body>
</html>
