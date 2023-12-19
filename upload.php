
<?php
$target_dir = "uploads/";
$uploadOk = 1;
$fileInfo = [];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Try to upload file if no errors
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";

            // Store file info for later display
            $fileInfo = [
                'name' => basename($_FILES["fileToUpload"]["name"]),
                'size' => $_FILES["fileToUpload"]["size"],
                'type' => $_FILES["fileToUpload"]["type"]
            ];
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>

<?php
if ($uploadOk == 1 && !empty($fileInfo)) {
    print_r($fileInfo);
    
}
?>

</body>
</html>
