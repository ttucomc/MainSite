<html>
<head>

  <meta name="title" content="Control of All Events Ever" />

  <link rel="stylesheet" href="../rsvp/css/ttu.css" />
</head>
<body>
  <form>
    <?php

    require_once('inc/config.php');
    require_once('inc/functions.php');

    $events = get_all_events();

    echo "<select onchange='showUser(this.value)'><option value=''>-- Select Event --</option>";

    foreach ($events as $key => $event) {
      echo "<option value='" . $event[ID] . "'>" . $event[name] . "</option>";
    }
    echo "</select>";


    ?>
  </form>
  <div id="rsvps">
    <p>
      Select an event and I bet the RSVPs list here
    </p>
  </div>



  <script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("rsvps").innerHTML = "";
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
                }
            };
            xmlhttp.open("GET","inc/rsvps.php?id="+str,true);
            xmlhttp.send();
        }
    }
  </script>
</body>
</html>
