<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

// Setting variables
$eventID = $_POST['eventUpdated'];
$name = $_POST['eventName'];
$description = $_POST['eventDescription'];
$location = $_POST['eventLocation'];
$address = $_POST['eventAddress'];
$date = $_POST['eventDate'];
$time = $_POST['eventTime'];
$endTime = $_POST['eventEndTime'];
$password = $_POST['eventPassword'];
$deadline = $_POST['eventDeadline'];
$guests = $_POST['eventGuestAllow']);

// Putting date and time in correct format for MySQL
$date = date('Y-m-d', strtotime($date));
$time = date('H:i:s', strtotime($time));
$datetime = $date . ' ' . $time;

// Testing to see if there is an end time, if there is set it
if(!empty($endTime)) {
  $endTime = date('H:i:s', strtotime($endTime));
} else {
  $endTime = null;
}

// Testing to see if there's a rsvp deadline. If there's not, set it as the event datetime
if(!empty($deadline)) {
  $deadline = date('Y-m-d', strtotime($deadline)) . ' 23:59:59';
} else {
  $deadline = $datetime;
}

// Testing to see if there's guests or not and setting it to work with tinyint in MySQL
if($guests === "true") {
  $guests = 1;
} else {
  $guests = 0;
}

try {

  $stmt = $db->prepare('
                        UPDATE events
                        SET name=:name, datetime=:datetime, end_time=:endtime, location=:location, address=:address, description=:description, password=:password, rsvp_date=:deadline, allow_guests=:guests
                        WHERE ID=:eventID;
                      ');
  $stmt->bindParam(':name', trim($name), PDO::PARAM_STR);
  $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
  $stmt->bindParam(':endtime', $endTime);
  $stmt->bindParam(':location', trim($location), PDO::PARAM_STR);
  $stmt->bindParam(':address', trim($address), PDO::PARAM_STR);
  $stmt->bindParam(':description', htmlspecialchars(trim($description)), PDO::PARAM_STR);
  $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
  $stmt->bindParam(':password', trim($password), PDO::PARAM_STR);
  $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);
  $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
  $stmt->execute();

  $submitData['success'] = true;
  $submitData['message'] = "Success! The event details were updated!";

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! The event could not be updated.";
}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
