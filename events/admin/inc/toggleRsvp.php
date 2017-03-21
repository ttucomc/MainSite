<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

$event = (int)$_POST['rsvpToggled'];

try {

  $stmt = $db->prepare('
                        SELECT * FROM events
                        WHERE ID=:event
                       ');
  $stmt->bindParam(':event', $event, PDO::PARAM_INT);
  $stmt->execute();

  $events = $stmt->fetch(PDO::FETCH_ASSOC);
  $eventRsvps = (int)$events['rsvps'];

  if($eventRsvps == 0) {
    $eventRsvps = 1;
  } else {
    $eventRsvps = 0;
  }

  $stmt = $db->prepare('
                        UPDATE events
                        SET rsvps=:rsvps
                        WHERE ID=:event
                      ');
  $stmt->bindParam(':rsvps', $eventRsvps, PDO::PARAM_INT);
  $stmt->bindParam(':event', $event, PDO::PARAM_INT);
  $stmt->execute();

  $submitData['success'] = true;
  $submitData['message'] = "Success! This event's RSVP option was changed!";
  $submitData['rsvps'] = $eventRsvps;
  $submitData['password'] = $events['password'];
  $submitData['guests'] = $events['allow_guests'];
  $submitData['date'] = date( 'D M d Y H:i:s O', strtotime($events['rsvp_date']) );

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! Could not change the RSVP option.";
}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
