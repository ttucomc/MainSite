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

// Exiting if no event_id is selected
if (empty($invitees)) {
  echo "<p>I guess no ones coming... :(</p>";
  exit();
}

$totalGuests = count($invitees) + count($guests);


?>

<table id="rsvp-list">
  <thead>
		<tr>
			<td colspan="6">
				Total people attending: <?php echo $totalGuests; ?>
			</td>
		</tr>
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

				$isAttending = $invitee[attending];

        // Variable to determine if invitee has any guests
        $hasGuests = false;

        // Checking if any of the guests host_id match this invitee's ID
        foreach ($guests as $key => $guest) {
          // If it does, set the hasGuests variable to true
          if ($guest[host_id] == $invitee[ID]) {
            $hasGuests = true;
          }
        }

        // If the invitee is coming and has guests, list the guests under their name
        if ($hasGuests && $isAttending == 1) {
          echo "</tbody><tbody class='hasGuests'>";
          echo '<tr><td>' . date('m-d-Y', strtotime($invitee[date])) . '</td><td>Yes</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';
          // echo "<tr class='guest'><td colspan='5'>Guests</td></tr>";
          // Loop through guests array looking at each host_id
          foreach ($guests as $key => $guest) {
            // If that host id = the current invitee ID, list them
            if ($guest[host_id] == $invitee[ID]) {
              echo '<tr class="guest"><td>' . date('m-d-Y', strtotime($guest[date])) . '</td><td>Yes</td><td>' . $guest[first_name] . '</td><td>' . $guest[last_name] . '</td><td><a href="mailto:' . $guest[email] . '">' . $guest[email] . '</a></td><td>' . $guest[info] . '</td></tr>';
            }
          }
          echo "</tbody><tbody>";
        } else if ($isAttending == 1) {
          echo '<tr><td>' . date('m-d-Y', strtotime($invitee[date])) . '</td><td>Yes</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';
        }
      }

			// If they're not attending
			foreach ($invitees as $key => $invitee) {

				$isAttending = $invitee[attending];

				// If the invitee is not coming
        if ($isAttending == 0) {
          echo '<tr><td>' . date('m-d-Y', strtotime($invitee[date])) . '</td><td>No</td><td>' . $invitee[first_name] . '</td><td>' . $invitee[last_name] . '</td><td><a href="mailto:' . $invitee[email] . '">' . $invitee[email] . '</a></td><td>' . $invitee[info] . '</td></tr>';
        }
      }

    ?>
  </tbody>
</table>
<p class="export-button">
  <button onclick="doit();">Download Table</button>
</p>
