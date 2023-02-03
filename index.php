<?php
    if($_POST) {
        print_r($_POST);
        print_r($_FILES);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-language" content="en"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, without AJAX."/>
    <meta name="keywords" content="image, upload, uploader, image-uploader, jquery, gallery, file, form, static"/>
    <meta name="author" content="Christian Bayer"/>
    <meta name="copyright" content="© 2019 - Christian Bayer"/>
    <meta property="og:url" content="https://christianbayer.github.io/image-uploader/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Image-Uploader"/>
    <meta property="og:description"
          content="Image-Uploader is a simple jQuery Drag & Drop Image Uploader plugin made to be used in forms, without AJAX."/>
    <meta property="og:image" content="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png"/>

    <title>Image-Uploader</title>

    <link rel="stylesheet" href="dist/image-uploader.min.css?v=<?php echo time() ?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            font-weight: normal;
        }

        body {
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            font-weight: 300;
            color: rgba(0, 0, 0, 0.9);
            line-height: 1.5;
        }

        header {
            background-color: rgba(0, 0, 0, 0.9);
            color: rgb(255, 255, 255);
            padding: 1rem;
        }

        header p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2em;
            font-weight: 200;
            margin-bottom: 4rem;
        }

        main {
            text-align: justify;
            position: relative;
            margin: 4rem 0;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.9);
            color: rgb(255, 255, 255);
            padding: 1rem 0;
            margin-top: 4rem;
        }

        footer p {
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 1em;
            font-weight: 200;
            margin: 0;
        }

        a {
            color: #50ce7d;
            text-decoration: none;
        }

        h1,
        h4,
        h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        h1 {
            font-size: 3.6em;
            margin: 4rem 0 1rem 0;
        }

        h4 {
            font-size: 2em;
            margin: 3rem 0 1rem 0;
        }

        h6 {
            font-size: 1.2em;
            margin: 1rem 0;
        }

        h4 small {
            font-size: 70%;
            font-weight: 300;
        }

        p {
            margin: 1rem 0;
        }

        nav {
            position: absolute;
            margin-left: -12em;
        }

        nav ul {
            margin-left: 0;
            list-style: none;
        }

        nav ul li {
            padding: .2rem 0;
        }

        nav ul li a {
            font-size: 1.2em;
            font-weight: 400;
            font-family: 'Montserrat', sans-serif;
            color: #2196f3;
        }

        pre {
            font-family: 'Source Code Pro', monospace;
            margin: 1rem 0;
            padding: 1rem 1rem;
            background: #f3f3f3;
            font-size: .9em;
            overflow-x: auto;
        }

        table code,
        p code {
            font-family: 'Source Code Pro', monospace;
            background: #f3f3f3;
            font-size: .9em;
            padding: .1rem .3rem;
        }

        strong {
            font-weight: 600;
        }

        form > button {
            -webkit-appearance: none;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            padding: 1rem 2rem;
            border: none;
            background-color: #50ce7d;
            color: #fff;
            text-transform: uppercase;
            display: block;
            margin: 2rem 0 2rem auto;
            font-size: 1em;
        }

        ul {
            margin-left: 2rem;
        }

        input {
            background-color: transparent;
            border: none;
            border-radius: 0;
            outline: none;
            width: 100%;
            line-height: normal;
            font-size: 1em;
            padding: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            margin: 0;
            color: rgba(0, 0, 0, 0.72);
            background-position: center bottom, center calc(100% - 1px);
            background-repeat: no-repeat;
            background-size: 0 2px, 100% 1px;
            height: 2.4em;
        }



        .input-field {
            position: relative;
            margin-top: 2.2rem;
        }

        .comment {
            position: absolute;
            bottom: 0;
            padding: 5px;
            height: 20px;
            width: calc(100% - 0.7rem);
            border: 1px solid #ccc;
            font-size: 13px;
        }

        .container {
            width: 60%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        @media screen and (max-width: 1366px) {
            body {
                font-size: 15px;
            }

            nav ul li a {
                font-size: 1.1em;

            }
        }

        @media screen and (max-width: 992px) {
            main {
                margin: 2rem 0;
            }

            nav {
                margin-left: -10em;
            }
        }

        @media screen and (max-width: 786px) {
            body {
                font-size: 14px;
            }

            nav {
                display: none;
            }

            .container {
                width: 80%;
            }
        }

        @media screen and (max-width: 450px) {
            .container {
                width: 90%;
            }
        }
    </style>

</head>
<body>

<main>
    <div class="container">
        <form method="POST" name="form-example-2" id="form-example-2" enctype="multipart/form-data" action="">

            <div class="input-field">
                <label class="active">Photos</label>
                <div class="input-images-2" style="padding-top: .5rem;"></div>
            </div>

            <button>Submit and display data</button>
        </form>
    </div>
</main>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="dist/image-uploader.min.js"></script>

<script>
    $(function () {

        $('.input-images-2').imageUploader({
            imagesInputName: 'photos',
            preloadedInputName: 'old',
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10
        });

        $('form').on('submit', function (event) {

            // Stop propagation
            /*event.preventDefault();
            event.stopPropagation();*/

            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Set name and description
            //$modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            //$modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }

            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {text: file.name}).appendTo($fileNames);
            }

            // Set the new files names
            //$modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {

                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                //$modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            } else {

                // Hide the preloaded info
                //$modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            //$modal.css('visibility', 'visible');
        });

        // Input and label handler
        $('input').on('focus', function () {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function () {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });

        // Sticky menu
        let $nav = $('nav'),
            $header = $('header'),
            offset = 4 * parseFloat($('body').css('font-size')),
            scrollTop = $(this).scrollTop();

        // Initial verification
        setNav();

        // Bind scroll
        $(window).on('scroll', function () {
            scrollTop = $(this).scrollTop();
            // Update nav
            setNav();
        });

        function setNav() {
            if (scrollTop > $header.outerHeight()) {
                $nav.css({position: 'fixed', 'top': offset});
            } else {
                $nav.css({position: '', 'top': ''});
            }
        }
    });
</script>

</body>
</html>