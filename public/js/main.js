$(document).ready(function(){

    // $('#id').prop('checked', true);
    //$('#add_tricks_form_Illustration_0_thumbnail').prop('checked', true);

    $('.js-genus-scientist-add').click(function(e) {
        setTimeout(function() {

            var radios = $('.form-check-input') ;
            //var radio = $('#add_tricks_form_Illustration_0_thumbnail');

            radios.click(function() {

                radios.prop('checked', false);

                for (var i = 0;i<5; i++)
                {
                    var radio = $('#add_tricks_form_Illustration_' + i + '_thumbnail');
                    if (radio.is(':checked')) {
                        radio.prop('checked', true);
                    }
                }
            });

        }, 1000);
    });
});














