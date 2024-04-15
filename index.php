<?php
// Include file uploadClass.php yang berisi definisi kelas uploadClass
include 'Class/upload.class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Upload File</title>
</head>
<body class="center-middle">
    <div class="box">
        <?php
            // Membuat objek dari kelas uploadClass
            $uploader = new uploadClass();
            // Memanggil metode upload
            if(isset($_POST["submit"])) {
                $uploader->upload();
            }
        ?>
        <h2>Form Upload File</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" class="button-style" name="submit">
        </form>
        <h3>List of the last 3 uploaded files:</h3>
        <?php $uploader->displayUploadedFiles();?>
    </div>
</body>
</html>
