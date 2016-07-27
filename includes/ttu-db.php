<?php

try {
  $db = new PDO( "sqlsrv:server=" . DB_HOST . "; Database=" . DB_NAME . "", DB_USER, DB_PASS);
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo "Could not connect to the database.";
  exit;
}

?>
