<?php
include_once 'data-source/user-session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="IOT Attendence System">
    <meta name="keywords" content="IOT, Raspberry Pi, Attendence">
    <meta name="author" content="Aakash, Nimay, Mit, Surat">
    <title>Faculty Page</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/admin-faculty-page.css">
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

    <section id="faculty-page">
     <div id="container">

       <?php if(!isset($_SESSION['username'])): header("location: logout.php");?>

       <?php else: ?>

       <div class="back-image">
         <div class="student-btn-2">
           <a href="fac-student-data.php"><img src="images/student-btn.png" alt="student button" class="btn"></a>
         </div>
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
