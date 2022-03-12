<?php
$username = 'root' ;
$dsn = 'mysql:host=localhost; dbname=register; charset=utf8';
$password = '' ;
try {
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo"connected to the register database" ;

} catch (PDOException $ex) {
  echo "connection failed".$ex->getMessage();
}


?>