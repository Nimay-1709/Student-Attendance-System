<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['insertbutton'])){

  if(empty($form_error)){

      $enroll = $_POST['enroll'];
      $subject = $_POST['subject'];
      $attendance = $_POST['attendance'];

    try {
      $SQLInsert = "INSERT INTO attendance (enroll, subject, attendance, ddate)
                   VALUES (:enroll, :subject, :attendance, :ddate)";
      $statement = $db->prepare($SQLInsert);
      $statement->execute(array(':enroll' => $enroll, ':subject' => $subject, ':attendance' => $attendance, ':ddate' => date("Y-m-d H:i:s")));

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
    <title>Student Data Insert</title>
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
      <h3>Insert Student Data</h3>
      <form name="form" method="post">
         <input type="number" name="enroll" placeholder="Enter Enrollment No." required>
         <input type="text" name="subject" placeholder="Enter Subject" required>
         <input type="text" name="attendance" placeholder="Enter Attendance" required>
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

    <footer id="footer" class="static-footer">
      <div class="container">
        <p>Government Polytechnic Ahmedabad</p>
      </div>
    </footer>
  </body>
</html>
