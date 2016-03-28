<?php
require_once('../inc/config.php');
require_once('../inc/functions.php');

// IF id is set in the url, use it
if (isset($_GET["id"])) {
	$event_id = intval($_GET["id"]);
  $invitees =  get_invitees($event_id);
  $guests = get_guests($event_id);
}

// Exiting if no event_id is selected
if (empty($invitees)) {
  echo "<p>This event no longer exists</p>";
  exit();
}

$totalGuests = count($invitees) + count($guests);

echo "<p>Total people attending: " . $totalGuests . "</p>";


?>

<table id="rsvp-list">
  <thead>
    <tr>
      <th>Date</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Food Accomodations</th>
    </tr>
  </thead>
  <?php

    foreach ($invitees as $key => $invitee) {
      echo '<tr><td>' . date('d-m-Y', strtotime($invitee[date])) . '</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';

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
        // Loop through guests array looking at each host_id
        foreach ($guests as $key => $guest) {
          // If that host id = the current invitee ID, list them
          if ($guest[host_id] == $invitee[ID]) {
            echo '<tr class="guest"><td>' . date('d-m-Y', strtotime($guest[date])) . '</td><td>' . $guest[first_name] . '</td><td>' . $guest[last_name] . '</td><td><a href="mailto:' . $guest[email] . '">' . $guest[email] . '</a></td><td>' . $guest[info] . '</td></tr>';
          }
        }
      }
    }

  ?>
</table>
<p>
  <button onclick="doit();">Download Table</button>
</p>
