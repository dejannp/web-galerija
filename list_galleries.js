

function listGalleries() {
  
    
    // AJAX poziv za dohvaćanje galerija i prikaz u divu #gallery-list
    $.ajax({
        url: 'list_galleries.php',
        type: 'GET',
        success: function(response) {
            $('#gallery-list').html(response);
        }
    });
}

