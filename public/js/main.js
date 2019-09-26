

// id : add_tricks_form_Illustration_0_thumbnail
// class : form-check-input


//var radio =$('.form-check-input').prop("checked", false)
//radio.attr('checked', false);

$(document).ready(function(){

    setInterval(function() {

    // fonctionnel sur le bouton Add Media
    $('#add_button_media').click(function() {
        console.log('Media Form Ajouté');

    });

    // fonctionne
    $('.form-check-input').click( function() {
        console.log('form check input captured');
    });


    }, 1000);
});
















