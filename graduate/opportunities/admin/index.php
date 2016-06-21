<?php

/*

Texas Tech University
College Of Media and Communications
6/6/16

*/



?>


<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Vendor Imports -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <link rel="stylesheet" type="text/css" href="../css/foundation.css">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-red.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="../css/styles.css" />

</head>

<body>
<section id="admin-header">

  <div class="title">
    <h1>Manage Opportunities</h1>
  </div>

</section>

<div id="admin-edit">

  <!-- Start Tighten -->
  <div class="row tighten">

    <div class="large-4 columns">
      <form action="#">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="sort-text">
          <label class="mdl-textfield__label" for="sort-text">Sort by Opportunity Title</label>
        </div>
      </form>
    </div>

    <div class="large-4 columns">
      <form action="#">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="sort-text">
          <label class="mdl-textfield__label" for="sort-text">Sort by Date</label>
        </div>
      </form>
    </div>

    <div class="large-4 columns">
      <button id="create" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Create Opportunity</button>
    </div>

    <div class="clearfix"/></div>

  </div>
  <!-- End Tighten -->
  <div class="row ">

    <div class="large-4 columns">
      <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text">Web Developer</h2>
        </div>

        <h4 class="card-title">Description</h4>
        <div class="card-text">Web Development Internship</div>
        <div class='card-text'>06/20/2016</div>
        <br />
        <div class="mdl-card__actions mdl-card--border"></div>
        <h4 class="card-title">Company</h4>
        <div class="card-text">College of Media and Commnication</div>
        <br />
        <div class="mdl-card__actions mdl-card--border"></div>
        <h4 class="card-title">Contact</h4>
        <div class="card-text">Kuhrt Cowan</div>
        <div class="card-text">806.789.5172</div>
        <div class="card-text">kuhrt.cowan@ttu.edu</div>
        <br />

        <div class="mdl-card__menu">
          <!-- Left aligned menu below button -->
          <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
          </button>

          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
              for="demo-menu-lower-right">
            <li id="" class="mdl-menu__item">Edit Opportunity</li>
            <li id="" class="mdl-menu__item">Delete Opportunity</li>
          </ul>
        </div>
      </div>
    </div>

  </div>

</div>

<div id="overlay">
  <div class="background">
    <h3>Create Opportunity</h3>
    <form id="create_opportunity">
      <h4 class="card-title">Job</h4>
      <!-- Job -->
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="job_name" name="job_name">
        <label class="mdl-textfield__label" for="job_name">Job Name</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="job_position" name="job_position">
        <label class="mdl-textfield__label" for="job_position">Job Position</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="job_description" name="job_description">
        <label class="mdl-textfield__label" for="job_description">Job Description</label>
      </div>
      <br />
      <div class="select_job">
        <label for="jobtype">Job Type: </label>
        <select id="jobtype" name="jobtype">
          <option value="full">Full Time</option>
          <option value="part">Part Time</option>
          <option value="paid">Paid Internship</option>
          <option value="unpaid">Unpaid Internship</option>
        </select>
      </div>
      <br />
      <div class="date">
        <label for="start_date">Start Date</label>
        <br />
        <input id="start_date" type="date" name="start_date"/>
      </div>
      <div class="date">
        <label for="end_date">End Date</label>
        <br />
        <input id="end_date" type="date" name="end_date"/>
      </div>

      <!-- Company -->
      <br />
      <h4 class="card-title">Company</h4>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="company_name" name="company_name">
        <label class="mdl-textfield__label" for="company_name">Company Name</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="company_city" name="company_city">
        <label class="mdl-textfield__label" for="company_city">City</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="company_state" name="company_state">
        <label class="mdl-textfield__label" for="company_state">State</label>
      </div>

      <!-- Contact -->
      <h4 class="card-title">Contact</h4>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="contact_first_name" name="contact_first_name">
        <label class="mdl-textfield__label" for="contact_first_name">First Name</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="contact_last_name" name="contact_last_name">
        <label class="mdl-textfield__label" for="contact_last_name">Last Name</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="company_phone" name="company_phone">
        <label class="mdl-textfield__label" for="company_phone">Contact Phone Number</label>
      </div>
      <br />
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="company_email" name="company_email">
        <label class="mdl-textfield__label" for="company_email">Contact Email</label>
      </div>

      <br />
      <button id="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Submit</button>
    </form>

    <div id="close">Close</div>
  </div>
</div>



<script>


  $( "#create" ).click(function() {
    $( "#overlay" ).toggle();
  });

  $( "#close" ).click(function() {
    $( "#overlay" ).toggle();
  });

  $( "#create_opportunity" ).submit(function(event) {
    event.preventDefault();
    //console.log( $(this).serialize() );

    $.post("create.php", $('#create_opportunity').serialize())

    .done(function( data ) {
        console.log( data );
    });
  });


</script>



</body>
</html>
<!-- DONT INLUDE HTML TAGS FOR LIVE PAGE -->
