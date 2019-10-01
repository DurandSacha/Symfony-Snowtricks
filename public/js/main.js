$(document).ready(function(){

    $('.js-genus-scientist-add').click(function() {
        setTimeout(function() {

            $('.form-check-input').click(function(){
                $('.form-check-input').prop('checked', false);
                $(this).prop('checked', true);
            });

        }, 400);
    });
});














