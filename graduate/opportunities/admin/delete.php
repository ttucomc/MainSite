<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../db.php');
require('../model/Opportunity.php');


$id = $_POST['id'];

$result = Opportunity::deleteOpportunity($db, $id);

if($result) {
  echo "true";
} else {
  echo "false";
}

?>
