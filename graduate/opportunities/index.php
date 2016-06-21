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
require("model/db.php");
require("model/Company.php");


//Get the user type



//If user is admin, show admin options



//Display and set admin options.



//If user, display all jobs with information about each.




?>

<!-- DONT INLUDE HTML TAGS FOR LIVE PAGE -->
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Vendor Imports -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <link rel="stylesheet" type="text/css" href="./css/foundation.css">
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

    <div class='cardContainer large-4 columns'>
      <div class="card mdl-shadow--4dp">
        <div class="header">
          <h3>Web Developer</h3>
        </div>
        <div class="body">

          <h4>Description</h4>
          <div class='desc'>Web Development Internship</div>
          <div class='desc'>06/20/2016</div>

          <h4>Company</h4>
          <div class='desc'>Texas Tech University</div>
          <div class='desc'>College of Media and Commnication</div>

          <div class="footer">
            <h4>Contact</h4>
            <div>Kuhrt Cowan</div>
            <div>806.789.5172</div>
            <div>kuhrt.cowan@ttu.edu</div>
          </div>
        </div>
      </div>
    </div>

    <div class='cardContainer large-4 columns'>
      <div class="card mdl-shadow--4dp">
        <div class="header">
          <h3>Web Developer</h3>
        </div>
        <div class="body">

          <h4>Description</h4>
          <div class='desc'>Web Development Internship</div>

          <h4>Company</h4>
          <div class='desc'>Texas Tech University</div>
          <div class='desc'>College of Media and Commnication</div>

          <div class="footer">
            <h4>Contact</h4>
            <div>Kuhrt Cowan</div>
            <div>806.789.5172</div>
            <div>kuhrt.cowan@ttu.edu</div>
          </div>
        </div>
      </div>
    </div>

    <div class='cardContainer large-4 columns'>
      <div class="card mdl-shadow--4dp">
        <div class="header">
          <h3>Web Developer</h3>
        </div>
        <div class="body">

          <h4>Description</h4>
          <div class='desc'>Web Development Internship</div>

          <h4>Company</h4>
          <div class='desc'>Texas Tech University</div>
          <div class='desc'>College of Media and Commnication</div>

          <div class="footer">
            <h4>Contact</h4>
            <div>Kuhrt Cowan</div>
            <div>806.789.5172</div>
            <div>kuhrt.cowan@ttu.edu</div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class='cardContainer large-4 columns'>
      <div class="card mdl-shadow--4dp">
        <div class="header">
          <h3>Web Developer</h3>
        </div>
        <div class="body">

          <h4>Description</h4>
          <div class='desc'>Web Development Internship</div>

          <h4>Company</h4>
          <div class='desc'>Texas Tech University</div>
          <div class='desc'>College of Media and Commnication</div>

          <div class="footer">
            <h4>Contact</h4>
            <div>Kuhrt Cowan</div>
            <div>806.789.5172</div>
            <div>kuhrt.cowan@ttu.edu</div>
          </div>
        </div>
      </div>
    </div>
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
