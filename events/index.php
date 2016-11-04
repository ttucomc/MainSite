<?php

require_once('admin/inc/config.php');
require_once('admin/inc/functions.php');

// Getting all events from db
$events = get_all_events();
?>

<html>
<head>

  <title>College Events</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue-red.min.css" />
  <link rel="stylesheet" href="admin/css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

</head>
<body>
  <h1>College Events</h1>
  <p>For questions or more information on any of our events, please email or call <a class="mail" href="mailto:taryn.meixner@ttu.edu">Taryn Meixner</a>, <a href="tel:8068346733">806.834.6733</a>.</p>

  <?php foreach ($events as $event): ?>

    <?php
      // Setting variables
      $thisEventDate = new DateTime($event['datetime']);
      $currentDate = new DateTime();
    ?>

    <?php if($event['listed'] == 1 && $thisEventDate->modify('+1 year') > $currentDate): ?>
      <article>
        <h2><?php echo $event['name']; ?></h2>
        <?php if (!empty($event['description'])){ echo "<p>" . nl2br($event['description']) . "</p>"; } ?>
        <p>
          <strong>Date:</strong>&nbsp;<?php echo date('l, M. j, Y', strtotime($event['datetime'])) . ' &mdash; ' . date('h:i a', strtotime($event['datetime'])); ?>
          <?php if(!empty($event['end_time'])) {
            echo " to " . date('h:i a', strtotime($event['end_time']));
          } ?>
          <br />
          <?php echo '<strong>Location:</strong> ' . $event['location'] . ' (<a class="external" target="_blank" href="http://maps.google.com/?q=' . $event['address'] . '">Directions</a>)'; ?><br />
        </p>
        <p>
          <?php
            if ($event['rsvps'] == 1 && strtotime($event['rsvp_date']) >= time()) {
              echo '<strong>RSVP Deadline:</strong> ' . date('l, M. j, Y', strtotime($event['rsvp_date'])) . '<br /><a class="button" href="/comc/events/rsvp/?id=' . $event['ID'] . '">RSVP</a>';
            }
          ?>
        </p>
      </article>

    <?php endif; ?>

  <?php endforeach; ?>

</body>
</html>
