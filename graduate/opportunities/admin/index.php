<?php

/*

Texas Tech University
College Of Media and Communications
6/6/16

*/


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect to DB
require("../db.php");
require("../model/Opportunity.php");


$opportunities = Opportunity::getActiveOpportunities($db);

?>

<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Vendor Imports -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <link rel="stylesheet" type="text/css" href="/comcsite/css/ttu.css">
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

    <div class="large-4 large-offset-4 columns">
      <button id="create" class="create mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Create Opportunity</button>
    </div>

    <div class="clearfix"/></div>

  </div>
  <!-- End Tighten -->

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


<section id="opportunities">
  <div class="row">

  <?php

  $count = 0;

  foreach ($opportunities as $key => $value) {

    if($count % 3 == 0) {
      echo '</div><div class="row">';
    }

    $count++;

    ?>

    <div id="card_<?php echo $value["id"] ?>" class='cardContainer large-4 columns'>

      <div id="json_<?php echo $value["id"] ?>" style="display: none">
        <?php echo json_encode($value); ?>
      </div>

      <div class="card mdl-shadow--4dp">
        <div class="header">
          <!-- Right aligned menu below button -->
          <button id="demo-menu-lower-right-<?php echo $count ?>"
                  class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
          </button>

          <ul class="mdl-menu mdl-menu--bottom-right-<?php echo $count ?> mdl-js-menu mdl-js-ripple-effect"
              for="demo-menu-lower-right-<?php echo $count ?>">
            <li class="mdl-menu__item" onclick="editOpportunity(<?php echo $value["id"] ?>)">Edit Opportunity</li>
            <li class="mdl-menu__item" onclick="deleteOpportunity(<?php echo $value["id"] ?>)">Delete Opportunity</li>
          </ul>

          <h3><?php echo $value["jobName"] ?></h3>
        </div>
        <div id="body_<?php echo $value["id"] ?>" class="body">

          <h4>Description</h4>
          <div class='desc'><?php echo $value["jobPosition"] ?></div>
          <div class='desc'><?php echo $value["description"] ?></div>


          <?php if(isset($value["startDate"]) && !empty($value["startDate"])) { ?>
            <div class='desc'>Start: <?php

              $date = new DateTime($value["startDate"]);
              echo $date->format('m/d/Y'); //Month/Day/Year

            ?></div>
          <?php } ?>

          <?php if(isset($value["endDate"]) && !empty($value["endDate"])) { ?>
            <div class='desc'>End: <?php

              $date = new DateTime($value["endDate"]);
              echo $date->format('m/d/Y'); //Month/Day/Year

            ?></div>
          <?php } ?>

          <h4>Company</h4>
          <div class='desc'><?php echo $value["companyName"] ?></div>
          <div class='desc'><?php echo $value["city"] . ", " . $value["state"] ?></div>

          <div class="footer">
            <h4>Contact</h4>
            <div><?php echo $value["firstName"] . " " . $value["lastName"] ?></div>
            <div><?php echo $value["phone"] ?></div>
            <div><?php echo $value["email"] ?></div>
          </div>
        </div>

        <div id="edit_<?php echo $value["id"] ?>" style="display:none;">
          <form id="edit_opportunity">
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
        </div>
      </div>
    </div>


    <?php } ?>
  </div>


</section>




<div id="snackbar_deleted" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>


<script>


  $( "#create" ).click(function() {
    $( "#overlay" ).fadeToggle();
  });

  $( "#close" ).click(function() {
    $( "#overlay" ).fadeToggle('fast');
  });

  $( "#create_opportunity" ).submit(function(event) {
    event.preventDefault();
    //console.log( $(this).serialize() );

    $.post("create.php", $('#create_opportunity').serialize())

    .done(function( data ) {
        console.log( data );
        $("#overlay").toggle();
    });
  });

  //If the user is editing an opportunity
  function editOpportunity(id) {


    $("#body_" + id).fadeToggle();
    $("#edit_" + id).fadeToggle();



  }

  function deleteOpportunity(id) {

    var snackbarContainer = document.querySelector('#snackbar_deleted');

    $.post("delete.php", { id: id })

    .done(function( data ) {
        //console.log( data );

        if(data == "true") {
          //console.log('it worked');

          $('#card_' + id).fadeToggle();

          var data = {
            message: 'Opportunity has been deleted.',
            timeout: 2000
          };
          snackbarContainer.MaterialSnackbar.showSnackbar(data);

        } else {
          //console.log('broken');

          var data = {
            message: 'Something went wrong, try refreshing the browser.',
            timeout: 2000
          };
          snackbarContainer.MaterialSnackbar.showSnackbar(data);

        }
    });

  }


</script>



</body>
</html>
<!-- DONT INLUDE HTML TAGS FOR LIVE PAGE -->
