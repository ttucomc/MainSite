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
  <p>
    For questions or more information on any of our events, please email <a href="mailto:taryn.meixner@ttu.edu" class="mail">Taryn Meixner</a>.
  </p>

  <?php foreach ($events as $event): ?>

    <?php if($event['listed'] == 1): ?>

      <article>
        <h2><?php echo date('Y', strtotime($event['datetime'])) . ' ' . $event['name']; ?></h2>
        <p>
          Date: <?php echo date('l, M. j, Y', strtotime($event['datetime'])) . ' &mdash; ' . date('h:i a', strtotime($event['datetime'])); ?><br />
          <?php echo 'Location: ' . $event['location'] . ' (<a class="external" target="_blank" href="http://maps.google.com/?q=' . $event['address'] . '">Directions</a>)'; ?>
        </p>
        <p>
          <?php
            if ($event['rsvps'] == 1) {
              echo '<a class="button" href="/comc/events/rsvp/?id=' . $event['ID'] . '">RSVP</a>';
            }
          ?>
        </p>
      </article>

    <?php endif; ?>

  <?php endforeach; ?>

</body>
</html>
