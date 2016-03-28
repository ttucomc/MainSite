<?php
require_once('../inc/config.php');
require_once('../inc/functions.php');

// IF id is set in the url, use it
if (isset($_GET["id"])) {
	$event_id = intval($_GET["id"]);
  $invitees =  get_invitees($event_id);
  $guests = get_guests($event_id);
}

?>

<ol>
  <?php

    foreach ($invitees as $key => $invitee) {
      echo '<li>' . $invitee['first_name'] . ' ' . $invitee['last_name'];

      // Variable to determine if invitee has any guests
      $hasGuests = false;

      // Checking if any of the guests host_id match this invitee's ID
      foreach ($guests as $key => $guest) {
        // If it does, set the hasGuests variable to true
        if ($guest[host_id] == $invitee[ID]) {
          $hasGuests = true;
        }
      }

      // If the invitee has guests, list the guests under their name
      if ($hasGuests) {
        echo "<ol>";
        // Loop through guests array looking at each host_id
        foreach ($guests as $key => $guest) {
          // If that host id = the current invitee ID, list them
          if ($guest[host_id] == $invitee[ID]) {
            echo "<li>" . $guest['first_name'] . " " . $guest['last_name'] . " - \"<em>" . $guest['info'] . "</em>\"</li>";
          }
        }

        echo "</ol>";
      }

      echo '</li>';
    }

  ?>
</ol>
