<?php

include_once "data-source/database-connect.php";

if(isset($_POST['button'])){

    $enroll = $_POST['enroll'];

    $SQLQuery = "SELECT * FROM attendance WHERE enroll = :enroll";
    $statement = $db->prepare($SQLQuery);
    $statement->execute(array(':enroll' => $enroll));

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
    <title>Attendance Page</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
  </head>
  <body>

   <header>
     <div class="container">
       <h2>Government Polytechnic</h2>
     </div>
   </header>

   <section id="mid-section">
    <div id="container">
     <div class="back-image">
      <table border="1">
       <h2>Student Attendance</h2>
       <h4><?php echo "Enrollment No. : " . $enroll ?></h4>
       <thead>
       <tr>
           <th scope="col">Subject</th>
           <th scope="col">Attendance</th>
           <th scope="col">Date</th>
       </tr>
       </thead>
       <tbody>
       <?php while( $row = $statement->fetch()) : ?>
       <tr>
           <td scope="row" data-label="Subject"><?php echo $row['subject']; ?></td>
           <td data-label="Attendance"><?php echo $row['attendance']; ?></td>
           <td data-label="Date"><?php echo $row['ddate']; ?></td>
       </tr>
       <?php endwhile ?>
       </tbody>
      </table>
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
