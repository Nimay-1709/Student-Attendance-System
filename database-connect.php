 <?php

$username = 'root';
$password = 'Aa225274';
$dsn = 'mysql:host=localhost; dbname=iot';

try {

  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

  echo "Fail to connect to the database ".$e->getMessage();

}

?>
