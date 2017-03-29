<?php

require_once('inc/config.php');
require_once('inc/functions.php');
require_once('include.php');


?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">

  <title>Control of All Events Ever</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-indigo.min.css" />
  <link rel="stylesheet" href="css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

  <section id="events-list">
      <?php include 'inc/eventsList.php'; ?>
  </section>


  <div id="add-event">
    <form id="add-event-form" class="mdl-card mdl-shadow--4dp">
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
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-end-time">End Time <em>(Won't show this if left empty)</em></label>
        <input class="mdl-textfield__input" type="text" id="add-event-end-time" name="add-event-end-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$">
        <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span>
      </div>
      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="add-rsvp-switch">
        <input type="checkbox" id="add-rsvp-switch" name="add-rsvp-switch" class="mdl-switch__input" value="1" checked>
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
        <input type="checkbox" id="add-guests-switch" name="add-guests-switch" class="mdl-switch__input" value="1" checked>
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


  <div id="loader" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
  <div id="action-message" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
  </div>

  <script src="<?php echo BASE_URL; ?>js/main.min.js"></script>

</body>
</html>
