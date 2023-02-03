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

    <link rel="stylesheet" href="assets/css/image-uploader.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time() ?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">

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
<script type="text/javascript" src="assets/js/image-uploader.js?v=<?php echo time() ?>"></script>
<script type="text/javascript" src="assets/js/main.js?v=<?php echo time() ?>"></script>


</body>
</html>