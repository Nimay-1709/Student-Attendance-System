<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

  if(isset($_POST['logbutton'])){
    $form_error = array();

    $required_field = array('username', 'password');

    $form_error = array_merge($form_error, check_empty_field($required_field));

  if(empty($form_error)){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $SQLQuery = "SELECT * FROM admin WHERE username = :username";
    $statement = $db->prepare($SQLQuery);
    $statement->execute(array(':username' => $user));

    while($row = $statement->fetch()){
      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];

      if(password_verify($pass, $hashed_password)){
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header("location: admin-page.php");
      }
      else{
        $result = "<p style='color:red; text-align:center;'>Invalid username or password</p>";
      }
    }
  }
  else{
    if(count($form_error) == 1){
      $result = "<p style='color:red; text-align:center;'>There was 1 error in the form</p>";
    }
    else{
      $result = "<p style='color:red; text-align:center;'>There were " .count($form_error). " error in the form</p>";
    }
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="IOT Attendence System">
    <meta name="keywords" content="IOT, Raspberry Pi, Attendence">
    <meta name="author" content="Aakash, Nimay, Mit, Surat">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body>

    <header>
      <div class="container">
        <h2>Government Polytechnic</h2>
      </div>
    </header>

    <section id="login">
     <div id="container">
      <div class="back-image">
       <h3>Admin Login</h3><br>
        <form name="form" method="post" onsubmit="return LoginValidate()">
         <div id="username_div">
          <input type="text" name="username" placeholder="User Name" class="user">
          <div id="name_error"></div>
   	     </div>
         <div id="password_div">
          <input type="password" name="password" placeholder="Password" class="pass">
          <div id="password_error"></div>
         </div>
         <?php
           if(isset($result)){
             echo $result;
           }
         ?>

         <?php
           if(!empty($form_error))
             echo show_error($form_error);
         ?>
          <p class="pass-reset"><a href="admin-password-reset.php">Forgot Password?</a></p>
          <div>
            <input type="submit" name="logbutton" class="button" value="Login">
          </div>
        </form>
      </div>
     </div>
    </section>

    <footer id="footer" class="static-footer">
      <div class="container">
        <p>Government Polytechnic Ahmedabad</p>
      </div>
    </footer>
  </body>
</html>

<script src="js/login-validation.js"></script>
