<?php

/*

Texas Tech University
College Of Media and Communications
5/19/16

*/

try {

  $db = new PDO('mysql:host=host435.hostmonster.com;dbname=ttunewsc_grad_jobs', 'ttunewsc_gradjob', '4iHVdw.4XCu[');

} catch(Exception $e) {
  echo "Unable to connet to database";
  echo $e->getMessage();
  die();
}

?>
