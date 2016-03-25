<html>
<head>

  <link rel="stylesheet" href="../css/ttu.css" />

  <style>
    .removeButton:hover {
      cursor: pointer;
    }
  </style>

</head>
<body>
  <?php

    require_once('../inc/config.php');
    require_once('../inc/db.php');

    // Overall if statement to determine if the form as been submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Captcha code
      $gRecaptchaResponse = $_POST['g-recaptcha-response'];
      require('/comc/includes/autoload.php');
      $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
      $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
      $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
      $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

      $password = strtolower($_POST['password']);

      // If captcha is successful
      if ($resp->isSuccess() && $password == 'morris2016') {

        /*---Variables-------------------------------------*/
        // Title
        $morris = 'Morris Lectureship 2016';

        // Invitee's Information
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $info = $_POST['info'];
        $eventID = 1;

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
            $gFirstName = $_POST['firstName_g' . $number];
            $gLastName = $_POST['lastName_g' . $number];
            $gEmail = $_POST['email_g' . $number];
            $gInfo = $_POST['info_g' . $number];

            // Push guest into $guests array
            array_push($guests, array($gFirstName, $gLastName, $gEmail, $gInfo));
          }

        }


        /*---Sending Info to DB-------------------------------------*/
        try {
          // Info for invitee
          $stmt = $db->prepare("
                                INSERT INTO people (first_name, last_name, email, event_id, info)
                                VALUES (:first_name, :last_name, :email, :event_id, :info)
                              ");
          $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
          $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':event_id', $eventID, PDO::PARAM_INT);
          $stmt->bindParam(':info', $info, PDO::PARAM_STR);
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
        $headers = "From: " . $firstName . " " . $lastName . " <rsvp.mcom@ttu.edu>\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "CC: kuhrt.cowan@ttu.edu\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $to = "rsvp.mcom@ttu.edu";

        $subject = $morris . " RSVP";

        // Message
        $message = '<html><body>';
        $message .= '<table width="100%" cellpadding="10">';
        $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $morris . " RSVP For " . $firstName . " " . $lastName . "</h1></td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Email:</strong></td><td>" . $email . "</td></tr>";
        $message .= "<tr><td><strong>Food Accommodations:</strong></td><td>" . $info . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><h2>Guests</h2></td><td><strong>Food Accommodations</strong></td></tr>";
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



        /*---Email to Applicant-------------------------------------*/
        $conf_headers = "From: The College of Media & Communication <rsvp.mcom@ttu.edu>\r\n";
        $conf_headers .= "Reply-To: rsvp.mcom@ttu.edu\r\n";
        $conf_headers .= "MIME-Version: 1.0\r\n";
        $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $conf_to = $email;
        $conf_subject = $morris . " RSVP Confirmation";

        // Message
        $conf_message = '<html><body>';
        $conf_message .= '<table width="100%" cellpadding="10">';
        $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>RSVP Confirmation For " . $morris . "</h1></td></tr>";
        $conf_message .= "<tr style='text-align:center;'><td><p>We have received your RSVP for the " . $morris . ". If you have any questions or need to change anything on your RSVP, please email Taryn Meixner at <a href='mailto:taryn.meixner@ttu.edu'>taryn.meixner@ttu.edu</a>. We look forward to seeing you there! Thanks again!</p></td></tr>";
        $conf_message .= "</table>";
        $conf_message .= "</body></html>";

        // Send Message
        mail($conf_to, $conf_subject, $conf_message, $conf_headers);
        ?>
  <h2 style="text-align: center; width: 100%;">We have recieved your rsvp!</h2>
  <p style="text-align: center;">You will recieve a confirmation email shortly. If you have any questions in the mean time, please email Taryn Meixner at <a href="mailto:taryn.meixner@ttu.edu">taryn.meixner@ttu.edu</a>. Thank you!</p>
  <?php


      } elseif ($password != 'morris2016') {

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
    <?php echo '<form class="ldpforms" method="post" action="' . $_SERVER['PHP_SELF'] . '">'; ?>
      <div id="people">
        <fieldset>
          <legend> Your Information </legend>
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
      <br /><br />
      <div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div>
      <input class="button" type="submit" value="submit" />
      <div class="form-loader"></div>
    <?php echo '</form>'; ?> <?php }; ?>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" defer="defer" async=""></script>
  <script type="text/javascript">
  $(document).ready(function() {

        // Starting at guest 0, will append this number to the field names for db entries
        var guestNumber = 0;
        // This will keep track of how many guests there are
        var guestTotal = 0;

        // add guest on addButton click
        $('.addButton').click(function(e){
          // Prevent default action
          e.preventDefault();
          // Increment guest number, this will always increment so we don't have repeats
          guestNumber++;
          // Increment guest total
          guestTotal++;
          // Add total to form field
          $('#guestCount').val(guestTotal);
          // Add form fields for the guest
          $('#people').append('<fieldset class="guest"><legend>Guest Information</legend><a class="removeButton">Remove</a><br /><br /><input type="hidden" name="guestNumber[]" readonly value="' + guestNumber + '" /><label for="firstName_g' + guestNumber + '">Name:</label><input type="text" id="firstName_g' + guestNumber + '" name="firstName_g' + guestNumber + '" required="required" placeholder="First Name" /><input type="text" id="lastName_g' + guestNumber + '" name="lastName_g' + guestNumber + '" required="required" placeholder="Last Name" /><br /><br /><label for="email_g' + guestNumber + '">Email:</label><input type="email" id="email_g' + guestNumber + '" name="email_g' + guestNumber + '" required="required" /><br /><br /><label for="foodAccommodations_g' + guestNumber + '">Food Accommodations:</label><textarea id="foodAccommodations_g' + guestNumber + '" name="info_g' + guestNumber + '"></textarea></fieldset>');
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
</script>
</body>
</html>
