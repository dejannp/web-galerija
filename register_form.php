<?php
@include 'config.php';

$errors = array(); // Definišemo prazan niz za čuvanje grešaka

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Proveravamo da li već postoji korisnik sa istim imenom ili e-poštom
   $select = "SELECT * FROM user_form WHERE name = '$name' OR email = '$email'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)) {
         if($row['name'] == $name){
            $errors[] = 'To korisničko ime već postoji!';
         }
         if($row['email'] == $email){
            $errors[] = 'Taj Email je već registrovan!';
         }
      }
   } else {
      if($pass != $cpass){
         $errors[] = 'Unesena i potvrđena lozinka se ne poklapaju!';
      } else {
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         echo '<script>alert("Registracija uspješna!"); window.location.href = "login_form.php";</script>'; // Dodajemo alert za uspešnu registraciju i redirekciju
         exit(); // Prekidamo izvršavanje koda nakon što smo izvršili redirekciju
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Registrujte se</h3>
      <?php
      if(!empty($errors)){ // Proveravamo da li ima grešaka
         echo '<script>';
         foreach($errors as $error){
            echo 'alert("' . $error . '");'; // Prikazujemo alert za svaku grešku
         }
         echo '</script>';
      }
      ?>
      <input type="text" name="name" required placeholder="Unesite ime">
      <input type="email" name="email" required placeholder="Unesite E-mail">
      <input type="password" name="password" required placeholder="Unesite lozinku">
      <input type="password" name="cpassword" required placeholder="Potvrdite lozinku">
      <select name="user_type">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="Registruj me" class="form-btn">
      <p>Već imate nalog? <a href="login_form.php">Prijavite se</a></p>
   </form>
</div>

</body>
</html>
