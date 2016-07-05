<?php
require_once('config.php');
require_once('functions.php');

// If there was an event added, submit the SQL to the database
if(isset($_POST['form-name']) && $_POST['form-name'] == 'add-event') {
    add_event($_POST['add-event-name'], $_POST['add-event-location'], $_POST['add-event-address'], $_POST['add-event-date'], $_POST['add-event-time'], $_POST['add-event-password'], $_POST['add-rsvp-switch']);
    header('Location: ' . BASE_URL);
}

// If there was an event edited
if(isset($_POST['eventUpdated'])) {
    edit_event($_POST['eventUpdated'],$_POST['eventName'], $_POST['eventLocation'], $_POST['eventAddress'], $_POST['eventDate'], $_POST['eventTime'], $_POST['eventPassword']);
}

// If the rsvp of an event was toggled
if(isset($_GET["rsvpsToggled"])) {
  $listingUpdated = toggle_event_rsvp($_GET["rsvpsToggled"]);
}

// If the listing of an event was toggled
if(isset($_GET["listingUpdated"])) {
  $listingUpdated = toggle_event_listing($_GET["listingUpdated"]);
}

// If there was an event deleted
if(isset($_GET["eventDeleted"])) {
  $eventDeleted = delete_event($_GET["eventDeleted"]);
}
