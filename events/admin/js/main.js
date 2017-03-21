(function () {

    // Open add event form when 'Add Event' is clicked
    $('#add-event-btn').click( () => $('#add-event').fadeToggle('fast') );

    // Closes add event form when 'X' button is clicked
    $('#add-event form .close-btn').click( event => {
        event.preventDefault();
        $('#add-event').fadeToggle('fast');
    });

    // Runs createEvent() when add event confirm button is clicked
    $('#add-event-do').click( event => {
        event.preventDefault();
        const $addForm = $('#add-event-form');
        // Fade the add event form out
        $('#add-event').fadeToggle('fast');
        createEvent($addForm);
    });

    // Switching event details to edit form when edit event button on event's card is clicked
    $('li.edit-event').click( event => {
      const eventID = $(event.target).data('event-id');
      const $eventCard = $(event.target).closest('.event-card');
      const currentName = $eventCard.find('h2').text().substring(5);
      const currentDescription = $eventCard.find('span.event-description').text();
      const currentLocation = $eventCard.find('span.event-location').text();
      const currentAddress = $eventCard.find('span.event-address').text();
      const currentDate = $eventCard.find('span.event-date').text();
      const currentPassword = $eventCard.find('span.event-password').text();
      let currentTime = $eventCard.find('span.event-time').text();
      let currentEndTime = $eventCard.find('span.event-end-time').text();
      let currentDeadline = $eventCard.find('span.event-rsvp-deadline').text();
      // Setting currentGuestAllow to checked or blank based on if it says Yes or No to update event form
      if ($eventCard.find('span.event-allow-guests').text() === 'Yes') {
        const currentGuestAllow = 'checked';
      } else {
        const currentGuestAllow = ' ';
      }

      // Checking times to remove 0 if it begins with it
      if (currentTime.startsWith('0')) {
        currentTime = currentTime.substring(1);
      }
      if (currentEndTime.startsWith('0')) {
        currentEndTime = currentEndTime.substring(1);
      }
      if (currentDeadline.startsWith('0')) {
        currentDeadline = currentDeadline.substring(1);
      }

      // Fading out current details
      $eventCard.find('#details-' + eventID).fadeOut('fast', () => {

        // Adding event edit form
        $eventCard.find('.mdl-card__supporting-text').append(`
          <form method="POST" id="edit-event-form">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-name">Event Name</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-name" name="edit-event-name" value="' + currentName + '">
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <textarea class="mdl-textfield__input" type="text" rows="3" id="edit-event-description" name="edit-event-description" >${currentDescription}</textarea>
              <label class="mdl-textfield__label" for="edit-event-description">Description</label>
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-location">Location</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-location" name="edit-event-location" value="${currentLocation}">
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-address">Address</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-address" name="edit-event-address" value="${currentAddress}">
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-date">Date</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-date" name="edit-event-date" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY" value="${currentDate}">
              <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span>
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-time">Time</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-time" name="edit-event-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$" value="${currentTime}">
              <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span>
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-end-time">End Time <em>(Won\'t show this if left empty)</em></label>
              <input class="mdl-textfield__input" type="text" id="edit-event-end-time" name="edit-event-end-time" placeholder="XX:XX AM/PM" pattern="^ *(1[0-2]|[1-9]):[0-5][0-9] *(a|p|A|P)(m|M) *$" value="${currentEndTime}">
              <span class="mdl-textfield__error">Please use this format: XX:XX AM/PM</span>
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-password">RSVP Password</label>
              <input class="mdl-textfield__input" type="text" id="edit-event-password" name="edit-event-password" value="${currentPassword}">
            </div>
            <br />
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="edit-event-rsvp-deadline">RSVP Deadline <em>(Will be match event date if left empty)</em></label>
              <input class="mdl-textfield__input" type="text" id="edit-event-rsvp-deadline" name="edit-event-rsvp-deadline" pattern="^([0]?[1-9]|[1][0-2])[./-]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0-9]{4}|[0-9]{2})$" placeholder="MM/DD/YYYY" value="${currentDeadline}">
              <span class="mdl-textfield__error">Please use this format: MM/DD/YYYY</span>
            </div>
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="edit-guests-switch">
            <input type="checkbox" id="edit-guests-switch" name="edit-guests-switch" class="mdl-switch__input" value="yes" ${currentGuestAllow}>
              <span class="mdl-switch__label">Allow Guests? no/yes</span>
            </label>
            <input type="hidden" name="form-name" value="edit-event" />
            <div class="form-buttons">
              <div class="form-button">
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="edit-event-do" type="submit" form="edit-event-form" data-event-id="${eventID}"><i class="material-icons">done</i></button>
              </div>
              <div class="form-button">
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect edit-close-btn" data-event-id="${eventID}"><i class="material-icons">close</i></button>
              </div>
            </div>
          </form>`).fadeIn();

        // Registering form
        componentHandler.upgradeDom();

      });

    });

    // Runs deleteEvent() when the delete button is clicked
    $('li.delete-event').click( event => {
        event.preventDefault();

        // Getting event information
        const $event = $(event.target);
        const eventID = $event.data('event-id');

        // Creating the confirmation panel
        const confirmPanel = `
            <div class="mdl-card mdl-shadow--6dp" id="confirm-delete">
                <h3>Are you sure?</h3>
                <p>This will delete this event and all rsvps from the database</p>
                <div class="mdl-card__actions mdl-card--border">
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent confirm-delete-btn"><i class="material-icons">delete</i></button>
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--primary clear-delete-btn"><i class="material-icons">clear</i></button>
                </div>
            </div>`;

        // Adding confirmation panel to the page
        $('body').append(confirmPanel);
        $('#confirm-delete').fadeToggle('fast');

        // Closing confirmation panel if cancel is clicked
        $('.clear-delete-btn').click( () => {
          $('#confirm-delete').fadeToggle( 'fast', () => $('#confirm-delete').remove() );
        });

        // Deleting event if the confirm button is clicked
        $('.confirm-delete-btn').click( () => {
            // Removing confirmation panel
            $('#confirm-delete').fadeToggle( 'fast', () => $('#confirm-delete').remove() );

            deleteEvent($event, eventID);

        });
    });


    // Runs toggleEventListing() when add or remove from event page is clicked
    $('li.toggle-listing').click( event => {
        event.preventDefault();

        const eventID = $(event.target).data('event-id');
        const $eventCard = $(event.target).closest('.event-card');

        toggleEventListing(eventID, $eventCard);

    });


    // Runs toggleEventRsvp() when switched on the event's card
    $('.event-rsvp-switch').change( event => {
        const eventID = $(event.target).data('event-id');
        const $eventCard = $(event.target).closest('.event-card');

        toggleEventRsvp(eventID, $eventCard);

    });


    /**
     * Creates an event in the database
     * @param {Object} $form - jQuery object of the form with the event details
     */
    function createEvent($form) {
        // Showing the loader
        showLoader();

        // Getting all the form data from the form and setting it to a variable
        const formData = new FormData($form[0]);

        // Making the call to the server
        $.ajax({
            url        : 'inc/createEvent.php',
            method     : 'POST',
            data       : formData,
            processData: false,
            contentType: false,
            dataType   : 'json',
            encode     : true,
            success    : function(data, status, jqXHR) {

                if (data.success) {
                    // Showing toaster
                    showToaster(data.message);

                    // Resetting the form
                    $form[0].reset();

                } else {
                    // Showing toaster
                    showToaster(`${data.message}: ${status}`);

                }

                // Refreshing the events feed
                refreshEvents();

            }

        }).done( () => hideLoader() );

    }


    /**
     * Edits an event in the database
     * @param {Object} $form - jQuery object of the form with updated event details
     */
    function editEvent($form) {
      // Showing the loader
      showLoader();

      // Getting all the form data from the form and setting it to a variable
      const formData = new FormData($form[0]);

      // Making the AJAX call
      $.ajax({
          url        : 'inc/editEvent.php',
          method     : 'POST',
          data       : formData,
          processData: false,
          contentType: false,
          dataType   : 'json',
          encode     : true,
          success    : (data, status, jqXHR) => {
            if (data.success) {
                // Showing toaster
                showToaster(data.message);

            } else {
                // Showing toaster
                showToaster(`${data.message}: ${status}`);

            }
          }
      });
    }

    /**
     * Deletes an event from the database
     * @param {Object} $event  - jQuery object of the event that was clicked
     * @param {int}    eventID - The id of the event
     */
    function deleteEvent($event, eventID) {
        // Showing the loader
        showLoader();

        // Selecting the event's whole card
        const $eventCard = $event.closest('.event-card');

        // Starting AJAX request
        $.ajax({
          url     : 'inc/deleteEvent.php',
          type    : 'POST',
          data    : {'eventDeleted': eventID},
          dataType: 'json',
          success : function(data, status, jqXHR) {
              if (data.success) {
                  // Showing toaster
                  showToaster(data.message);

              } else {
                  // Showing toaster
                  showToaster(`${data.message}: ${status}`);

              }

          }
      }).done( () => {

          // Removing the event's card from the list
          $eventCard.fadeToggle('slow', () => $eventCard.remove());

          // Hiding the loader
          hideLoader();

      });

    }


    /**
     * Toggles if the event is listed on the events page
     * @param {int}    eventID    - The ID of the event
     * @param {Object} $eventCard - jQuery object of the event's card
     */
    function toggleEventListing(eventID, $eventCard) {
        const $eventH3 = $eventCard.find('h3');
        const $eventToggleButton = $eventCard.find('li.toggle-listing');

        // Showing the loader
        showLoader();

        // Making the database call
        $.ajax({
            type    : 'POST',
            url     : 'inc/toggleListing.php',
            data    : {'listingUpdated': eventID},
            dataType: 'json',
            success : function(data, status, jqXHR) {
                if (data.success) {
                    // Showing toaster
                    showToaster(data.message);

                    // Changing text of menu item and H3
                    if (parseInt(data.listed) === 1) {
                        $eventH3.text("Details");
                        $eventToggleButton.text('Remove from the events page');
                    } else {
                        $eventH3.text("Details - Inactive");
                        $eventToggleButton.text('Add to the events page');
                    }

                    // Toggling the class to change it from faded or not
                    $eventCard.toggleClass('inactive');

                } else {
                    // Showing toaster
                    showToaster(`${data.message}: ${status}`);

                }

            }
        }).done( () => hideLoader() );

    }


    /**
     * Toggles if the event accepts RSVPs or not
     * @param {int}    eventID    - The ID of the event
     * @param {Object} $eventCard - jQuery object of the event's card
     */
    function toggleEventRsvp(eventID, $eventCard) {
        // Showing loader
        showLoader();

        $.ajax({
            url     : 'inc/toggleRsvp.php',
            type    : 'POST',
            dataType: 'json',
            data    : {'rsvpToggled': eventID},
            success : function(data, status, jqXHR) {
                if (data.success) {
                    // Showing toaster
                    showToaster(data.message);

                    // Setting the variable to show if the event allows guests from database
                    let allowsGuests = parseInt(data.guests);
                    if (allowsGuests === 1) {
                        allowsGuests = 'Yes';
                    } else {
                        allowsGuests = 'No';
                    }

                    // Setting the rsvp deadline from database
                    let rsvpDate = new Date(data.date);

                    // If they turned the rsvp option on
                    if (parseInt(data.rsvps) === 1) {
                        // Adding rsvp information to the event's card
                        $('#details-' + eventID).append(`
                            <p id="rsvp-details-${eventID}">
                                <strong>RSVP Password:</strong> <span class="event-password">${data.password}</span><br />
                                <strong>RSVP Deadline:</strong> ${rsvpDate.getMonth() + 1}/${rsvpDate.getDate()}/${rsvpDate.getFullYear()}<br />
                                <strong>Allows guests?</strong> ${allowsGuests}
                            </p>`);

                        // Adding bottom link to view rsvps to the event's card
                        $eventCard.find('.mdl-card__supporting-text').after(`
                            <div class="mdl-card__actions mdl-card--border">
                                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php echo BASE_URL; ?>rsvps/?id=${eventID}">See Who\'s Coming</a>
                            </div>`);

                    } else {
                        $('#rsvp-details-' + eventID).remove();
                        $eventCard.find('.mdl-card__actions').remove();
                    }

                } else {
                    // Showing toaster
                    showToaster(`${data.message}: ${status}`);

                }
            }
        }).done( () => hideLoader() );

    }


    /** Refreshes the events list */
    function refreshEvents() {
        // Selecting the events list section
        const eventsListSection = document.getElementById('events-list');

        // Starting GET call for eventsList.php
        $.get('inc/eventsList.php', data => eventsListSection.innerHTML = data).done( () => componentHandler.upgradeDom() );

    }


    /** This will show the loader */
    function showLoader() {
        const loader = $('#loader');
        loader.show();
    }

    /** This will hide the loader */
    function hideLoader() {
        const loader = $('#loader');
        loader.hide();
    }

    /**
     * Shows the toaster with a message
     * @param {string} message - Text to show in the toaster
     */
    function showToaster(message) {
        // Selecting the toaster element
        const messageSuccess = document.querySelector('#action-message');

        // Setting toaster message
        messageSuccess.MaterialSnackbar.showSnackbar({
            message: message
        });
    }

})();
