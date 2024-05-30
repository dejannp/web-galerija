// JavaScript za slanje AJAX zahtjeva kada se promijeni ocjena u selectu
$(document).ready(function(){
    $('.rate-select').change(function(){
        var imageID = $(this).closest('.gallery-item').find('.gallery-image').attr('alt');
        var rating = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'ocjeni.php', 
            data: { imageID: imageID, rating: rating },
            success: function(response){
                alert('Ocjena je uspješno ažurirana.');
            },
            
        });
    });
});
