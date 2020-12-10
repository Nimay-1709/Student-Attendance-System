<?php

include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['reset_password_button'])){

  $form_error = array();

  $required_field = array('username', 'new_password', 'confirm_password');

  $form_error = array_merge($form_error, check_empty_field($required_field));

  $field_to_check_length = array('username' => 4, 'new_password' => 6, 'confirm_password' => 6);

  $form_error = array_merge($form_error, check_min_length($field_to_check_length));

  if(empty($form_error)){

    $password_1 = $_POST['new_password'];
    $password_2 = $_POST['confirm_password'];
    $username = $_POST['username'];

    if($password_1 != $password_2){
      $result = "<p style='color:red; text-align:center;'>New password and confirm password does not match</p>";
    }
    else{
      try{
        $SQLQuery = "SELECT username FROM admin WHERE username = :username";
        $statement = $db->prepare($SQLQuery);
        $statement->execute(array(':username' => $username));

        if($statement->rowCount() == 1){
          $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);
          $SQLUpdate = "UPDATE admin SET password = :password WHERE username = :username";
          $statement = $db->prepare($SQLUpdate);
          $statement->execute(array(':password' => $hashed_password, ':username' => $username));
          $result =  header("location: admin-login.php");
        }
        else{
          $result = "<p style='color:red; text-align:center;'>The username you provided is not in our database. Please try again</p>";
        }

      }
      catch(PDOException $e){
        $result = "<p style='color:red; text-align:center;'>An error occured: ".$e->getMessage()."</p>";
      }

    }

  }
  else{
    if(count($form_error) == 1){
      $result = "<p style='color:red; text-align:center;'>There is 1 error in the form</p><br>";
    }
    else{
      $result = "<p style='color:red; text-align:center;'>There are ".count($form_error)." errors in the form</p><br>";
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
    <title>Admin Password Reset</title>
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
        <h3>Reset Your Password</h3>
          <form name="form" method="post" onsubmit="return ResetValidate()">
            <div id="username_div">
              <input type="text" name="username" placeholder="User Name">
              <div id="name_error"></div>
            </div>
            <div id="password_div">
              <input type="password" name="new_password" placeholder="Enter New Password">
            </div>
            <div id="pass_confirm_div">
              <input type="password" name="confirm_password" placeholder="Enter Password Again">
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
            <div>
              <input type="submit" name="reset_password_button" class="button" value="Reset Password">
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

<script src="js/reset-validation.js"></script>
