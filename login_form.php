<?php

@include 'config.php';

session_start();

$error = [];

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
  
   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:testadmin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Prijavite se</h3>
      <?php
      if(!empty($error)){
         echo '<script>';
         foreach($error as $err){
            echo 'window.alert("'.$err.'");';
         }
         echo '</script>';
      }
      ?>
      <input type="email" name="email" required placeholder="Unesite Email">
      <input type="password" name="password" required placeholder="Unesite lozinku">
      <input type="submit" name="submit" value="Prijavi me" class="form-btn">
      <p>Nemate nalog? <a href="register_form.php">Registrujte se</a></p>
   </form>

</div>

</body>
</html>
