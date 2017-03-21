<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

// Variables from submitted form
$name = $_POST['add-event-name'];
$description = $_POST['add-event-description'];
$location = $_POST['add-event-location'];
$address = $_POST['add-event-address'];
$date = $_POST['add-event-date'];
$time = $_POST['add-event-time'];
$endTime = $_POST['add-event-end-time'];
$allowsRsvps = (int)$_POST['add-rsvp-switch'];
$password = $_POST['add-event-password'];
$deadline = $_POST['add-event-rsvp-deadline'];
$allowsGuests = (int)$_POST['add-guests-switch'];

// Creating datetime to submit to db
$date = date('Y-m-d', strtotime($date));
$time = date('H:i:s', strtotime($time));
$datetime = $date . ' ' . $time;

// If there is an end time, converting it to submit to db
if(!empty($endTime)) {
  $endTime = date('H:i:s', strtotime($endTime));
} else {
  $endTime = null;
}

// If there is an RSVP deadline, setting it to that date. Defaulting to date and time of event
if(!empty($deadline)) {
  $deadline = date('Y-m-d', strtotime($deadline)) . ' 23:59:59';
} else {
  $deadline = $datetime;
}

// Setting these variables to 0 if they are null
if ($allowsRsvps !== 1) {
    $allowsRsvps = 0;
}
if ($allowsGuests !== 1) {
    $allowsGuests = 0;
}

// Submitting to database
try {

    $stmt = $db->prepare('
                          INSERT INTO events (name, datetime, end_time, location, address, description, listed, password, rsvps, rsvp_date, allow_guests)
                          VALUES (:name, :datetime, :endtime, :location, :address, :description, 1, :password, :rsvps, :deadline, :guests)
                        ');
    $stmt->bindParam(':name', trim($name), PDO::PARAM_STR);
    $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
    $stmt->bindParam(':endtime', $endTime);
    $stmt->bindParam(':location', trim($location), PDO::PARAM_STR);
    $stmt->bindParam(':address', trim($address), PDO::PARAM_STR);
    $stmt->bindParam(':description', htmlspecialchars(trim($description)), PDO::PARAM_STR);
    $stmt->bindParam(':password', trim($password), PDO::PARAM_STR);
    $stmt->bindParam(':rsvps', $allowsRsvps, PDO::PARAM_INT);
    $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);
    $stmt->bindParam(':guests', $allowsGuests, PDO::PARAM_INT);
    $stmt->execute();

    $submitData['success'] = true;
    $submitData['message'] = "Success! The event was added!";

} catch (Exception $e) {

    $submitData['success'] = false;
    $submitData['message'] = "Bummer! The event could not be added!";

}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
