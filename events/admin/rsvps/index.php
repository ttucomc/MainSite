<?php

require_once('../inc/config.php');
require_once('../inc/functions.php');

// Getting all events from db
$events = get_all_events();

?>
<html>
<head>

  <meta name="title" content="RSVPs of All Events Ever" />

  <link rel="stylesheet" href="../../rsvp/css/ttu.css" />
  <link rel="stylesheet" href="../css/screen.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

  <style>
    table caption {
      caption-side: bottom;
    }
  </style>
</head>
<body>
  <form>
    <?php

    // Creating select element
    echo "<select onchange='showUser(this.value)'><option value=''>-- Select Event --</option>";

    // Adding each event as an option
    foreach ($events as $key => $event) {
      echo "<option value='" . $event[ID] . "'>". $event[year] . " " . $event[name] . "</option>";
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
            xmlhttp.open("GET","../inc/rsvps.php?id="+str,true);
            xmlhttp.send();
        }
    }
  </script>
</body>
</html>
