<?php

include 'config.php';

// Provjera je li forma za slanje podataka bila submitana
if(isset($_POST['submit'])) {
    // Provjera je li sve potrebne vrijednosti dostupne
    if(isset($_POST['image_name']) && isset($_POST['image_type']) && isset($_FILES['image_path'])) {
        $image_name = $_POST['image_name'];
        $image_type = $_POST['image_type'];

        // Provjera je li datoteka uspješno učitana
        if($_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            // Provjera postoji li već slika s istim imenom u bazi
            $check_query = "SELECT * FROM slika WHERE name = '$image_name'";
            $check_result = mysqli_query($conn, $check_query);

            if(mysqli_num_rows($check_result) > 0) {
                echo "<script>
                        alert('Slika s istim imenom već postoji u bazi.');
                        setTimeout(function(){ window.location.href = 'slikaforma.php'; }, 2000);
                      </script>";
            } else {
                $tmp_name = $_FILES['image_path']['tmp_name'];
                $image_path = 'slike/' . $_FILES['image_path']['name'];

                // Premještanje datoteke na odredište
                move_uploaded_file($tmp_name, $image_path);

                // Upit za unos podataka u bazu
                $query = "INSERT INTO slika (name, id_galerija, path) VALUES ('$image_name', '$image_type', '$image_path')";
                
                // Izvršavanje upita
                if(mysqli_query($conn, $query)) {
                    echo "<script>
                            alert('Podaci su uspješno uneseni u bazu.');
                            setTimeout(function(){ window.location.href = 'slikaforma.php'; }, 2000);
                          </script>";
                } else {
                    $error_message = mysqli_error($conn);
                    echo "<script>
                            alert('Greška prilikom unosa podataka: $error_message');
                            setTimeout(function(){ window.location.href = 'slikaforma.php'; }, 2000);
                          </script>";
                }
            }
        } else {
            echo "<script>
                    alert('Greška prilikom učitavanja datoteke.');
                    setTimeout(function(){ window.location.href = 'slikaforma.php'; }, 2000);
                  </script>";
        }
    } else {
        echo "<script>
                alert('Nisu dostupni svi potrebni podaci.');
                setTimeout(function(){ window.location.href = 'slikaforma.php'; }, 2000);
              </script>";
    }
}

// Zatvaranje veze s bazom podataka
mysqli_close($conn);
?>
