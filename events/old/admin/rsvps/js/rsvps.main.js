// Open add rsvp form when add event button is clicked
$('body').on('click', '#add-rsvp-btn', function() {
  $('#add-rsvp').fadeToggle('fast');
});

// Close add rsvp form when close button is clicked
$('#add-rsvp form .close-btn').click(function(event) {
  event.preventDefault();
  $('#add-rsvp').fadeToggle('fast');
});

// When the confirm add rsvp button is clicked
$('#add-rsvp-do').click(function(e) {
  // Preventing form from submitting
  e.preventDefault();

  var action = "add_rsvp";
  var attending = $("input[name=attending]:checked").val();
  var eventID = $("#add-event-id").val();
  var firstName = $("#add-first-name").val();
  var lastName = $("#add-last-name").val();
  var email = $("#add-email").val();
  var notes = $("#add-notes").val();

  show_loader();

  $.ajax({

    type: 'POST',
    url: '../inc/rsvpController.php',
    data: {
            'action': action,
            'attending': attending,
            'eventID': eventID,
            'firstName': firstName,
            'lastName': lastName,
            'email': email,
            'info': notes
          },
    success: function(data) {

      // Setting toaster message
      var messageSuccess = document.querySelector('#action-message');
      var messageData = {message: data};
      messageSuccess.MaterialSnackbar.showSnackbar(messageData);

      reload_rsvps(eventID);

    }

  }).done(function() {

    $('#add-rsvp').fadeToggle('fast');
    $('#add-rsvp form')[0].reset();
    hide_loader();

  });

});




// Open edit rsvp form when edit rsvp button is clicked
$('body').on('click', '.edit-rsvp-btn', function() {
  $('#edit-rsvp').fadeToggle('fast');
  // Getting rsvp id
  var rsvpID = $(this).closest(".rsvp-edit-btns").data('rsvp-id');
  // Setting the form's rsvp id
  $('#edit-rsvp-form #edit-rsvp-id').val(rsvpID);

  // Getting info out of the cells of the row
  var rsvpCells = $('#rsvp-list tbody tr[data-rsvp-id=' + rsvpID + ']')[0].cells;
  var currentAttending = rsvpCells[1].textContent;
  var currentFirstName = rsvpCells[2].textContent;
  var currentLastName = rsvpCells[3].textContent;
  var currentEmail = rsvpCells[4].textContent;
  var currentNotes = rsvpCells[5].textContent;
  // Trimming out edit and delete button code
  currentNotes = currentNotes.substring(0, currentNotes.length - 101);
  currentNotes = currentNotes.substring(9);

  // Adding current values to form
  if (currentAttending.toLowerCase() == 'no') {
    document.getElementById('edit-attending-y').parentNode.MaterialRadio.uncheck();
    document.getElementById('edit-attending-n').parentNode.MaterialRadio.check();
  } else {
    document.getElementById('edit-attending-n').parentNode.MaterialRadio.uncheck();
    document.getElementById('edit-attending-y').parentNode.MaterialRadio.check();
  }
  $('#edit-rsvp-form #edit-first-name').val(currentFirstName);
  $('#edit-rsvp-form #edit-first-name').parent('div').addClass('is-dirty');
  $('#edit-rsvp-form #edit-last-name').val(currentLastName);
  $('#edit-rsvp-form #edit-last-name').parent('div').addClass('is-dirty');
  $('#edit-rsvp-form #edit-email').val(currentEmail);
  $('#edit-rsvp-form #edit-email').parent('div').addClass('is-dirty');
  $('#edit-rsvp-form #edit-notes').val(currentNotes);
  $('#edit-rsvp-form #edit-notes').parent('div').addClass('is-dirty');



});

// Close edit rsvp form when close button is clicked
$('#edit-rsvp form .close-btn').click(function(event) {
  event.preventDefault();
  $('#edit-rsvp').fadeToggle('fast');
});


$("body").on('click', '#edit-rsvp-do', function() {
  event.preventDefault();

  show_loader();

  var action = "edit_rsvp";
  var attending = $("input[name=edit-attending]:checked").val();
  var eventID = $("#edit-event-id").val();
  var firstName = $("#edit-first-name").val();
  var lastName = $("#edit-last-name").val();
  var email = $("#edit-email").val();
  var notes = $("#edit-notes").val();
  // Gettin the event ID
  var eventID = $("#rsvp-list").data("event-id");
  // Getting the ID of the rsvp
  var rsvpID = $('body').find('#edit-rsvp-form #edit-rsvp-id').val();

  $.ajax({

    type: 'POST',
    url: '../inc/rsvpController.php',
    data: {
            'action': action,
            'rsvpID': rsvpID,
            'eventID': eventID,
            'attending': attending,
            'firstName': firstName,
            'lastName': lastName,
            'email': email,
            'info': notes
          },
    success: function(data) {

      // Setting toaster message
      var messageSuccess = document.querySelector('#action-message');
      var messageData = {message: data};
      messageSuccess.MaterialSnackbar.showSnackbar(messageData);

      reload_rsvps(eventID);

    }

  }).done(function() {

    $('#edit-rsvp').fadeToggle('fast');
    $('#edit-rsvp form')[0].reset();
    hide_loader();

  });



});





$("body").on('click', '.delete-rsvp-btn', function() {

  // Adding confirmation panel
  $('body').append('<div class="mdl-card mdl-shadow--6dp" id="confirm-delete"><h3>Are you sure?</h3><p>This will delete this persons rsvp and guests from the database</p><div class="mdl-card__actions mdl-card--border"><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--accent confirm-delete-btn"><i class="material-icons">delete</i></button><button class="mdl-button mdl-js-button mdl-button--icon mdl-button--primary clear-delete-btn"><i class="material-icons">clear</i></button></div></div>');
  $('#confirm-delete').fadeToggle('fast');

  // Closing confirmation panel if cancel is clicked
  $('.clear-delete-btn').click(function() {
    $('#confirm-delete').fadeToggle('fast', function() {
      $('#confirm-delete').remove();
    });
  });

  // Gettin the event ID
  var eventID = $("#rsvp-list").data("event-id");
  // Getting the ID of the rsvp
  var rsvpID = $(this).closest(".rsvp-edit-btns").data('rsvp-id');
  // Removing confimation box
  $('.confirm-delete-btn').click(function() {

    show_loader();
    // Removing confirmation panel
    $('#confirm-delete').fadeToggle('fast', function() {
      $('#confirm-delete').remove();
    });


    // Setting action to delete
    var action = 'delete_rsvp';

    $.ajax({
      type: 'POST',
      url: '../inc/rsvpController.php',
      data: {
              'action': action,
              'eventID': eventID,
              'rsvpID': rsvpID
            },
      success: function(data) {

        // Setting toaster message
        var messageSuccess = document.querySelector('#action-message');
        var messageData = {message: data};
        messageSuccess.MaterialSnackbar.showSnackbar(messageData);

        reload_rsvps(eventID);

      }
    }).done(function() {
      hide_loader();
    });
  });
});











// Reloads RSVP table for new data
function reload_rsvps(eventID) {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("rsvps").innerHTML = xmlhttp.responseText;
          sortIt();
      }
  };
  xmlhttp.open("GET","../inc/rsvps.php?id="+eventID,true);
  xmlhttp.send();
}


// Loader functions
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
