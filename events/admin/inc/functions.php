<?php

function get_invitees($q) {

  require(ROOT_PATH . "inc/db.php");

  try {

    $results = $db->prepare('SELECT ID, date, first_name, last_name, email, info FROM people WHERE event_id = ?');
    $results->bindParam(1,$q);
    $results->execute();

  } catch (Exception $e) {
    echo "Data could not be retrieved from the database." . $e->getMessage();
    exit;
  }

  $invitees = $results->fetchAll(PDO::FETCH_ASSOC);


  return $invitees;

}

function get_guests($q) {
  require (ROOT_PATH . 'inc/db.php');

  try {

    $results = $db->prepare('SELECT people.ID AS host_id, guests.ID, guests.date, guests.first_name, guests.last_name, guests.email, guests.info FROM people RIGHT OUTER JOIN guests ON people.ID = guests.host_id WHERE people.event_id = ?');
    $results->bindParam(1,$q);
    $results->execute();

  } catch (Exception $e) {
    echo "Data could not be retrieved from the database." . $e->getMessage();
    exit;
  }

  $guests = $results->fetchAll(PDO::FETCH_ASSOC);

  return $guests;
}

?>