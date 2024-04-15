<?php
class uploadClass {
    function upload() {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is empty or doesn't have a name
        if ($_FILES["fileToUpload"]["size"] == 0 || $_FILES["fileToUpload"]["name"] == "") {
            echo "<p>File is empty or doesn't have a name.</p>";
            $uploadOk = 0;
        }

        // Check if file is an image
        if ($uploadOk && getimagesize($_FILES["fileToUpload"]["tmp_name"]) === false) {
            echo "<p>File is not an image.</p>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if ($uploadOk && file_exists($targetFile)) {
            echo "<p>Sorry, file already exists.</p>";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($uploadOk && $_FILES["fileToUpload"]["size"] > 100000) {
            echo "<p>Sorry, your file is too large. Maximum file size is 100KB.</p>";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ($uploadOk && !in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<p>Sorry, your file was not uploaded.</p>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "<p>The file <i>'". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). "'</i> has been uploaded.</p>";
            } else {
                echo "<p>Sorry, there was an error uploading your file.</p>";
            }
        }
    }

    function displayUploadedFiles() {
        $targetDir = "uploads/";
        $files = scandir($targetDir);

        // Buat array kosong untuk menyimpan waktu modifikasi file
        $fileDates = array();        
        
        foreach ($files as $file) {
            if ($file != "." && $file != ".." && $file != "index.html") {
                $fileDates[$file] = filemtime($targetDir . $file);
            }
        }

        echo "<ul>";

        // Urutkan array berdasarkan waktu modifikasi secara descending
        arsort($fileDates);

        // Ambil hanya 10 file terakhir
        $lastTenFiles = array_slice($fileDates, 0, 3, true);        
        foreach ($lastTenFiles as $file => $date) {
            echo "<li>$file</li>";
        }        
        echo "</ul>";
    }
    
}
?>
