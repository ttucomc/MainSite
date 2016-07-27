<?php

/*
Texas Tech University
College Of Media and Communications
5/12/16
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect to DB
require("db.php");
require("model/Opportunity.php");


//Get the user type



//If user is admin, show admin options



//Display and set admin options.



//If user, display all jobs with information about each.
$opportunities = Opportunity::getActiveOpportunities($db);

?>

<!-- DONT INLUDE HTML TAGS FOR LIVE PAGE -->
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Vendor Imports -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <link rel="stylesheet" type="text/css" href="/comcsite/css/ttu.css">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-red.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" type="text/css" href="./css/styles.css" />


</head>

<body>
<section id="head">

  <div class="title">
    <h1>Master's Opportunities</h1>
  </div>


  <a href="admin/">
    <div class="admin mdl-shadow--4dp">
      <h2>Update Opportunities</h2>
    </div>
  </a>

</section>

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

    <div class='cardContainer large-4 columns'>
      <div class="card mdl-shadow--4dp">
        <div class="header">
          <h3><?php echo $value["jobName"] ?></h3>
        </div>
        <div class="body">

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
      </div>
    </div>


    <?php } ?>
  </div>


</section>

<script>

  $('.admin').hover(
    function() {
      $(this).removeClass("mdl-shadow--4dp");
      $(this).addClass("mdl-shadow--8dp");
    }, function() {
      $(this).removeClass("mdl-shadow--8dp");
      $(this).addClass("mdl-shadow--4dp");
    }
  );

</script>


</body>
</html>
<!-- DONT INLUDE HTML TAGS FOR LIVE PAGE -->
