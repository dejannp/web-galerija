<?php
// Povezivanje na bazu podataka
@include 'config.php';

// Izvršavanje upita za dohvaćanje imena i ID-eva galerija
$query = "SELECT ID, ime FROM galerija";
$result = mysqli_query($conn, $query);

// Kreiranje HTML-a sa paragrafom i galerijama
$html = '<div class="gallery-container">';


// Dodavanje galerija ispod paragrafa
while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<div class='gallery-item'>";
    $html .= "<div class='gallery-id'>Galerija ID: {$row['ID']}</div>";
    $html .= "<div class='gallery-name'>Ime: {$row['ime']}</div>";
    $html .= "</div>";
}
$html .= '</div>';

// Oslobađanje resursa
mysqli_free_result($result);

// Zatvaranje konekcije
mysqli_close($conn);

// Postavljanje stilova
echo "<style>
    .gallery-container {
        margin-top: 20px; /* Dodatni razmak iznad galerija */
    }

    .gallery-item {
        background-color: white; /* Bela pozadina */
        border: 1px solid black;
        padding: 10px;
        margin-bottom: 10px;
        display: block; /* Prikaži svaki element u novom redu */
    }

    .gallery-item > div {
        margin-bottom: 5px; /* Dodatni razmak između elemenata unutar .gallery-item */
    }

    .gallery-id,
    .gallery-name {
        color: red;
        font-weight: bold;
    }
</style>";

// Vraćanje HTML-a kao odgovor na AJAX zahtjev
echo $html;
?>
