<?php

  require_once('../admin/inc/config.php');
  require_once('../admin/inc/db.php');
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

    if(isset($_GET["id"])):

      $events = get_all_events();
      $thisEvent = get_one_event($_GET["id"]);

      // Overall if statement to determine if the form as been submitted or not
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Captcha code
        $gRecaptchaResponse = $_POST['g-recaptcha-response'];
        require('/comc/includes/autoload.php');
        $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
        $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
        $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

        $password = strtolower($thisEvent['password']);
        $passwordEntered = strtolower($_POST['password']);

        // If captcha is successful
        if ($resp->isSuccess() && $passwordEntered == $password) {

          /*---Variables-------------------------------------*/
          // Title
          $eventTitle = htmlspecialchars(trim($thisEvent['name']));

          // Invitee's Information
          $attending = $_POST['attending'];
          $firstName = trim($_POST['firstName']);
          $lastName = trim($_POST['lastName']);
          $email = trim($_POST['email']);

          if ($thisEvent['ID'] == 52) {
            $info = implode(", ", $_POST['info']);
          } else {
            $info = htmlspecialchars(trim($_POST['info']));
          }

          $eventID = $thisEvent['ID'];

          // Getting class excuse if the event is the Scholarship luncheon
          if (strtolower($thisEvent['name']) == 'scholarship luncheon') {
            $classExcuse = htmlspecialchars(trim($_POST['classExcuse']));
          }

          // Getting how many guests
          $guestCount = (int)$_POST['guestCount'];
          // Bool for if there's guests or not
          $areThereGuests = false;
          // Array with guest number for form names
          $guestNumbers = $_POST['guestNumber'];
          // 2-dimensional array that will hold the guests
          $guests = array();

          // If there are guests
          if ($guestCount > 0) {
            // Setting this to true
            $areThereGuests = true;

            // Create array item for each guest
            foreach ($guestNumbers as $key => $number) {
              $gFirstName = trim($_POST['firstName_g' . $number]);
              $gLastName = trim($_POST['lastName_g' . $number]);
              $gEmail = trim($_POST['email_g' . $number]);
              $gInfo = trim($_POST['info_g' . $number]);

              // Push guest into $guests array
              array_push($guests, array($gFirstName, $gLastName, $gEmail, $gInfo));
            }

          }


          /*---Checking if RSVP already exists-------------------------------------*/

          // Allows this email to be used multiple times for the event planner
          if (strtolower($email) != "rsvp.mcom@ttu.edu") {
            try {

              $stmt = $db->prepare("SELECT * FROM people WHERE email=:email AND event_id=:event_id");
              $stmt->bindParam(':email', $email, PDO::PARAM_STR);
              $stmt->bindParam(':event_id', $eventID, PDO::PARAM_INT);
              $stmt->execute();

              if($stmt->rowCount() > 0) {
                echo "<p>It looks like we already have an RSVP for you! If you need to change your RSVP or give any additional information, please email <a href='mailto:taryn.meixner@ttu.edu' class='mail'>Taryn Meixner</a> and she will get it taken care of for you!</p>";
                exit();
              }

            } catch (Exception $e) {
              echo "Couldn't check if they exist in the database";
              exit();
            }
          }



          /*---Sending Info to DB-------------------------------------*/
          try {
            // Info for invitee
            if (strtolower($thisEvent['name']) == 'scholarship luncheon') {
              $stmt = $db->prepare("
                                    INSERT INTO people (attending, first_name, last_name, email, event_id, info, sort1)
                                    VALUES (:attending, :first_name, :last_name, :email, :event_id, :info, :excuse)
                                  ");
            } else {
              $stmt = $db->prepare("
                                    INSERT INTO people (attending, first_name, last_name, email, event_id, info)
                                    VALUES (:attending, :first_name, :last_name, :email, :event_id, :info)
                                  ");
            }
            $stmt->bindParam(':attending', $attending, PDO::PARAM_INT);
            $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':event_id', $eventID, PDO::PARAM_INT);
            $stmt->bindParam(':info', $info, PDO::PARAM_STR);
            if (strtolower($thisEvent['name']) == 'scholarship luncheon') {
              $stmt->bindParam(':excuse', $classExcuse, PDO::PARAM_STR);
            }
            $stmt->execute();

            if ($areThereGuests) {
              // Getting hostID from the person that was just added
              $hostID = $db->lastInsertId();

              foreach ($guests as $key => $guest) {
                $gStmt = $db->prepare("
                                      INSERT INTO guests (host_id, first_name, last_name, email, event_id, info)
                                      VALUES (:host_id, :first_name, :last_name, :email, :event_id, :info)
                                    ");
                $gStmt->bindParam(':host_id', $hostID, PDO::PARAM_INT);
                $gStmt->bindParam(':first_name', $guest[0], PDO::PARAM_STR);
                $gStmt->bindParam(':last_name', $guest[1], PDO::PARAM_STR);
                $gStmt->bindParam(':email', $guest[2], PDO::PARAM_STR);
                $gStmt->bindParam(':event_id', $eventID, PDO::PARAM_INT);
                $gStmt->bindParam(':info', $guest[3], PDO::PARAM_STR);
                $gStmt->execute();
              }
            }
          } catch (Exception $e) {
            echo "Couldn't add information into database.";
            exit();
          }




          /*---Email to Event Coordinator-------------------------------------*/
          $headers = "From: " . $firstName . " " . $lastName . " <" . $email . ">\r\n";
          $headers .= "Reply-To: " . $email . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $to = "rsvp.mcom@ttu.edu";

          $subject = $eventTitle . " RSVP";

          // Message
          $message = '<html><body>';
          $message .= '<table width="100%" cellpadding="10">';
          if ($attending == 1) {
            $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $firstName . " " . $lastName . " is attending the " . $eventTitle . "</h1></td></tr>";
          } else {
            $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $firstName . " " . $lastName . " is not attending the " . $eventTitle . "</h1></td></tr>";
          }
          $message .= "<tr style='background: #EEEEEE;'><td><strong>Email:</strong></td><td>" . $email . "</td></tr>";
          $message .= "<tr><td><strong>Notes/Food Accommodations:</strong></td><td>" . nl2br($info) . "</td></tr>";
          if (strtolower(trim($thisEvent['name'])) == 'scholarship luncheon') {
            $message .= "<tr><td><strong>Class Excuses:</strong></td><td>" . nl2br($classExcuse) . "</td></tr>";
          }
          $message .= "<tr style='background: #EEEEEE;'><td><h2>Guests</h2></td><td><strong>Notes/Food Accommodations</strong></td></tr>";
          if ($areThereGuests) {
            foreach ($guests as $key => $guest) {
              $message .= "<tr><td>" . $guest[0] . " " . $guest[1] . " - <em>" . $guest[2] . "</td><td>" . $guest[3] . "</td></tr>";
            }
          } else {
            $message .= "<tr><td>None</td></tr>";
          }
          $message .= "</table>";
          $message .= "</body></html>";

          // Send Message
          mail($to, $subject, $message, $headers);


          /*---Email to RSVPer-------------------------------------*/
          $conf_headers = "From: The College of Media & Communication <rsvp.mcom@ttu.edu>\r\n";
          $conf_headers .= "Reply-To: rsvp.mcom@ttu.edu\r\n";
          $conf_headers .= "MIME-Version: 1.0\r\n";
          $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $conf_to = $email;
          $conf_subject = $eventTitle . " RSVP Confirmation";

          // Message
          $conf_message = '<html><body>';
          $conf_message .= '<table width="100%" cellpadding="10">';
          $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>RSVP Confirmation For " . $eventTitle . "</h1></td></tr>";
          $conf_message .= "<tr style='text-align:center;'><td><p>We have received your " . (($attending == 1)?"yes":"no") . " RSVP for the " . $eventTitle . ". If you have any questions or need to change anything on your RSVP, please email Taryn Meixner at <a href='mailto:taryn.meixner@ttu.edu'>taryn.meixner@ttu.edu</a>. Thanks again!</p></td></tr>";
          $conf_message .= "</table>";
          $conf_message .= "</body></html>";

          // Send Message
          mail($conf_to, $conf_subject, $conf_message, $conf_headers);
        ?>
      <h2 style="text-align: center; width: 100%;">We have recieved your rsvp!</h2>
      <p style="text-align: center;">You will recieve a confirmation email shortly. If you have any questions in the mean time, please email Taryn Meixner at <a href="mailto:taryn.meixner@ttu.edu">taryn.meixner@ttu.edu</a>. Thank you!</p>
      <?php

      } elseif ($passwordEntered != $password) {

      ?>
      <h2 style="text-align: center; width: 100%;">We're sorry! The password you entered is incorrect.</h2>
      <p style="text-align: center;">Please go back and enter in the correct password to rsvp. Thanks!</p>
      <?php

          } else {
            echo "<h1>Bummer! Something went wrong.</h1>";
            $errors = $resp->getErrorCodes();
            if (in_array("missing-input-response", $errors)) {
              echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.<br><br><a href=\"sponsor.php\">Go Back</a></p>";
            } else {
              echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to our <a href=\"mailto:kuhrt.cowan@ttu.edu\">webmaster</a> along with your message and we will get it taken care of. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
              foreach ($errors as $error) {
                echo "<li>" . $error . "</li>";
              }
              echo "</ul>";
            }
            exit();
          }

        } else {

    ?>

      <h2 class="event-name"><?php echo date('Y', strtotime($thisEvent['datetime'])) . ' ' . $thisEvent['name']; ?></h2>

      <?php if ($thisEvent['ID'] == 52): ?>
        <p>
          <?php echo nl2br($thisEvent['description']); ?>
        </p><br />
      <?php endif; ?>

      <?php if (strtolower(trim($thisEvent['name'])) == 'scholarship luncheon'): ?>
        <p>
          Students are only allowed to bring two guests for free. Any more than two will cost $20.00 per guest.
        </p>
      <?php endif; ?>

      <?php echo '<form class="ldpforms" method="post" action="' . $_SERVER['PHP_SELF'] . '?id=' . $thisEvent['ID'] . '">'; ?>
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
            <?php if ($thisEvent['ID'] == 52): ?>
              <label for="foodAccommodations">When will you be joining us?</label>
              <label><input type="checkbox" name="info[]" value="11:30" /> 11:30 a.m &mdash; <em>Lunch</em></label>
              <label><input type="checkbox" name="info[]" value="12:00" /> Noon - 12:50 p.m. &mdash; <em>"Skills Employers Are Looking For"</em></label>
              <label><input type="checkbox" name="info[]" value="1:00" /> 1 p.m. - 1:50 p.m. &mdash; <em>"Behance Demo"</em></label>
              <label><input type="checkbox" name="info[]" value="1:30" /> 1:30 p.m. &mdash; <em>Lunch</em></label>
              <label><input type="checkbox" name="info[]" value="2:00" /> 2 p.m. - 2:50 p.m. &mdash; <em>"Skills Employers Are Looking For" (Repeat Session)</em></label>
              <label><input type="checkbox" name="info[]" value="3:00" /> 3 p.m. - 3:50 p.m. &mdash; <em>"Behance Demo" (Repeat Session)</em></label>
            <?php else: ?>
              <label for="foodAccommodations">Notes/Food Accommodations:</label>
              <textarea id="foodAccommodations" name="info"></textarea>
            <?php endif; ?>
          </fieldset>
          <?php if (strtolower(trim($thisEvent['name'])) == 'scholarship luncheon'): ?>
            <fieldset>
              <legend>
                Class Excuse
              </legend>
              <p>
                For students that need a class excuse to attend the event. Please give us the <em>name of your professor</em>, <em>the class</em>, and <em>time of the class</em>. Please list each class you need an excuse for on seperate lines.
              </p>
              <textarea id="classExcuse" name="classExcuse" placeholder="Name of professor, class name and time of the class."></textarea>
            </fieldset>
          <?php endif; ?>
        </div>
        <?php if($thisEvent['allow_guests'] == 1): ?>
          <button class="button addButton">Add Guest</button>
          <input id="guestCount" type="hidden" readonly="readonly" value="0" name="guestCount" />
        <?php endif; ?>
        <br />
        <?php if ($thisEvent['ID'] == 52): ?>
          <input type="hidden" id="password" name="password" value="" />
        <?php else: ?>
          <label for="password">Password (<em>This is in your invitation. Leave blank if there was no invitation.</em>)</label>
          <input id="password" type="text" name="password" />
        <?php endif; ?>
        <?php echo '<input id="event-id" type="hidden" name="event-id" value="' . $thisEvent['ID'] . '" />'; ?>
        <div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div>
        <input class="button" type="submit" value="submit" />
        <div class="form-loader"></div>
      <?php echo '</form>'; ?>

      <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" defer="defer" async=""></script>
      <script type="text/javascript">
      $(document).ready(function() {

        // Starting at guest 0, will append this number to the field names for db entries
        var guestNumber = 0;
        // This will keep track of how many guests there are
        var guestTotal = 0;
        // Name of the event
        var eventName = $('h2.event-name').text().substring(5);

        // add guest on addButton click
        $('.addButton').click(function(e){
          // Prevent default action
          e.preventDefault();
          // Increment guest number, this will always increment so we don't have repeats
          guestNumber++;
          // Increment guest total
          guestTotal++;
          // Alerting for more than 2 guests if scholarship luncheon
          if (guestTotal > 2 && eventName.toLowerCase() == "scholarship luncheon") {
            alert("Students are only allowed to bring two guests for free. Any more than two will cost $20.00 per guest.");
          }
          // Add total to form field
          $('#guestCount').val(guestTotal);
          // Add form fields for the guest
          $('#people').append('<fieldset class="guest"><legend>Guest Information</legend><a class="removeButton">Remove</a><br /><br /><input type="hidden" name="guestNumber[]" readonly value="' + guestNumber + '" /><label for="firstName_g' + guestNumber + '">Name:</label><input type="text" id="firstName_g' + guestNumber + '" name="firstName_g' + guestNumber + '" required="required" placeholder="First Name" /><input type="text" id="lastName_g' + guestNumber + '" name="lastName_g' + guestNumber + '" required="required" placeholder="Last Name" /><br /><br /><label for="email_g' + guestNumber + '">Email:</label><input type="email" id="email_g' + guestNumber + '" name="email_g' + guestNumber + '" required="required" /><br /><br /><label for="foodAccommodations_g' + guestNumber + '">Notes/Food Accommodations:</label><textarea id="foodAccommodations_g' + guestNumber + '" name="info_g' + guestNumber + '"></textarea></fieldset>');
        });

        // Remove guest on removeButton click
        $('#people').on('click', '.removeButton', function() {
          // Removes the fieldset/guest this button is in
          $(this).parent().remove();
          // Decrement guest total
          guestTotal--;
          // Add total to form field
          $('#guestCount').val(guestTotal);
        });

      });

      function showRSVP(str) {
        if (str == "") {

        } else {
          window.location.href = window.location.pathname+"?id="+str;
        }
      }
      </script>

    <?php } ?>
  <?php else: ?>

    <?php

      $events = get_all_events();

    ?>

    <h2>Please Select an Event</h2>

    <form id="select-event">
      <?php

      // Creating select element
      echo "<select class='mdl-selectfield' onchange='showRSVP(this.value)'><option value=''>-- Change Event --</option>";

      // Adding each event as an option
      foreach ($events as $event) {
        if ($event['listed'] == 1 && $event['rsvps'] == 1 && strtotime($event['rsvp_date']) >= time()) {
          echo "<option value='" . $event['ID'] . "'>". date('Y', strtotime($event['datetime'])) . " " . $event['name'] . "</option>";
        }
      }
      echo "</select>";


      ?>
    </form>

    <script>

      function showRSVP(str) {
        if (str == "") {

        } else {
          window.location.href = window.location.pathname+"?id="+str;
        }
      }

    </script>

  <?php endif; ?>


</body>
</html>
