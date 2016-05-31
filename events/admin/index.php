<?php

require_once('inc/config.php');
require_once('inc/functions.php');

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

  <style>
    table caption {
      caption-side: bottom;
    }
  </style>
</head>
<body>
  <h1>CoMC Events</h1>
  <p>
    <a href="rsvps/" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">See RSVPs</a>
  </p>


  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->

</body>
</html>
