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
