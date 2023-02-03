<?php
require_once ("connection.php");
const EXCEPTED_EXTENSION_TYPE = ["jpg", "jpeg", "png", "gif", "svg", "pdf"];
const EXCEPTED_MIME_TYPE = ["image/jpeg", "image/png", "image/gif", "image/svg+xml", "application/pdf"];
const EXCEPTED_SIZE = 5;

if($_POST) {
    $error_messages = [];

    if(!empty($_FILES['photos']['name'])) {
        for($i=0; $i<count($_FILES['photos']['name']); $i++) {

            $imageFileExtension = strtolower(pathinfo($_FILES['photos']['name'][$i],PATHINFO_EXTENSION));
            if(!in_array($imageFileExtension, EXCEPTED_EXTENSION_TYPE)) {
                $error_messages[] = 'The file "'.$_FILES['photos']['name'][$i].'" does not match with the accepted file extensions: ".jpg", ".jpeg", ".png", ".gif", ".svg", ".pdf"';
            }

            $mime_type = mime_content_type($_FILES["photos"]["tmp_name"][$i]);
            if(!in_array($mime_type, EXCEPTED_MIME_TYPE)) {
                $error_messages[] = 'The file "'.$_FILES['photos']['name'][$i].'" is a fake file. Accepted files: ".jpg", ".jpeg", ".png", ".gif", ".svg", ".pdf"';
            }

            $fileSize = filesize($_FILES["photos"]["tmp_name"][$i]);
            if($fileSize > EXCEPTED_SIZE * 1024 * 1024) {
                $error_messages[] = 'The file "'.$_FILES['photos']['name'][$i].'" exceeds the maximum size of '.EXCEPTED_SIZE.'Mb';
            }
        }
        $data = [];
        if(!empty($error_messages)) {
            $data['message'] = 'invalid';
            $data['errors'] = $error_messages;
        }
        else {
            for($i=0; $i<count($_FILES['photos']['name']); $i++) {
                $mime_type = mime_content_type($_FILES["photos"]["tmp_name"][$i]);
                $target_dir = ($mime_type ==='application/pdf')?"uploads/pdf/":"uploads/images/";

                $filename = uniqid().'_'. basename($_FILES["photos"]["name"][$i]);

                $target_file = $target_dir . $filename;
                move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file);

                /* @var $conn */
                $stmt = $conn->prepare("INSERT INTO files (file, mime_type, comment) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $file, $mime, $comment);

                $file = $filename;
                $mime = $mime_type;
                $comment = $_POST['comment_'.$i];
                $stmt->execute();
            }
            $data['message'] = 'Files uploaded successfully';
        }
        echo json_encode($data);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Image PDF Uploader</title>

    <link rel="stylesheet" href="dist/image-uploader.min.css?v=<?php echo time() ?>">

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

        .err {
            color: #ff0000;
        }

        .preview {
            color: #2d562d;
            font-weight: bold;
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
        <div id="err" class="err" style="display: none">
        </div>
        <div id="preview" class="preview" style="display: none">
        </div>
        <form method="POST" name="form-example-2" id="form-example-2" enctype="multipart/form-data">

            <div class="input-field">
                <label class="active">Photos</label>
                <div class="input-images-files" style="padding-top: .5rem;"></div>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</main>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="dist/image-uploader.min.js?v=<?php echo time() ?>"></script>

<script>
    $(function () {

        $('.input-images-files').imageUploader({
            imagesInputName: 'photos',
            preloadedInputName: 'old',
            maxSize: <?php echo EXCEPTED_SIZE ?> * 1024 * 1024
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
</script>

</body>
</html>