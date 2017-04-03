<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

$eventID = (int)$_POST['eventDeleted'];

try {

  $stmt = $db->prepare('
                        DELETE FROM events
                        WHERE ID=:event;
                        DELETE FROM people
                        WHERE event_id=:people;
                        DELETE FROM guests
                        WHERE event_id=:guests;
                      ');
  $stmt->bindParam(':event', $eventID, PDO::PARAM_INT);
  $stmt->bindParam(':people', $eventID, PDO::PARAM_INT);
  $stmt->bindParam(':guests', $eventID, PDO::PARAM_INT);
  $stmt->execute();

  $submitData['success'] = true;
  $submitData['message'] = "Success! The event was deleted!";

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! The event could not be deleted!";
}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
