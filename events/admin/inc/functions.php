<?php

/**
 * Gets all the events in the db
 * @return array
 */
function get_all_events() {
  try {

    require(ROOT_PATH . "inc/db.php");

    $stmt = $db->prepare('SELECT * FROM events ORDER BY datetime');
    $stmt->execute();

  } catch (Exception $e) {
    echo "Could not retrieve data from database\r\n";
  }

  $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $events;
}

/**
 * Gets the details for a specific event
 * @param  int   $event   ID of the event
 * @return array $details All information of the event
 */
function get_one_event($event) {
  try {

    require(ROOT_PATH . "inc/db.php");

    $stmt = $db->prepare('
                          SELECT * FROM events
                          WHERE ID=:event;
                        ');
    $stmt->bindParam(':event', $event, PDO::PARAM_INT);
    $stmt->execute();

    $details = $stmt->fetch(PDO::FETCH_ASSOC);

  } catch (Exception $e) {
    echo "Could not retrieve data from the database.";
  }

  return $details;
}

/**
 * Gets all the invitee's information for a specific event
 * @param  int $q event ID
 * @return array
 */
function get_invitees($q) {

  require(ROOT_PATH . "inc/db.php");

  try {

    $results = $db->prepare('SELECT ID, date, attending, first_name, last_name, email, info, sort1 FROM people WHERE event_id = ? ORDER BY last_name');
    $results->bindParam(1,$q);
    $results->execute();

  } catch (Exception $e) {
    echo "Data could not be retrieved from the database.";
    exit;
  }

  $invitees = $results->fetchAll(PDO::FETCH_ASSOC);


  return $invitees;

}

/**
 * Gets all the guests information for a specific event
 * @param  int $q event ID
 * @return array
 */
function get_guests($q) {
  require (ROOT_PATH . 'inc/db.php');

  try {

    $results = $db->prepare('SELECT people.ID AS host_id, guests.ID, guests.date, guests.first_name, guests.last_name, guests.email, guests.info FROM people RIGHT OUTER JOIN guests ON people.ID = guests.host_id WHERE people.event_id = ?');
    $results->bindParam(1,$q);
    $results->execute();

  } catch (Exception $e) {
    echo "Data could not be retrieved from the database.";
    exit;
  }

  $guests = $results->fetchAll(PDO::FETCH_ASSOC);

  return $guests;
}

function total_rsvps($q) {
  return $totalRSVPs = count($q);
}

/**
 * Determines the amount of people attending an event
 * @param  array $invitees full list of people invited
 * @param  array $guests   full list of guests
 * @return int
 */
function total_attending($invitees, $guests) {

  $totalAttending = 0;

  foreach ($invitees as $invitee) {
    if ($invitee[attending] == 1) {
      $totalAttending += 1;

      $inviteesGuests = invitees_guests($invitee, $guests);
      $totalAttending = $totalAttending + count($inviteesGuests);
    }
  }

  return $totalAttending;
}

/**
 * This function determines if an invitee has guests, then puts them into an array for that invitee.
 * @param  array $invitee current invitee
 * @param  array $guests  full list of guests
 * @return array
 */
function invitees_guests($invitee, $guests) {
  $inviteesGuests = array();

  foreach ($guests as $guest) {
    if ($guest[host_id] == $invitee[ID]) {
      $inviteesGuests[] = $guest;
    }
  }

  return $inviteesGuests;
}




/**
 * Adds an event into the database.
 * @param  str  $name        Name of the event
 * @param  str  $description Description of the event
 * @param  str  $location    Location of the event
 * @param  str  $address     Address of the event
 * @param  str  $date        Date of the event
 * @param  str  $time        Time of the event
 * @param  str  $password    Password to be used in RSVPs
 * @param  str  $rsvps       Yes or no RSVP
 * @param  str  $deadline    Deadline to RSVP
 * @param  str  $guests       Yes or no for allowing guests
 * @return bool $eventAdded  Whether adding the event failed or not
 */
function add_event($name, $description, $location, $address, $date, $time, $password, $rsvps, $deadline, $guests) {
  require(ROOT_PATH . "inc/db.php");

  // Setting date to proper format
  $date = date('Y-m-d', strtotime($date));
  $time = date('H:i:s', strtotime($time));
  $datetime = $date . ' ' . $time;

  // Checking to see if they RSVP'd yes or no
  if($rsvps != 'yes') {
    $rsvps = 0;
  } else {
    $rsvps = 1;
  }

  // Checking if RSVP deadline was set. If not, set it equal to datetime of events
  if (!empty($deadline)) {
    $deadline = date('Y-m-d', strtotime($deadline)) . " 23:59:59";
  } else {
    $deadline = $datetime;
  }

  // Checking to see if guests are allowed
  if($guests != 'yes') {
    $guests = 0;
  } else {
    $guests = 1;
  }

  try {

    $stmt = $db->prepare('
                          INSERT INTO events (name, datetime, location, address, description, password, rsvps, rsvp_date, allow_guests)
                          VALUES (:name, :datetime, :location, :address, :description, :password, :rsvps, :deadline, :guests)
                        ');
    $stmt->bindParam(':name', trim($name), PDO::PARAM_STR);
    $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
    $stmt->bindParam(':location', trim($location), PDO::PARAM_STR);
    $stmt->bindParam(':address', trim($address), PDO::PARAM_STR);
    $stmt->bindParam(':description', htmlspecialchars(trim($description)), PDO::PARAM_STR);
    $stmt->bindParam(':password', trim($password), PDO::PARAM_STR);
    $stmt->bindParam(':rsvps', $rsvps, PDO::PARAM_INT);
    $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->execute();

    $eventAdded = true;

  } catch (Exception $e) {
    echo "Could not add data to the database.";
    $eventAdded = false;
  }

  return $eventAdded;

}

/**
 * Edits the information of an event in the database.
 * @param  int  $eventID     ID of the event
 * @param  str  $name        Name of the event
 * @param  str  $description Description of the event
 * @param  str  $location    Location of the event
 * @param  str  $address     Address of the event
 * @param  str  $date        Date of the event
 * @param  str  $time        Time of the event
 * @param  str  $password    Password to be used in RSVPs
 * @param  str  $deadline    Deadline to RSVP
 * @param  bool $guests      Whether the event allows guests or not
 * @return bool $eventEdited Whether the event edit failed or not
 */
function edit_event($eventID, $name, $description, $location, $address, $date, $time, $password, $deadline, $guests) {
  require(ROOT_PATH . "inc/db.php");

  $date = date('Y-m-d', strtotime($date));
  $time = date('H:i:s', strtotime($time));
  $datetime = $date . ' ' . $time;

  if(!empty($deadline)) {
    $deadline = date('Y-m-d', strtotime($deadline)) . ' 23:59:59';
  } else {
    $deadline = $datetime;
  }

  if($guests === "true") {
    $guests = 1;
  } else {
    $guests = 0;
  }

  try {

    $stmt = $db->prepare('
                          UPDATE events
                          SET name=:name, datetime=:datetime, location=:location, address=:address, description=:description, password=:password, rsvp_date=:deadline, allow_guests=:guests
                          WHERE ID=:eventID;
                        ');
    $stmt->bindParam(':name', trim($name), PDO::PARAM_STR);
    $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
    $stmt->bindParam(':location', trim($location), PDO::PARAM_STR);
    $stmt->bindParam(':address', trim($address), PDO::PARAM_STR);
    $stmt->bindParam(':description', htmlspecialchars(trim($description)), PDO::PARAM_STR);
    $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
    $stmt->bindParam(':password', trim($password), PDO::PARAM_STR);
    $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->execute();

    $eventEdited = true;

  } catch (Exception $e) {
    echo 'Couldn\'t edit the event in the database.';
    $eventEdited = false;
  }

  return $eventEdited;

}

/**
 * Toggles RSVPs on or off
 * @param  int  $event   The event ID
 * @return bool $toggled If the update succeeded or failed
 */
function toggle_event_rsvp($event){
  require(ROOT_PATH . "inc/db.php");

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

    $toggled = true;

  } catch (Exception $e) {
    echo "Couldn't toggle RSVPs on or off";
    $toggled = false;
  }

  echo json_encode($events);
  return $toggled;

}

/**
 * Toggles listing status
 * @param  int  $event   The event ID
 * @return bool $toggled If the update succeeded or failed
 */
function toggle_event_listing($event) {
  require(ROOT_PATH . "inc/db.php");

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

    $toggled = false;

  } catch (Exception $e) {
    echo "Couldn't toggle listing status ";

    $toggled = false;
  }

  return $toggled;

}

/**
 * Deletes event from database
 * @param  int  $event   The event ID
 * @return bool $deleted If the delete succeeded or failed
 */
function delete_event($event) {
  require(ROOT_PATH . "inc/db.php");

  try {

    $stmt = $db->prepare('
                          DELETE FROM events
                          WHERE ID=:event;
                          DELETE FROM people
                          WHERE event_id=:people;
                          DELETE FROM guests
                          WHERE event_id=:guests;
                        ');
    $stmt->bindParam(':event', $event, PDO::PARAM_INT);
    $stmt->bindParam(':people', $event, PDO::PARAM_INT);
    $stmt->bindParam(':guests', $event, PDO::PARAM_INT);
    $stmt->execute();

    $deleted = true;

  } catch (Exception $e) {
    echo "Could not delete the event from the database. ";
    $deleted = false;
  }

  return $deleted;
}
