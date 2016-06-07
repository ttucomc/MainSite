<?php

  require_once('../admin/inc/config.php');
  require_once('../admin/inc/functions.php');

?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">

  <title>RSVP to Your Event</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-amber.min.css" />
  <link rel="stylesheet" href="../admin/css/screen.css" />

  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

</head>
<body>
  <?php

    if(isset($_GET["ID"])):

      $event = get_one_event($_GET["ID"]);

  ?>

  <form class="ldpforms" method="post" action="' . $_SERVER['PHP_SELF'] . '">
    <div id="people">
      <fieldset>
        <legend> Your Information </legend>
        <label for="attending">Will you be joining us?</label>
        <input type="radio" name="attending" value="1" required="required" />- Yes<br />
        <input type="radio" name="attending" value="0" />- No
        <br /><br />
        <label for="firstName">Name:</label>
        <input id="firstName" type="text" placeholder="First Name" required="required" name="firstName" />
        <input id="lastName" type="text" placeholder="Last Name" required="required" name="lastName" />
        <br /><br />
        <label for="email">Email:</label>
        <input id="email" type="email" required="required" name="email" />
        <br /><br />
        <label for="foodAccommodations">Food Accommodations:</label>
        <textarea id="foodAccommodations" name="info"></textarea>
      </fieldset>
    </div>
    <button class="button addButton">Add Guest</button>
    <input id="guestCount" type="hidden" readonly="readonly" value="0" name="guestCount" />
    <br /><br />
    <label for="password">Password (<em>This is in your invitation</em>)</label>
    <input id="password" type="text" required="required" name="password" />
    <input id="event-id" type="hidden" name="event-id" />
    <br /><br />
    <!-- <div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div> -->
    <input class="button" type="submit" value="submit" />
    <div class="form-loader"></div>
  </form>

  <?php else: ?>
  <?php endif; ?>

  ?>


</body>
</html>
