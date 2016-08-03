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
  var currentDescription = eventCard.find('span.event-description').text();
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
    eventCard.find('.mdl-card__supporting-text').append('<form method="POST" id="edit-event-form"> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-name">Event Name</label> <input class="mdl-textfield__input" type="text" id="edit-event-name" name="edit-event-name" value="' + currentName + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><textarea class="mdl-textfield__input" type="text" rows="3" id="edit-event-description" name="edit-event-description" >' + currentDescription + '</textarea><label class="mdl-textfield__label" for="edit-event-description">Description</label></div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-location">Location</label> <input class="mdl-textfield__input" type="text" id="edit-event-location" name="edit-event-location" value="' + currentLocation + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-address">Address</label> <input class="mdl-textfield__input" type="text" id="edit-event-address" name="edit-event-address" value="' + currentAddress + '"> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-date">Date</label> <input class="mdl-textfield__input" type="text" id="edit-event-date" name="edit-event-date" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY" value="' + currentDate + '"> <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> <label class="mdl-textfield__label" for="edit-event-time">Time</label> <input class="mdl-textfield__input" type="text" id="edit-event-time" name="edit-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$" value="' + currentTime + '"> <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span> </div> <br /> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><label class="mdl-textfield__label" for="edit-event-password">RSVP Password</label><input class="mdl-textfield__input" type="text" id="edit-event-password" name="edit-event-password" value="' + currentPassword + '"></div> <input type="hidden" name="form-name" value="edit-event" /> <div class="form-buttons"> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="edit-event-do" type="submit" form="edit-event-form" data-event-id="' + eventID +'"> <i class="material-icons">add</i> </button> </div> <div class="form-button"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect edit-close-btn" data-event-id="' + eventID + '"><i class="material-icons">close</i> </button> </div> </div> </form>').fadeIn();

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
  var eventDescription = document.getElementById('edit-event-description').value;
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
            'eventDescription': eventDescription,
            'eventLocation': eventLocation,
            'eventAddress': eventAddress,
            'eventDate': eventDate,
            'eventTime': eventTime,
            'eventPassword': eventPassword
          },
    success: function() {

      // Changing values in card to the new edits
      eventCard.find('h2').html(year + ' ' + eventName);
      eventCard.find('.event-description').html(eventDescription);
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
  var eventCard = $(this).closest('.event-card');
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
      // Show updated confirmation
      var messageSuccess = document.querySelector('#action-message');
      var data = {message: 'This event\'s listing has been updated!'};
      messageSuccess.MaterialSnackbar.showSnackbar(data);

      // Change button text in menu
      currentButton.html(currentText);

      // Changing event card
      if (currentText == 'Remove Event from Listing') {
        $(eventCard).find('h3').replaceWith('<h3>Details</h3>');
        $(eventCard).toggleClass('inactive');
      } else {
        $(eventCard).find('h3').replaceWith('<h3>Details &mdash; <em>Inactive</em></h3>');
        $(eventCard).toggleClass('inactive');
      }

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
