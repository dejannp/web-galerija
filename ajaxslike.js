$(document).ready(function(){
    $('.gallery-form').submit(function(event){
        event.preventDefault(); // Spriječava podnošenje obrasca na uobičajeni način

        var galleryID = $('#delete-gallery-select').val(); // Dobijanje vrijednosti odabrane galerije

        $.ajax({
            type: 'POST',
            url: 'load_images.php', // Putanja do PHP skripte koja će obrađivati AJAX zahtjev
            data: {galleryID: galleryID}, // Slanje ID-a odabrane galerije PHP skripti
            success: function(response){
                // Uklanjanje postojećih slika iz galerije
                $('.gallery-container').empty();
                
                // Dodavanje novih slika u galeriju
                $('.gallery-container').append(response);
            }
        });
    });
});
