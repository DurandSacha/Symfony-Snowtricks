

// id : add_tricks_form_Illustration_0_thumbnail
// class : form-check-input


//var radio =$('.form-check-input').prop("checked", false)
//radio.attr('checked', false);

$(document).ready(function(){


    setInterval(function() {
        // fonctionnel sur le bouton Add Media
        var number = 0;
        $('#add_button_media').click(function() {
            number++;
        });

        // fonctionne
        $('.form-check-input').click( function() {
            console.log('radio captured');
            reinizialise(number);
        });



    }, 4000);

    function reinizialise(number){

            var radios = $('.form-check-input');
            if(radios)
            {
                radios.checked = false;
                console.log(number);
                for (i=0; i < number ; i++)
                {
                    radios[i].checked = false;
                    var radio = $('#add_tricks_form_Illustration_' + number +'_thumbnail');
                    console.log(i);

                    if( radio.click() ){
                        radio[i].checked = true;
                    }
                    else{
                        radio[i].checked = false;
                    }




                }
            }
        }

    function select(){

    }


});

/*
$('#foo').bind('click', function() {
  alert('User clicked on "foo."');
});
 */



















