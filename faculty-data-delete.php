<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['deletebutton'])){

  if(empty($form_error)){

      $email = $_POST['email'];
      $username = $_POST['username'];

    try {
      $SQLInsert = "DELETE FROM faculty WHERE username = '".$username."'";
      $statement = $db->prepare($SQLInsert);
      $statement->execute();

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
    <title>Faculty Data Delete</title>
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
      <h3>Delete Faculty Data</h3>
       <form name="form" method="post" onsubmit="return DeleteValidate()">
        <div id="username_div">
          <input type="text" name="username" placeholder="Enter User Name">
          <div id="name_error"></div>
        </div>
        <div id="email_div">
          <input type="email" name="email" placeholder="Enter Email">
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
          <input type="submit" name="deletebutton" class="button" value="Delete Data">
        </div>
        </form>
       </div>
     </div>
     <?php endif ?>
    </section>

    <footer id="footer" class="static-footer">
      <div class="container">
        <p>Government Polytechnic Ahmedabad</p>
      </div>
    </footer>
  </body>
</html>

<script src="js/delete-validation.js"></script>
