<?php
@include 'conect.php';

session_start();

if(!isset($_SESSION['writter_name']))
{
  header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>writter page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
  
  <div class="container">
    <div class="content">
        <h3>Hi, <span>writter</span></h3>
        <h1>Welcome<span> <?php echo $_SESSION['writter_name'] ?></span></h1>
        <p>This is an writter page</p> 
        <a href="login_form.php" class="btn">login</a>
        <a href="register_form.php" class="btn">register</a>
        <a href="log_out.php" class="btn">logout</a>
        <a href="file.php" class="btn">upload a file</a>
    </div> 
  </div>      
</body>
</html>