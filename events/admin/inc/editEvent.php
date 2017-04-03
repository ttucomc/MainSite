<?php
require_once('config.php');
require(ROOT_PATH . "inc/db.php");
// Variable to send back to AJAX form
$submitData = [];

// Setting variables
$eventID = $_POST['eventID'];
$name = $_POST['edit-event-name'];
$description = $_POST['edit-event-description'];
$location = $_POST['edit-event-location'];
$address = $_POST['edit-event-address'];
$date = $_POST['edit-event-date'];
$time = $_POST['edit-event-time'];
$endTime = $_POST['edit-event-end-time'];
$password = $_POST['edit-event-password'];
$deadline = $_POST['edit-event-rsvp-deadline'];
$guests = $_POST['edit-guests-switch'];

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
if($guests === "yes") {
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
  $submitData['message'] = "Success! The details for $name were updated!";
  $submitData['name'] = $name;
  $submitData['description'] = $description;
  $submitData['location'] = $location;
  $submitData['address'] = $address;
  $submitData['date'] = $date;
  $submitData['time'] = $time;
  $submitData['endTime'] = $endTime;
  $submitData['password'] = $password;
  $submitData['deadline'] = $deadline;
  if($guests === 1) {
      $guests = 'Yes';
  } else {
      $guests = 'No';
  }
  $submitData['guests'] = $guests;

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! $name could not be updated.";
}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
