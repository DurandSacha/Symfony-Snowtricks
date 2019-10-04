var element = document.getElementById('data');



        jQuery(document).ready(function() {
            var $wrapper = $('.js-genus-scientist-wrapper');
            $wrapper.on('click', '.js-remove-scientist', function(e) {
                e.preventDefault();
                $(this).closest('.js-genus-scientist-item')
                    .fadeOut()
                    .remove();
            });
            $wrapper.on('click', '.js-genus-scientist-add', function(e) {
                e.preventDefault();

                var prototype = $wrapper.data('prototype');
                var index = $wrapper.data('index');
                var newForm = prototype.replace(/__name__/g, index);
                $wrapper.data('index', index + 1);

                $(this).before(newForm);
            });


            var $embed = $('.js-embed-scientist-wrapper');
            $embed.on('click', '.js-embed-scientist-add', function(e) {
                e.preventDefault();
                // Get the data-prototype explained earlier
                var prototype = $embed.data('prototype');
                // get the new index
                var index = $embed.data('index');
                // Replace '__name__' in the prototype's HTML to
                // instead be a number based on how many items we have
                var Formulaire = prototype.replace(/__name__/g, index);
                // increase the index with one for the next item
                $embed.data('index', index + 1);
                // Display the form in the page before the "new" link
                $(this).before(Formulaire);
            });




        });