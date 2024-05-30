$(document).ready(function(){
    // Delegiranje događaja za .rate-select elemente na .content element
    $('.content').on('change', '.rate-select', function(){
        var imageName = $(this).closest('.gallery-item').find('.gallery-image').attr('alt');
        var rating = $(this).val();
        var name = $('#test-div').data('name');
        
        $.ajax({
            type: 'POST',
            url: 'ocjenii.php', // Naziv PHP skripte za ažuriranje ocjene
            data: {
                imageName: imageName,
                rating: rating,
                name: name
            },
            success: function(response){
                
                console.log(response);
                $('#rezultat_ocjene').html(response);
             
                
            },
            error: function(xhr, status, error){
                
                console.error(error);
            }
        });
    });
});
