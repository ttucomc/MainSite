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
          <h4>Details<?php if($event['listed'] == 0) { echo ' &mdash; <em>Inactive</em>'; } ?></h4>
          <p id="details-<?php echo $event['ID']; ?>">
            <strong>Location:</strong> <span class="event-location"><?php echo $event['location']; ?></span><br />
            <strong>Address:</strong> <span class="event-address"><?php echo $event['address'] ?></span> (<a href="http://maps.google.com/?q=<?php echo $event['address']; ?>" target="_blank">Directions</a>)<br />
            <strong>Time:</strong> <span class="event-date"><?php echo date('D, M d, Y', strtotime($event['datetime'])); ?></span> - <span class="event-time"><?php echo date('h:i A', strtotime($event['datetime'])); ?></span>
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



    // When the edit event button is clicked
    $('li.edit-event').click(function() {

      var eventID = $(this).data('event-id');
      var eventCard = $(this).closest('.event-card');
      var currentName = eventCard.find('h2').text().substring(5);
      var currentLocation = eventCard.find('span.event-location').text();
      var currentAddress = eventCard.find('span.event-address').text();
      var currentDate = eventCard.find('span.event-date').text();
      // Formatting date to show in form
      var date = new Date();
      currentDate = Date.parse(currentDate);
      currentDay = date.getDate(currentDate);
      currentMonth = date.getMonth(currentDate);
      currentYear = date.getFullYear(currentDate);
      currentDate = currentDay + '/' + currentMonth + '/' + currentYear;
      var currentTime = eventCard.find('span.event-time').text();

      // Fading out current details
      eventCard.find('#details-' + eventID).fadeOut('fast', function() {

        // Adding event edit form
        eventCard.find('.mdl-card__supporting-text').append('<form method="POST" id="edit-event-form"> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-name">Event Name</label> <input class="mdl-textfield__input" type="text" id="edit-event-name" name="edit-event-name" value="' + currentName + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-location">Location</label> <input class="mdl-textfield__input" type="text" id="edit-event-location" name="edit-event-location" value="' + currentLocation + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-address">Address</label> <input class="mdl-textfield__input" type="text" id="edit-event-address" name="edit-event-address" value="' + currentAddress + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-date">Date</label> <input class="mdl-textfield__input" type="text" id="edit-event-date" name="edit-event-date" pattern="^(?:(?:31(\\/|-|\\.)(?:0?[13578]|1[02]))\\1|(?:(?:29|30)(\\/|-|\\.)(?:0?[1,3-9]|1[0-2])\\2))(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$|^(?:29(\\/|-|\\.)0?2\\3(?:(?:(?:1[6-9]|[2-9]\\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\\d|2[0-8])(\\/|-|\\.)(?:(?:0?[1-9])|(?:1[0-2]))\\4(?:(?:1[6-9]|[2-9]\\d)?\\d{2})$" placeholder="DD/MM/YYYY" value="' + currentDate + '"> <span class="mdl-textfield__error">Please use this format: DD/MM/YYYY</span> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-time">Time</label> <input class="mdl-textfield__input" type="text" id="edit-event-time" name="edit-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$" value="' + currentTime + '"> <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span> </div> <input type="hidden" name="form-name" value="edit-event" /> <div class="form-buttons"> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="edit-event-do" type="submit" form="edit-event-form" data-event-id="' + eventID +'"> <i class="material-icons">add</i> </button> </div> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect edit-close-btn" data-event-id="' + eventID +'"> <i class="material-icons">close</i> </button> </div> </div> </form>').fadeIn();

        // Registering form
        componentHandler.upgradeDom();

      });


    });
    // If close button is clicked
    $("body").on('click', '.edit-close-btn', function(e) {
      e.preventDefault();
      var eventID = $(this).data('event-id');
      var eventCard = $(this).closest('.event-card');
      $('#edit-event-form').fadeOut('fast', function() {
        eventCard.find('#details-' + eventID).fadeIn('fast');
        $(this).remove();
      });
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



    // Delete an event when button is clicked
    $('li.delete-event').click(function(e) {
      e.preventDefault();

      // Adding confirmation panel
      $('body').append('<div class="mdl-card mdl-shadow--6dp" id="confirm-delete"><h3>Are you sure?</h3><p>This will delete this event and all rsvps from the database</p><div class="mdl-card__actions mdl-card--border"><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--primary confirm-delete-btn"><i class="material-icons">delete</i></button><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent clear-delete-btn"><i class="material-icons">clear</i></button></div></div>');
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
