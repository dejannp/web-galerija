<?php
@include 'config.php';

// Provjera da li su primljeni podaci putem AJAX-a
if(isset($_POST['imageName']) && isset($_POST['rating']) && isset($_POST['name'])){
    $imageName = $_POST['imageName'];
    $rating = $_POST['rating'];
    $name = $_POST['name'];

    // Provjera da li korisnik već ocijenio sliku
    $checkQuery = "SELECT * FROM korisnik_ocjena WHERE korisnik_name = '$name' AND imageName = '$imageName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    // Ako korisnik već ocijenio sliku, ispiši odgovarajuću poruku i nemoj izvršavati ažuriranje ocjene
    if(mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Već ste ocijenili ovu sliku.');</script>";
    } else {
        // Ako korisnik nije ocijenio sliku, ažuriraj ocjenu u bazi podataka


        $tempocena = mysqli_query($conn, "SELECT ocjena FROM slika WHERE name = '$imageName'");
        if($tempocena !== false && $tempocena->num_rows > 0) {
            // Ako postoji rezultat, dohvati ocjenu iz rezultata
            $row = $tempocena->fetch_assoc();
            $currentRating = $row['ocjena'];

        }
if($currentRating==0){
    $updateQuery = "UPDATE slika SET ocjena = $rating WHERE name = '$imageName'";

}
else{
    $currentRating=($currentRating+$rating)/2;
    $updateQuery = "UPDATE slika SET ocjena = $currentRating WHERE name = '$imageName'";
}
        $updateResult = mysqli_query($conn, $updateQuery);

        if($updateResult){
            // Dodaj zapis u tabelu korisnik_ocjena
            $insertQuery = "INSERT INTO korisnik_ocjena (korisnik_name, imageName, ocjena) VALUES ('$name', '$imageName', $rating)";
            $insertResult = mysqli_query($conn, $insertQuery);

            if($insertResult){
                echo "<script>alert('Ocjena uspješno ažurirana.');</script>";
            } else {
                echo "<script>alert('Greška prilikom dodavanja zapisa u tabelu korisnik_ocjena.');</script>";
            }
        } else {
            echo "<script>alert('Greška prilikom ažuriranja ocjene.');</script>";
        }
    }

    // Zatvaranje konekcije
    mysqli_close($conn);
}
?>
