<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['deletebutton'])){

  if(empty($form_error)){

      $id = $_POST['id'];
      $enroll = $_POST['enroll'];

    try {

      $SQLInsert = "DELETE FROM attendance WHERE id = '".$id."'";
      $statement = $db->prepare($SQLInsert);
      $statement->execute();

      if($statement->rowCount() == 1){
        $result = header("location: fac-student-data.php");
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
    <title>Student Data Delete</title>
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
      <h3>Delete Student Data</h3>
      <form name="form" method="post">
         <input type="number" name="id" placeholder="Enter ID" required>
         <input type="number" name="enroll" placeholder="Enter Enrollment No." required>
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
