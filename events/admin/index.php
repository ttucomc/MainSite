<?php

require_once('inc/config.php');
require_once('inc/functions.php');
require_once('/comc/events/admin/include.php');

// Getting all events from db
$events = get_all_events("DESC");


?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">

  <title>Control of All Events Ever</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-amber.min.css" />
  <link rel="stylesheet" href="css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

</head>
<body>
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/comc/">College of Media &amp; Communication</a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="/comc/events/">Events Page</a>
        <a class="mdl-navigation__link" href="/comc/events/admin/">Events Admin</a>
        <a class="mdl-navigation__link" href="/comc/events/admin/rsvps/">RSVPs</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">College of Media &amp; Communication</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/comc/events/">Events Page</a>
      <a class="mdl-navigation__link" href="/comc/events/admin/">Events Admin</a>
      <a class="mdl-navigation__link" href="/comc/events/admin/rsvps/">RSVPs</a>
    </nav>
  </div>
  <h1>Events</h1>
  <nav id="admin-nav">
      <a href="rsvps/" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">See RSVPs</a>
      <a id="add-event-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Add Event</a>
  </nav>


  <?php foreach($events as $event): ?>
    <div class="mdl-card mdl-shadow--2dp event-card <?php if($event['listed'] == 0) { echo 'inactive'; } ?>">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text"><?php echo date('Y', strtotime($event['datetime'])) . ' ' . $event['name']; ?></h2>
      </div>
      <div class="mdl-card__supporting-text">
        <?php
          $invitees =  get_invitees($event['ID']);
          $guests = get_guests($event['ID']);
        ?>
          <h3>Details<?php if($event['listed'] == 0) { echo ' &mdash; <em>Inactive</em>'; } ?></h3>
          <div id="details-<?php echo $event['ID']; ?>">
            <p>
              <span class="event-description"><?php if (!empty($event['description'])){ echo nl2br($event['description']); } ?></span>
            </p>
            <p>
              <strong>Location:</strong> <span class="event-location"><?php echo $event['location']; ?></span><br />
              <strong>Address:</strong> <span class="event-address"><?php echo $event['address'] ?></span> (<a class="event-directions" href="http://maps.google.com/?q=<?php echo $event['address']; ?>" target="_blank">Directions</a>)<br />
              <strong>Time:</strong> <span class="event-date"><?php echo date('m/j/Y', strtotime($event['datetime'])); ?></span> - <span class="event-time"><?php echo date('h:i A', strtotime($event['datetime'])); ?></span>
            </p>

            <h4>RSVPs</h4>
            <form>
              <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="rsvp-switch-<?php echo $event['ID']; ?>">
                <input type="checkbox" id="rsvp-switch-<?php echo $event['ID']; ?>" class="mdl-switch__input event-rsvp-switch" value="yes" <?php if($event['rsvps'] == 1): ?>checked<?php endif; ?> data-event-id="<?php echo $event['ID']; ?>">
                <span class="mdl-switch__label">Toggle off/on</span>
              </label>
            </form>
            <?php if($event['rsvps'] == 1): ?>
              <p id="rsvp-details-<?php echo $event['ID']; ?>">
                <strong>RSVP Password:</strong> <span class="event-password"><?php echo $event['password']; ?></span><br />
                <strong>Total RSVPs:</strong> <?php echo total_rsvps($invitees); ?><br />
                <strong>Total People Attending:</strong> <?php echo total_attending($invitees, $guests); ?><br />
                <strong>RSVP Deadline:</strong> <span class="event-rsvp-deadline"><?php echo date('m/j/Y', strtotime($event['rsvp_date'])); ?></span><br />
                <?php if($event['allow_guests'] == 1): ?>
                  <strong>Allows guests?</strong> <span class="event-allow-guests">Yes</span>
                <?php else: ?>
                  <strong>Allows guests?</strong> <span class="event-allow-guests">No</span>
                <?php endif; ?>
              </p>
            <?php endif; ?>
          </div>
      </div>
      <?php if($event['rsvps'] == 1): ?>
        <div class="mdl-card__actions mdl-card--border">
          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo BASE_URL . 'rsvps/?id=' . $event['ID']; ?>">
            See Who's Coming
          </a>
        </div>
      <?php endif; ?>
      <div class="mdl-card__menu">
        <button id="event-card-menu-<?php echo $event['ID']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
          <i class="material-icons">more_vert</i>
        </button>
        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="event-card-menu-<?php echo $event['ID']; ?>">
          <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item edit-event">Edit This Event</li>
          <?php if($event['listed'] == 1): ?>
            <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item toggle-listing">Remove Event from Listing</li>
          <?php else: ?>
            <li data-event-id="<?php echo $event['ID']; ?>" class="mdl-menu__item toggle-listing">Add Event to Listing</li>
          <?php endif; ?>
          <li class="mdl-menu__item delete-event" data-event-id="<?php echo $event['ID']; ?>">Delete This Event</li>
        </ul>
      </div>
    </div>
  <?php endforeach; ?>


  <div id="add-event">
    <form id="add-event-form" method="post" action="inc/events.php" class="mdl-card mdl-shadow--4dp">
      <h3>Add Event</h3>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-name">Event Name</label>
        <input class="mdl-textfield__input" type="text" id="add-event-name" name="add-event-name">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <textarea class="mdl-textfield__input" type="text" rows="3" id="add-event-description" name="add-event-description" ></textarea>
        <label class="mdl-textfield__label" for="add-event-description">Description</label>
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
        <input class="mdl-textfield__input" type="text" id="add-event-date" name="add-event-date" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY">
        <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span>
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-time">Time</label>
        <input class="mdl-textfield__input" type="text" id="add-event-time" name="add-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$">
        <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span>
      </div>
      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="add-rsvp-switch">
        <input type="checkbox" id="add-rsvp-switch" name="add-rsvp-switch" class="mdl-switch__input" value="yes" checked>
        <span class="mdl-switch__label">RSVPs off/on</span>
      </label>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-password">RSVP Password</label>
        <input class="mdl-textfield__input" type="text" id="add-event-password" name="add-event-password">
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-rsvp-deadline">RSVP Deadline <em>(Will be match event date if left empty)</em></label>
        <input class="mdl-textfield__input" type="text" id="add-event-rsvp-deadline" name="add-event-rsvp-deadline" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY">
        <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span>
      </div>
      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="add-guests-switch">
        <input type="checkbox" id="add-guests-switch" name="add-guests-switch" class="mdl-switch__input" value="yes" checked>
        <span class="mdl-switch__label">Allow Guests? no/yes</span>
      </label>
      <input type="hidden" name="form-name" value="add-event" />
      <div class="form-buttons">
        <div class="form-button">
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="add-event-do" type="submit" form="add-event-form">
            <i class="material-icons">done</i>
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


  <div class="mdl-spinner mdl-js-spinner" id="loader"></div>
  <div id="action-message" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
  </div>

  <script src="<?php echo BASE_URL; ?>js/main.min.js"></script>

</body>
</html>
