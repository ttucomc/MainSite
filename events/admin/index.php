<?php

require_once('inc/config.php');
require_once('inc/functions.php');

// Getting all events from db
$events = get_all_events();

// If there was an event added, submit the SQL to the database
if(isset($_POST['form-name']) && $_POST['form-name'] == 'add-event') {
    add_event($_POST['add-event-name'], $_POST['add-event-location'], $_POST['add-event-address'], $_POST['add-event-date'], $_POST['add-event-time']);
}

?>
<html>
<head>

  <meta name="title" content="Control of All Events Ever" />

  <link rel="stylesheet" href="../rsvp/css/ttu.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.red-indigo.min.css" />
  <link rel="stylesheet" href="css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

  <style>
    table caption {
      caption-side: bottom;
    }
  </style>
</head>
<body>
  <h1>CoMC Events</h1>
  <nav id="admin-nav">
      <a href="rsvps/" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">See RSVPs</a>
      <a id="add-event-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Add Event</a>
  </nav>

  <?php foreach($events as $event): ?>
    <div class="mdl-card mdl-shadow--2dp event-card">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text"><?php echo date('Y', strtotime($event['datetime'])) . ' ' . $event['name']; ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <?php
          $invitees =  get_invitees($event['ID']);
          $guests = get_guests($event['ID']);
        ?>
          <h4>Details</h4>
          <p>
            <strong>Location:</strong> <?php echo $event['location']; ?> (<a href="http://maps.google.com/?q=<?php echo $event['address']; ?>" target="_blank">Directions</a>)<br />
            <strong>Time:</strong> <?php echo date('D, M d, Y - h:i A', strtotime($event['datetime'])); ?>
          </p>
          <p>
            Total RSVPs: <?php echo total_rsvps($invitees); ?><br />
            Total People Attending: <?php echo total_attending($invitees, $guests); ?>
          </p>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo BASE_URL . 'rsvps/?id=' . $event['ID']; ?>">
          See Who's Coming
        </a>
      </div>
      <div class="mdl-card__menu">
        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
          <i class="material-icons">more_vert</i>
        </button>
        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
          <li class="mdl-menu__item">Edit This Event</li>
          <li class="mdl-menu__item">Remove Event from Listing</li>
          <li class="mdl-menu__item">Delete This Event</li>
        </ul>
      </div>
    </div>
  <?php endforeach; ?>
  <div id="add-event">
    <form id="add-event-form" method="post" action="" class="mdl-card mdl-shadow--4dp">
      <h3>Add Event</h3>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-name">Event Name</label>
        <input class="mdl-textfield__input" type="text" id="add-event-name" name="add-event-name">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-location">Location</label>
        <input class="mdl-textfield__input" type="text" id="add-event-location" name="add-event-location">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-address">Address</label>
        <input class="mdl-textfield__input" type="text" id="add-event-address" name="add-event-address">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-date">Date</label>
        <input class="mdl-textfield__input" type="text" id="add-event-date" name="add-event-date">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-time">Time</label>
        <input class="mdl-textfield__input" type="text" id="add-event-time" name="add-event-time">
      </div>
      <input type="hidden" name="form-name" value="add-event" />
      <div class="form-buttons">
        <div class="form-button">
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" type="submit" form="add-event-form">
            <i class="material-icons">add</i>
          </button>
        </div>
        <div class="form-button">
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect close-btn">
            <i class="material-icons">close</i>
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>

    // Open add event form when add event button is clicked
    $('#add-event-btn').click(function() {
      $('#add-event').fadeToggle('fast');
    });
    // Close add event form when close button is clicked
    $('#add-event form .close-btn').click(function(event) {
      event.preventDefault();
      $('#add-event').fadeToggle('fast');
    });

  </script>

</body>
</html>
