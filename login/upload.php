<?php

@include 'connect.php';
session_start();

if (isset($_POST["submit"])) {
    $targetDir = "uploads/"; // Create a folder named 'uploads' to store the files
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
        echo "Only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "File was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

            $filename = basename($_FILES["fileToUpload"]["name"]);
            $filepath = $targetFile;
            $sql = "INSERT INTO files (filename, filepath) VALUES ('$filename', '$filepath')";
            mysqli_query($con, $sql);
        } else {
            echo "Error uploading the file.";
        }
    }
}

$sql = "SELECT * FROM files";
$result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="' . $row["filepath"] . '">' . $row["filename"] . '</a><br>';
        }
    } else {
        echo "No files found.";
    }

    mysqli_close($con);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload form</title>
    <link rel="stylesheet" href="style_sec.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="content">
                <h3>upload now</h3>

                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" name="submit" value="upload now" class="form-btn">
            </div>
        </form>
    </div>
        </body>

</html>


