<?php

/**
 * Gets all the events in the db
 * @return array
 */
function get_all_events() {
  try {

    require(ROOT_PATH . "inc/db.php");

    $stmt = $db->prepare('SELECT * FROM events');
    $stmt->execute();

  } catch (Exception $e) {
    echo "Could not retrieve data from database\r\n";
  }

  $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $events;
}

/**
 * Gets all the invitee's information for a specific event
 * @param  int $q event ID
 * @return array
 */
function get_invitees($q) {

  require(ROOT_PATH . "inc/db.php");

  try {

    $results = $db->prepare('SELECT ID, date, attending, first_name, last_name, email, info FROM people WHERE event_id = ? ORDER BY last_name');
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
    }
  }

  foreach ($guests as $guest) {
    $totalAttending += 1;
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
