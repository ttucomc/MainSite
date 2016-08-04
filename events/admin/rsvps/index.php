<?php

require_once('../inc/config.php');
require_once('../inc/functions.php');
require_once('/comc/events/admin/rsvps/include.php');

// Getting all events from db
$events = get_all_events();

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">

  <title>RSVPs of All Events Ever</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-amber.min.css" />
  <link rel="stylesheet" href="../css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

  <style>
    table caption {
      caption-side: bottom;
    }
  </style>
</head>
<body>
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/comc/">College of Media &amp; Communication</a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="/comc/events/">Events Page</a>
        <a class="mdl-navigation__link" href="/comc/events/admin/">Events Admin</a>
        <a class="mdl-navigation__link" href="/comc/events/admin/rsvps/">RSVPs</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">College of Media &amp; Communication</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/comc/events/">Events Page</a>
      <a class="mdl-navigation__link" href="/comc/events/admin/">Events Admin</a>
      <a class="mdl-navigation__link" href="/comc/events/admin/rsvps/">RSVPs</a>
    </nav>
  </div>
  <h1>RSVPs</h1>
  <form id="select-event">
    <?php

    // Creating select element
    echo "<select class='mdl-selectfield' onchange='showUser(this.value)'><option value=''>-- Select Event --</option>";

    // Adding each event as an option
    foreach ($events as $key => $event) {
      echo "<option value='" . $event[ID] . "'>". date('Y', strtotime($event['datetime'])) . " " . $event[name] . "</option>";
    }
    echo "</select>";


    ?>
  </form>
  <?php

  // IF id is set in the url, use it
  if (isset($_GET["id"])) {
    include ('../inc/rsvps.php'); ?>

    <script>
      $(document).ready(function() {
        sortIt();
      });
    </script>
  <?php

    } else {

  ?>
  <div id="rsvps">
    <p>Select an event to see all the RSVPs for that event!</p>
  </div>
  <?php } ?>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.core.min.js"></script>
  <script src="../js/filesaver.js"></script>
  <script src="../js/tableexport.js"></script>
  <script src="../js/jquery.tablesorter.min.js"></script>
  <script>

    function doit() {
      $("table").tableExport({
        bootstrap: false,
        formats: ["xlsx", "csv", "txt"]
      });
    }

    function sortIt() {
      $('#rsvp-list').tablesorter( {sortList: [[0,0]]} );
    }

  </script>

  <script>
    // Show event information based on selected event
    function showUser(str) {
        if (str == "") {
            document.getElementById("rsvps").innerHTML = "<p>Select an event for RSVP awesomeness!</p>";
            return;
        } else {
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
            xmlhttp.open("GET","<?php echo BASE_URL; ?>/inc/rsvps.php?id="+str,true);
            xmlhttp.send();
        }
    }
  </script>
</body>
</html>
