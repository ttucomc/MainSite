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
}

// Showing a message if there are no RSVPs
if (empty($invitees)) {
	echo "<div id='rsvps'><p>I guess no ones coming... :(</p></div>";
} else {


?>
<div id="rsvps">
	<p>
		Total RSVPs: <?php echo total_rsvps($invitees); ?>
	</p>
	<p>
		Total People Attending (<em>Includes Guests</em>): <?php echo total_attending($invitees, $guests); ?>
	</p>

	<table id="rsvp-list" class="tablesorter mdl-data-table mdl-js-data-table mdl-shadow--2dp">
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
	          echo '<tr><td class="mdl-data-table__cell--non-numeric">' . date('m-d-Y', strtotime($invitee[date])) . '</td><td class="mdl-data-table__cell--non-numeric">Yes</td><td class="mdl-data-table__cell--non-numeric">' . $invitee[first_name] . '</td><td class="mdl-data-table__cell--non-numeric">' . $invitee[last_name] . '</td><td class="mdl-data-table__cell--non-numeric"><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td class="mdl-data-table__cell--non-numeric">' . $invitee[info] . '</td></tr>';
	          // List all of this person's guests
	          foreach ($inviteesGuests as $guest) {
	            echo '<tr class="guest"><td class="mdl-data-table__cell--non-numeric">' . date('m-d-Y', strtotime($guest[date])) . '</td><td class="mdl-data-table__cell--non-numeric">Guest with ' . $invitee[first_name] . ' ' . $invitee[last_name] . '</td><td class="mdl-data-table__cell--non-numeric">' . $guest[first_name] . '</td><td class="mdl-data-table__cell--non-numeric">' . $guest[last_name] . '</td><td class="mdl-data-table__cell--non-numeric"><a href="mailto:' . $guest[email] . '">' . $guest[email] . '</a></td><td class="mdl-data-table__cell--non-numeric">' . $guest[info] . '</td></tr>';
	          }
	        } else {
	          echo '<tr><td class="mdl-data-table__cell--non-numeric">' . date('m-d-Y', strtotime($invitee[date])) . '</td><td class="mdl-data-table__cell--non-numeric">' . ($invitee[attending] == 1 ? 'Yes' : 'No') . '</td><td class="mdl-data-table__cell--non-numeric">' . $invitee[first_name] . '</td><td class="mdl-data-table__cell--non-numeric">' . $invitee[last_name] . '</td><td class="mdl-data-table__cell--non-numeric"><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td class="mdl-data-table__cell--non-numeric">' . $invitee[info] . '</td></tr>';
	        }
	      }

	    ?>
	  </tbody>
	</table>
	<p class="export-button">
	  <button onclick="doit();" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Download Table</button>
	</p>
</div>
<?php } ?>
