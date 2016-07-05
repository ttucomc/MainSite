<?php

require_once('inc/config.php');
require_once('inc/functions.php');
// require_once('/comc/events/admin/include.php');

// Getting all events from db
$events = get_all_events();


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
    <div class="mdl-card mdl-shadow--2dp event-card">
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
                <strong>Total People Attending:</strong> <?php echo total_attending($invitees, $guests); ?>
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



    // When the edit event button is clicked
    $('li.edit-event').click(function() {

      var eventID = $(this).data('event-id');
      var eventCard = $(this).closest('.event-card');
      var currentName = eventCard.find('h2').text().substring(5);
      var currentLocation = eventCard.find('span.event-location').text();
      var currentAddress = eventCard.find('span.event-address').text();
      var currentDate = eventCard.find('span.event-date').text();
      var currentPassword = eventCard.find('span.event-password').text();
      var currentTime = eventCard.find('span.event-time').text();
      if (currentTime.startsWith('0')) {
        currentTime = currentTime.substring(1);
      }

      // Fading out current details
      eventCard.find('#details-' + eventID).fadeOut('fast', function() {

        // Adding event edit form
        eventCard.find('.mdl-card__supporting-text').append('<form method="POST" id="edit-event-form"> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-name">Event Name</label> <input class="mdl-textfield__input" type="text" id="edit-event-name" name="edit-event-name" value="' + currentName + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-location">Location</label> <input class="mdl-textfield__input" type="text" id="edit-event-location" name="edit-event-location" value="' + currentLocation + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-address">Address</label> <input class="mdl-textfield__input" type="text" id="edit-event-address" name="edit-event-address" value="' + currentAddress + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-date">Date</label> <input class="mdl-textfield__input" type="text" id="edit-event-date" name="edit-event-date" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY" value="' + currentDate + '"> <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-time">Time</label> <input class="mdl-textfield__input" type="text" id="edit-event-time" name="edit-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$" value="' + currentTime + '"> <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label class="mdl-textfield__label" for="edit-event-password">RSVP Password</label><input class="mdl-textfield__input" type="text" id="edit-event-password" name="edit-event-password" value="' + currentPassword + '"></div> <input type="hidden" name="form-name" value="edit-event" /> <div class="form-buttons"> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="edit-event-do" type="submit" form="edit-event-form" data-event-id="' + eventID +'"> <i class="material-icons">add</i> </button> </div> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect edit-close-btn" data-event-id="' + eventID + '"><i class="material-icons">close</i> </button> </div> </div> </form>').fadeIn();

        // Registering form
        componentHandler.upgradeDom();

      });

    });
    // If the edit form close button is clicked
    $("body").on('click', '.edit-close-btn', function(e) {
      e.preventDefault();
      var eventID = $(this).data('event-id');
      var eventCard = $(this).closest('.event-card');
      $('#edit-event-form').fadeOut('fast', function() {
        eventCard.find('#details-' + eventID).fadeIn('fast');
        $(this).remove();
      });
    });
    // If the confirm edit button is clicked
    $('body').on('click', '#edit-event-do', function(e) {
      e.preventDefault();

      var eventCard = $(this).closest('.event-card');
      var eventID = $(this).data('event-id');
      var eventName = document.getElementById('edit-event-name').value;
      var eventLocation = document.getElementById('edit-event-location').value;
      var eventAddress = document.getElementById('edit-event-address').value;
      var eventDate = document.getElementById('edit-event-date').value;
      var eventTime = document.getElementById('edit-event-time').value;
      var date = new Date();
      var year = date.getFullYear(eventDate);
      var eventPassword = document.getElementById('edit-event-password').value;

      show_loader();

      $.ajax({
        type: 'POST',
        url: 'inc/events.php',
        data: {
                'eventUpdated': eventID,
                'eventName': eventName,
                'eventLocation': eventLocation,
                'eventAddress': eventAddress,
                'eventDate': eventDate,
                'eventTime': eventTime,
                'eventPassword': eventPassword
              },
        success: function() {

          // Changing values in card to the new edits
          eventCard.find('h2').html(year + ' ' + eventName);
          eventCard.find('.event-location').html(eventLocation);
          eventCard.find('.event-address').html(eventAddress);
          eventCard.find('.event-directions').attr('href', 'http://maps.google.com/?q=' + eventAddress);
          eventCard.find('.event-date').html(eventDate);
          eventCard.find('.event-time').html(eventTime);
          eventCard.find('.event-password').html(eventPassword);

          // Setting toaster message
          var messageSuccess = document.querySelector('#action-message');
          var data = {message: 'This event\'s details have been updated!'};
          messageSuccess.MaterialSnackbar.showSnackbar(data);
        }
      }).done(function() {

        $('#edit-event-form').fadeOut('fast', function() {
          eventCard.find('#details-' + eventID).fadeIn('fast');
          $(this).remove();
        });

        hide_loader();

      });

      return false;

    });



    // Toggle RSVPs
    $('.event-rsvp-switch').change(function() {
      var eventID = $(this).data('event-id');
      var eventCard = $(this).closest('.event-card');

      if (this.checked) {
        var rsvps = 1;
      } else {
        var rsvps = 0;
      }

      show_loader();

      $.ajax({
        type: 'GET',
        url: 'inc/events.php',
        dataType: 'json',
        data: {'rsvpsToggled': eventID},
        success: function(data) {
          // Show success message
          var messageSuccess = document.querySelector('#action-message');
          var messageData = {message: 'This event\'s RSVPs has been toggled!'};
          messageSuccess.MaterialSnackbar.showSnackbar(messageData);

          // Update the card to show the status is toggled
          if (!rsvps) {
            $('#rsvp-details-' + eventID).remove();
            $(eventCard).find('.mdl-card__actions').remove();
          } else {
            // Adding rsvp information
            $('#details-' + eventID).append('<p id="rsvp-details-' + eventID + '"><strong>RSVP Password:</strong> <span class="event-password">' + data['password'] + '</span><br /><strong>Total RSVPs:</strong> 0<br /><strong>Total People Attending:</strong> 0</p>');

            // Adding bottom link to view rsvps
            $(eventCard).find('.mdl-card__supporting-text').after('<div class="mdl-card__actions mdl-card--border"><a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo BASE_URL; ?>rsvps/?id=' + eventID + '">See Who\'s Coming</a></div>');

          }

        }
      }).done(function() {
        hide_loader();
      });

      return false;
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
        url: 'inc/events.php',
        data: {'listingUpdated': eventID},
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



    // Delete an event when button is clicked
    $('li.delete-event').click(function(e) {
      e.preventDefault();

      // Adding confirmation panel
      $('body').append('<div class="mdl-card mdl-shadow--6dp" id="confirm-delete"><h3>Are you sure?</h3><p>This will delete this event and all rsvps from the database</p><div class="mdl-card__actions mdl-card--border"><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent confirm-delete-btn"><i class="material-icons">delete</i></button><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--primary clear-delete-btn"><i class="material-icons">clear</i></button></div></div>');
      $('#confirm-delete').fadeToggle('fast');

      // Closing confirmation panel if cancel is clicked
      $('.clear-delete-btn').click(function() {
        $('#confirm-delete').fadeToggle('fast', function() {
          $('#confirm-delete').remove();
        });
      });

      // Getting the correct event id
      var eventID = $(this).data('event-id');
      // Assigning this to a variable to use later
      var currentButton = $(this);

      $('.confirm-delete-btn').click(function() {

        show_loader();
        // Removing confirmation panel
        $('#confirm-delete').fadeToggle('fast', function() {
          $('#confirm-delete').remove();
        });

        // Starting AJAX request
        $.ajax({
          type: 'GET',
          url: 'inc/events.php',
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
