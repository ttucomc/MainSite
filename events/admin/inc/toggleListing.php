<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

$event = (int)$_POST['listingUpdated'];

try {

  $stmt = $db->prepare('
                        SELECT listed FROM events
                        WHERE ID=:event
                      ');
  $stmt->bindParam(':event', $event, PDO::PARAM_INT);
  $stmt->execute();

  $listedArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // Pulling the actual value out of the array
  $listed = (int)$listedArray[0]['listed'];

  // Testing if it's listed or not then setting it as the opposite
  if ($listed == 0) {
    $listed = 1;
  } else {
    $listed = 0;
  }

  $stmt = $db->prepare('
                        UPDATE events
                        SET listed=:listed
                        WHERE ID=:event
                      ');
  $stmt->bindParam(':listed', $listed, PDO::PARAM_INT);
  $stmt->bindParam(':event', $event, PDO::PARAM_INT);
  $stmt->execute();

  $submitData['success'] = true;
  $submitData['message'] = "Success! This event's listing status was changed!";
  $submitData['listed'] = $listed;

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! Could not change the listing status!";
}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
