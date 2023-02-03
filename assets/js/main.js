$(function () {

    $('.input-images-files').imageUploader({
        imagesInputName: 'photos',
        preloadedInputName: 'old',
        maxSize: 5 * 1024 * 1024
});

    $('form#form-example-2').on('submit', function (event) {
        event.preventDefault();

        // Get some vars
        let $form = $(this);
        // Get the input file
        $inputImages = $form.find('input[name^="photos"]')

        // Get the new files names
        let $fileNames = $('<ul>');
        for (let file of $inputImages.prop('files')) {
            $('<li>', {text: file.name}).appendTo($fileNames);
        }

        $.ajax({
            url: "",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend : function()
            {
                $("#err").fadeOut();
            },
            success: function(data)
            {
                data1 = jQuery.parseJSON(data);

                if(data1.message==='invalid')
                {
                    $("#preview").css('display', 'none');

                    error_str = '';
                    $.each(data1.errors, function( index, value ) {
                        //alert( index + ": " + value );
                        error_str += '<li>'+value+'</li>';
                    });
                    $("#err").html('<ul>'+error_str+'</ul>').fadeIn();
                }
                else
                {
                    $("#err").css('display', 'none');
                    $("#preview").html(data1.message).fadeIn();

                    setTimeout(function() {
                        jQuery("#preview").hide('slow');
                        location.reload();
                    }, 2000);
                }
            },
            error: function(e)
            {
                $("#err").html(e).fadeIn();
            }
        });

    });
});