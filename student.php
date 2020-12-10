<?php

include_once 'data-source/database-connect.php';
include_once 'data-source/validations.php';

if(isset($_POST['button'])){
  $form_error = array();

  $required_field = array('enroll');

  $form_error = array_merge($form_error, check_empty_field($required_field));

if(empty($form_error)){

  $enroll = $_POST['enroll'];

  $SQLQuery = "SELECT * FROM student WHERE enroll = :enroll";
  $statement = $db->prepare($SQLQuery);
  $statement->execute(array(':enroll' => $enroll));

  while($row = $statement->fetch()){
    $id = $row['id'];
    $enroll = $row['enroll'];
    $_SESSION['enroll'] = $enroll;
    header("location: attendance-page.php");
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
    <title>Student</title>
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
       <h3>Student</h3><br>
       <form method="post" onsubmit="return checkform(this);" action="attendance-page.php">
         <input type="text" name="enroll" placeholder="Enter your Enrollment No" required><br>
         <br>
         <div class="capbox">
           Capcha Code:
            <div id="CaptchaDiv"></div><br>
              <div class="capbox-inner">
                 Type the above capcha code<br>
                 <input type="hidden" id="txtCaptcha">
                 <input type="text" name="CaptchaInput" id="CaptchaInput" size="15" placeholder="Capcha Code"><br>
              </div>
            <script src="js/captcha.js"></script>
         </div>
         <button type="submit" name="button" class="button">Get Attendance</button>
       </form>

      </div>
     </div>
    </section>

    <footer id="footer">
      <div class="container">
        <p>Government Polytechnic Ahmedabad</p>
      </div>
    </footer>

  </body>
</html>
