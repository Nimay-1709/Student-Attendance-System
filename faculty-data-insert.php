<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['insertbutton'])){
  $form_error = array();

  $required_field = array('username', 'password', 'email');

  $form_error = array_merge($form_error, check_empty_field($required_field));

  $field_to_check_min_length = array('username' => 4, 'password' => 6);

  $form_error = array_merge($form_error, check_min_length($field_to_check_min_length));

  $form_error = array_merge($form_error, check_email($_POST));


  if(empty($form_error)){

      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $subject = $_POST['subject'];

    try {
      $SQLInsert = "INSERT INTO faculty (username, password, subject, email)
                   VALUES (:username, :password, :subject, :email)";
      $statement = $db->prepare($SQLInsert);
      $statement->execute(array(':username' => $username, ':password' => $password, ':subject' => $subject, ':email' => $email));

      if($statement->rowCount() == 1){
        $result = header("location: faculty-data.php");
      }
    }
    catch (PDOException $e) {
      $result = "<p style='color:red; text-align:center;'>An error occured: ".$e->getMessage()."</p>";
    }
  }
  else{
    if(count($form_error) == 1){
      $result = "<p style='color:red; text-align:center;'>There is 1 error found in the form<br>";
    }
    else{
      $result = "<p style='color:red; text-align:center;'>There were " .count($form_error)." errors in the registration form <br>";
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
    <title>Faculty Data Insert</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body>

  <header>
    <div class="container">
      <div id="heading">
        <h2>Government Polytechnic</h2>
      </div>
      <nav>
        <ul>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <?php if(!isset($_SESSION['username'])): header("location: logout.php");?>

  <?php else: ?>

  <section id="login">
   <div id="container">
     <div class="back-image">
      <h3>Insert Faculty Data</h3>
       <form name="form" method="post" onsubmit="return InsertUpdateValidate()">
        <div id="username_div">
          <input type="text" name="username" placeholder="User Name">
          <div id="name_error"></div>
        </div>
        <div id="password_div">
          <input type="password" name="password" placeholder="Password">
          <div id="password_error"></div>
        </div>
        <input type="text" name="subject" placeholder="Enter Subject">
        <div id="email_div">
          <input type="email" name="email" placeholder="Email">
          <div id="email_error"></div>
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
          <input type="submit" name="insertbutton" class="button" value="Insert Data">
        </div>
        </form>
       </div>
     </div>
     <?php endif ?>
    </section>

    <footer id="footer">
      <div class="container">
        <p>Government Polytechnic Ahmedabad</p>
      </div>
    </footer>
  </body>
</html>

<script src="js/insert-update-validation.js"></script>
