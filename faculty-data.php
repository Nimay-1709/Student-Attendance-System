<?php

include_once 'data-source/user-session.php';
include_once 'data-source/database-connect.php';

  $SQLQuery = "SELECT * FROM faculty";
  $statement = $db->prepare($SQLQuery);
  $statement->execute();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="IOT Attendence System">
    <meta name="keywords" content="IOT, Raspberry Pi, Attendence">
    <meta name="author" content="Aakash, Nimay, Mit, Surat">
    <title>Faculty Data</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
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

   <section id="mid-section">
    <div id="container">
     <div class="back-image">
      <table border="1">
        <h2>Faculty Data</h2>
        <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Username</th>
              <th scope="col">Subject</th>
              <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
          <?php while( $row = $statement->fetch()) : ?>
          <tr>
              <td scope="row" data-label="ID"><?php echo $row['id']; ?></td>
              <td data-label="Username"><?php echo $row['username']; ?></td>
              <td data-label="Subject"><?php echo $row['subject']; ?></td>
              <td data-label="Email"><?php echo $row['email']; ?></td>
          </tr>
          <?php endwhile ?>
        </tbody>
        </table>
        <table class="btn-tab">
        <tr>
          <td scope="row"><a href="faculty-data-delete.php" name="button" class="table-btn">Delete</a></td>
          <td scope="row"><a href="faculty-data-insert.php" name="button" class="table-btn">Insert</a></td>
          <td scope="row"><a href="faculty-data-update.php" name="button" class="table-btn">Update</a></td>
        </tr>
      </table>
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
