<?php

@include 'conect.php';
 
if(isset($_POST['submit']))
{
   $name = mysqli_real_escape_string($con,$_POST['name']);
   $email = mysqli_real_escape_string($con,$_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $cnum = mysqli_real_escape_string($con,$_POST['contact']);
   

   $select ="SELECT * FROM user_form WHERE email = '$email' && password ='$pass'";

   $res=mysqli_query($con, $select);

   if(mysqli_num_rows($res) > 0)
   {
    $error[] = 'user alredy exist!';
    
   }else
   {

     if($pass != $cpass){
           $error[] = 'password not matched!';
       }else
        {
         $insert = " INSERT INTO user_form (name, email, password, user_type, contact_number) VALUES ('$name','$email', '$pass', '$user_type', '$cnum')" ;
         mysqli_query($con, $insert);
         header('location:login_form.php');
        }
   
   }
   
};
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
  <form action="" method="post">
  <div class="content">
    <h3>Register now</h3>
    <?php
    if(isset($error))
    {
        foreach($error as $error)
        {
            echo '<span class="error-msg">'.$error. '</span>';
        };
    };
    ?>
    <input type="text" name="name" required placeholder="enter your name">
    <input type="email" name="email" required placeholder="enter your email">
    <input type="password" name="password" required placeholder="enter your password">
    <input type="password" name="cpassword" required placeholder="confirm your password">
    <input type="contact" name="contact" required placeholder="enter your contact number">
    <select name="user_type">
       <option value="publisher">publisher</option>
       <option value="writter">writter</option>

    </select>
    <input type="submit" name="submit" value="register now" class="form-btn">
    <p>already have an account? <a href="login_form.php">login now</a> </p>
 </form>

    </div>
    
</body>
</html>