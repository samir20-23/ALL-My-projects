
<?php
// Check if form is submitted
if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        $uploadOk = 0;
        $error_message = "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        $error_message = "Sorry, file already exists.";
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadOk = 0;
        $error_message = "Sorry, your file is too large.";
    }

    // Allow certain file formats
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowed_extensions)) {
        $uploadOk = 0;
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error_message = $error_message ?? "Sorry, your file was not uploaded.";
        echo "<p>$error_message</p>";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p>The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.</p>";
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        <button type="submit" name="submit">Upload Image</button>
    </form>
</body>
</html>
