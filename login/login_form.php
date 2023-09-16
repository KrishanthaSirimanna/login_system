<?php
@include 'conect.php';

session_start();

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $cnum=md5($_POST['contact_number']);
    
   $select = "SELECT * FROM user_form WHERE email = '$email' && password ='$pass'";
   
   $res = mysqli_query($con, $select);

   if(mysqli_num_rows($res) > 0)
   {
       $row = mysqli_fetch_array($res);

       if($row['user_type'] == 'writter')
       {
           $_SESSION['writter_name'] = $row['name'];
           header('location:admin_page.php');
           
       }
       else if($row['user_type'] == 'publisher')
       {
           $_SESSION['publisher_name'] = $row['name'];
           header('location:user_page.php');
           
       }
   }
   else
   {
       $error[] = 'Incorrect email or password';
   }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="form-container">
    <form action="" method="post">
    <h3>login now</h3>
    <?php
    if(isset($error))
    {
        foreach($error as $error)
        {
            echo '<span class="error-msg">'.$error. '</span>';
        };
    };
    ?>
    
    <input type="email" name="email" required placeholder="enter your email">
    
    <input type="password" name="password" required placeholder="enter your password">
    <input type="submit" name="submit" value="login now" class="form-btn">
    <p>don't have an account? <a href="register_form.php">register now</a> </p>
    </form>
 </div>
</body>
</html>
