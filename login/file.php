<?php
@include 'conect.php';
//$conn = mysqli_connect(localhost,root,'','db')


if(isset($_POST['submit']))
{
$title = $_POST['title'];

$pname = rand(1000,10000)."_".$_FILES["file"]["name"];

$tnamme = $_FILE["files"]["tmp_name"];

$uploads_dir = '/docs';

move_uploaded_file($tname, $uploads_dir.'/'.$pname);

$sql = "INSERT INTO fileup (title, docs) VALUES('$title', '$pname')";

if(mysqli_query($conn, $sql))
{
echo "file sucessfully uploaded";
}
else
{
echo "upload failed";
}


}

?>


<html>
<head>
<Title>File uppload</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<div class="form-container">

<form mthod="post" enctype="multipart/form-data">
<div class="cantent">
<h3>Upload your file</h3>



<input type="file" name="file">
<input type="submit" name="submit" value="upload now" class="form-btn">
<input type="submit" name="close" value="close" class="form-btn">
</form>
</body>



</html>
