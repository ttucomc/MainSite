<?php
require_once('config.php');
require_once('rsvp.class.php');

$rsvp = new Rsvp;

if(isset($_POST['action']) && !empty($_POST['action'])) {
  $action = $_POST['action'];
  switch ($action) {
    case 'add_rsvp':

      // Encoding function response to output in toaster via ajax
      $response = json_encode($rsvp->add_rsvp($_POST['attending'], $_POST['eventID'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['info']));

      // Removing quotes around the string for correct output in toaster
      echo str_replace("\"", "", $response);

      break;

    case 'edit_rsvp':

      // Encoding function response to output in toaster via ajax
      $response = json_encode($rsvp->edit_rsvp($_POST['rsvpID'], $_POST['eventID'], $_POST['attending'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['info']));

      // Removing quotes around the string for correct output in toaster
      echo str_replace("\"", "", $response);

      break;

    case 'check_rsvp':

      $response = $rsvp->check_for_rsvp($_POST['eventID'], $_POST['email']);

      // Setting appropriate response
      if ($response) {
        $response = "This RSVP already exists!";
      } else {
        $response = "This RSVP does not exist!";
      }

      // Encoding for javascript
      $response = json_encode($response);
      // Echoing and removing quotes to display in toaster
      echo str_replace("\"", "", $response);

      break;

    case 'delete_rsvp':

      $response = json_encode($rsvp->delete_rsvp($_POST['eventID'], $_POST['rsvpID']));

      // Removing quotes around the string for correct output in toaster
      echo str_replace("\"", "", $response);
      break;

    default:
      echo "This action doesn't exist!";
      break;
  }
}
