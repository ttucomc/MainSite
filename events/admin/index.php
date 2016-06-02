<?php

require_once('inc/config.php');
require_once('inc/functions.php');

// If there was an event added, submit the SQL to the database
if(isset($_POST['form-name']) && $_POST['form-name'] == 'add-event') {
    add_event($_POST['add-event-name'], $_POST['add-event-location'], $_POST['add-event-address'], $_POST['add-event-date'], $_POST['add-event-time']);
}

// If the listing of an event was toggled
if(isset($_GET["eventUpdated"])) {
  $listingUpdated = toggle_event_listing($_GET["eventUpdated"]);
}

// If there was an event deleted
if(isset($_GET["eventDeleted"])) {
  $eventDeleted = delete_event($_GET["eventDeleted"]);
}

// Getting all events from db
$events = get_all_events();


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
        <button id="event-card-menu-<?php echo $event['ID']; ?>" class="mdl-button mdl-js-button mdl-button--icon">
          <i class="material-icons">more_vert</i>
        </button>
        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="event-card-menu-<?php echo $event['ID']; ?>">
          <li class="mdl-menu__item">Edit This Event</li>
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
        <input class="mdl-textfield__input" type="text" id="add-event-date" name="add-event-date" pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$" placeholder="DD/MM/YYYY">
        <span class="mdl-textfield__error">Please use this format: DD/MM/YYYY</span>
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <label class="mdl-textfield__label" for="add-event-time">Time</label>
        <input class="mdl-textfield__input" type="text" id="add-event-time" name="add-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$">
        <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span>
      </div>
      <input type="hidden" name="form-name" value="add-event" />
      <div class="form-buttons">
        <div class="form-button">
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="add-event-do" type="submit" form="add-event-form">
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

  <div class="mdl-spinner mdl-js-spinner" id="loader"></div>

  <div id="action-message" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
  </div>

  <script>

    // Open add event form when add event button is clicked
    $('#add-event-btn').click(function() {
      $('#add-event').fadeToggle('fast');
    });
    // Show loader when add event button is clicked
    $('#add-event-do').click(function() {
      show_loader();
    });
    // Close add event form when close button is clicked
    $('#add-event form .close-btn').click(function(event) {
      event.preventDefault();
      $('#add-event').fadeToggle('fast');
    });

    // Toggle the event listing when add or remove from listing is clicked
    $('li.toggle-listing').click(function(e) {
      e.preventDefault();
      var eventID = $(this).data('event-id');
      var currentButton = $(this);
      var currentText = currentButton.text();

      if(currentText == "Remove Event from Listing") {
        currentText = "Add Event to Listing";
      } else {
        currentText = "Remove Event from Listing";
      }

      show_loader();

      $.ajax({
        type: 'GET',
        data: {'eventUpdated': eventID},
        success: function() {
          var messageSuccess = document.querySelector('#action-message');
          var data = {message: 'This event\'s listing has been updated!'};

          messageSuccess.MaterialSnackbar.showSnackbar(data);
          currentButton.html(currentText);
        }
      }).done(function() {
        hide_loader();
      });

      return false;
    });

    //Delete an event when button is clicked
    $('li.delete-event').click(function(e) {
      e.preventDefault();

      var eventID = $(this).data('event-id');
      var currentButton = $(this);

      show_loader();

      $.ajax({
        type: 'GET',
        data: {'eventDeleted': eventID},
        success: function() {
          var messageSuccess = document.querySelector('#action-message');
          var data = {message: 'This event has been deleted!'};

          messageSuccess.MaterialSnackbar.showSnackbar(data);
        }
      }).done(function() {
        hide_loader();
        currentButton.closest('.event-card').fadeToggle('slow');
      });

      return false;
    });

    function show_loader() {
      var loader = $('#loader');
      $('body').css('opacity', '0.8');
      loader.toggleClass('is-active');
    };
    function hide_loader() {
      var loader = $('#loader');
      $('body').css('opacity', '1');
      loader.toggleClass('is-active');
    };

  </script>

</body>
</html>
