<html>
<head>

  <meta name="title" content="Control of All Events Ever" />

  <link rel="stylesheet" href="../rsvp/css/ttu.css" />
</head>
<body>
  <?php

  require_once('inc/config.php');
  require_once('inc/functions.php');

  $invitees =  get_invitees(1);
  $guests = get_guests(1);



  ?>
  <pre>
    <?php

      $intersect = array_intersect_assoc($invitees, $guests);
      print_r($intersect);

    ?>
  </pre>

  <ol>
    <?php

      foreach ($invitees as $key => $invitee) {
        echo '<li>' . $invitee['first_name'] . ' ' . $invitee['last_name'];

        // foreach ($guests as $key => $guest) {
        //
        // }

        echo '</li>';
      }

    ?>
  </ol>



  <!-- <script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
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
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","getuser.php?q="+str,true);
            xmlhttp.send();
        }
    }
  </script> -->
</body>
</html>
