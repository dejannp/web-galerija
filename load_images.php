<?php
// Povezivanje na bazu podataka
@include 'config.php';

// Provjera da li je primljen ID galerije putem AJAX-a
if(isset($_POST['galleryID'])){
    $galleryID = $_POST['galleryID'];

    // Izvršavanje upita za dohvaćanje slika iz odabrane galerije



    $query = "SELECT * FROM slika WHERE id_galerija = $galleryID ORDER BY ocjena DESC" ;
    $result = mysqli_query($conn, $query);

    // Provjera da li postoji barem jedan rezultat
    if(mysqli_num_rows($result) > 0) {
        // Kreiranje HTML-a za slike
        $html = '<div class="gallery-list">';
        while ($row = mysqli_fetch_assoc($result)) {
            $html .= '<div class="gallery-item">';
            $html .= "<div class='image-container'>";
            $html .= "<img src='{$row['path']}' alt='{$row['name']}' class='gallery-image'>";
            $html .= "</div>";
            
            $html .= "<div class='rate-select-container'>";
        
            $html .= "<center><p style='color: red;'>{$row['name']}</p></center>";
            $html .= "<br>";
            $html .= "<select class='rate-select' data-image-id='{$row['id']}'>";
         
            $html .= "<option value='0'  disabled selected>Odaberite ocjenu</option>";
            for ($i = 1; $i <= 5; $i++) {
                $html .= "<option value='$i'>$i</option>";
            }
            $html .= "</select>";
            $html .= "</div>";
            $html .= '</div>';
        }
        $html .= '</div>';
    } else {
        // Ako nema slika u galeriji, ispiši odgovarajuću poruku
        $html = '<div class="gallery-list">';
        $html .= "<p>Nema slika u ovoj galeriji.</p>";
        $html .= '</div>';
    }

    // Oslobađanje resursa
    mysqli_free_result($result);

    // Zatvaranje konekcije
    mysqli_close($conn);

    // CSS stilovi
    $css = <<<CSS
    /* Resetiranje stilova */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* CSS stilovi za galerijski kontejner */
    .gallery-list {
        display: flex; /* Koristimo Flexbox za raspored slika */
        flex-wrap: wrap; /* Omogućava da slike prelaze u novi red */
        justify-content: flex-start; /* Poravnavanje slika na početak reda */
        gap: 20px; /* Razmak između galerijskih elemenata */
        background-color: transparent; /* Transparentna pozadina */
        border: none; /* Uklanjamo border */
    }

    /* Stilovi za svaku pojedinačnu sliku */
    .gallery-item {
        width: 400px; /* Fiksna širina svakog gallery-item diva */
        background-color: transparent; /* Transparentna pozadina */
       border:transparent;
    }

    .image-container {
        position: relative;
        width: 100%;
        padding-top: 100%; /* Omogućava održavanje omjera slike */
        overflow: hidden;
    }

    .gallery-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 400px;
        height: 100%;
        object-fit: cover;
    }

    .rate-select-container {
        width: 100%;
        padding: 5px;
        background-color: blue; /* Transparent background */
        color: white; /* White text color */
    }

    .rate-select {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    CSS;

    // Vraćanje HTML-a slika ili poruke kao odgovor na AJAX zahtjev
    echo "<style>$css</style>";
    echo $html;
}
?>
