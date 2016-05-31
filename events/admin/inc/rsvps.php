<?php
require_once('../inc/config.php');
require_once('../inc/functions.php');

// IF id is set in the url, use it
if (isset($_GET["id"])) {
	$event_id = intval($_GET["id"]);
  $invitees =  get_invitees($event_id);
  $guests = get_guests($event_id);
} else {
	echo "<p>No event selected, or this event doesn't exist.</p>";
	exit();
}

// Showing a message if there are no RSVPs
if (empty($invitees)) {
  echo "<p>I guess no ones coming... :(</p>";
  exit();
}


?>
<p>
	Total RSVPs: <?php echo total_rsvps($invitees); ?>
</p>
<p>
	Total People Attending (<em>Includes Guests</em>): <?php echo total_attending($invitees, $guests); ?>
</p>

<table id="rsvp-list" class="tablesorter">
  <thead>
    <tr>
      <th>Date</th>
			<th>Attending?</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Food Accomodations</th>
    </tr>
  </thead>
  <tbody>
    <?php

      foreach ($invitees as $key => $invitee) {

        // Getting this invitee's guests
				$inviteesGuests = invitees_guests($invitee, $guests);
				// Checking if this invitee has guests
				if(!empty($inviteesGuests)) {
					$hasGuests = true;
				} else {
					$hasGuests = false;
				}


        // If the invitee is coming and has guests, list the invitee and their guests under their name. Else just list the invitee.
        if ($hasGuests) {
          echo '<tr><td>' . date('m-d-Y', strtotime($invitee[date])) . '</td><td>Yes</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';
          // List all of this person's guests
          foreach ($inviteesGuests as $guest) {
            echo '<tr class="guest"><td>' . date('m-d-Y', strtotime($guest[date])) . '</td><td>Guest with ' . $invitee[first_name] . ' ' . $invitee[last_name] . '</td><td>' . $guest[first_name] . '</td><td>' . $guest[last_name] . '</td><td><a href="mailto:' . $guest[email] . '">' . $guest[email] . '</a></td><td>' . $guest[info] . '</td></tr>';
          }
        } else {
          echo '<tr><td>' . date('m-d-Y', strtotime($invitee[date])) . '</td><td>' . ($invitee[attending] == 1 ? 'Yes' : 'No') . '</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';
        }
      }

    ?>
  </tbody>
</table>
<p class="export-button">
  <button onclick="doit();">Download Table</button>
</p>
