<?php

require_once('inc/config.php');
require_once('inc/db.php');

    // Overall if statement to determine if the form as been submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Captcha code
    //   $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    //   require('/comc/includes/autoload.php');
    //   $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
    //   $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
    //   $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
    //   $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

      // If captcha is successful
    //   if ($resp->isSuccess()) {

        /*---Variables-------------------------------------*/
        // Graduate's Information
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $rNumber = $_POST['rNumber'];
        $email = trim($_POST['email']);
        $hometown = trim($_POST['hometown']);
        $major = trim($_POST['major']);
        $major2 = trim($_POST['major2']);
        $minor = trim($_POST['minor']);

        // Graduation Information
        $graduationDate = $_POST['gradDate'];
        $attendingCeremony = $_POST['attendingCeremony'];
        $commencementPermission = $_POST['commencementPermission'];
        $receptionNumber = $_POST['receptionNumber'];

        // Diploma Information
        $diplomaName = trim($_POST['diplomaName']);
        $diplomaAddress = htmlspecialchars($_POST['diplomaAddress']);
        $jobLinedUp = $_POST['jobLinedUp'];



        /*---Sending Info to DB-------------------------------------*/
        try {
          // Info for graduate
          $stmt = $db->prepare("
                                INSERT INTO graduation_rsvp (graduation_date, r_number, first_name, last_name, email, major, major2, minor, hometown, reception_number_attending, attending_ceremony, commencement_permission, diploma_name, diploma_address, job_lined_up)
                                VALUES (:graduation_date, :r_number, :first_name, :last_name, :email, :major, :major2, :minor, :hometown, :reception_number_attending, :attending_ceremony, :commencement_permission, :diploma_name, :diploma_address, :job_lined_up)
                              ");
          $stmt->bindParam(':graduation_date', $graduationDate, PDO::PARAM_STR);
          $stmt->bindParam(':r_number', $rNumber, PDO::PARAM_INT);
          $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
          $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':major', $major, PDO::PARAM_STR);
          $stmt->bindParam(':major2', $major2, PDO::PARAM_STR);
          $stmt->bindParam(':minor', $minor, PDO::PARAM_STR);
          $stmt->bindParam(':hometown', $hometown, PDO::PARAM_STR);
          $stmt->bindParam(':reception_number_attending', $receptionNumber, PDO::PARAM_INT);
          $stmt->bindParam(':attending_ceremony', $attendingCeremony, PDO::PARAM_INT);
          $stmt->bindParam(':commencement_permission', $commencementPermission, PDO::PARAM_INT);
          $stmt->bindParam(':diploma_name', $diplomaName, PDO::PARAM_STR);
          $stmt->bindParam(':diploma_address', $diplomaAddress, PDO::PARAM_STR);
          $stmt->bindParam(':job_lined_up', $jobLinedUp, PDO::PARAM_INT);
          $stmt->execute();

        } catch (Exception $e) {
          echo "Couldn't add information into database. ", $e->getMessage(), "\n";
          exit();
        }



        /*---Email to Advising-------------------------------------*/
        $headers = "From: " . $firstName . " " . $lastName . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $to = "julia.heard@ttu.edu";

        $subject = "Graduation RSVP";

        // Message
        $message = '<html><body>';
        $message .= '<table width="100%" cellpadding="10">';
        $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $firstName . " " . $lastName . " Graduation RSVP</h1></td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>R Number:</strong></td><td>" . $rNumber . "</td></tr>";
        $message .= "<tr><td><strong>Non-TTU Email:</strong></td><td>" . $email . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Hometown:</strong></td><td>" . $hometown . "</td></tr>";
        $message .= "<tr><td><strong>Major:</strong></td><td>" . $major . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>2nd Major:</strong></td><td>" . $major2 . "</td></tr>";
        $message .= "<tr><td><strong>Minor:</strong></td><td>" . $minor . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Graduation Date:</strong></td><td>" . $graduationDate . "</td></tr>";
        $message .= "<tr><td><strong>Attending Commencement:</strong></td><td>" . (($attendingCeremony == 1) ? 'Yes' : 'No') . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Ceremony Permission:</strong></td><td>" . (($commencementPermission == 1) ? 'Yes' : 'No') . "</td></tr>";
        $message .= "<tr><td><strong>Number Attending Reception:</strong></td><td>" . $receptionNumber . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Diploma Name:</strong></td><td>" . $diplomaName . "</td></tr>";
        $message .= "<tr><td><strong>Diploma Address:</strong></td><td>" . nl2br($diplomaAddress) . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Has a job lined up:</strong></td><td>" . (($jobLinedUp == 1) ? 'Yes' : 'No') . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        // Send Message
        mail($to, $subject, $message, $headers);


        /*---Email to Graduate-------------------------------------*/
        $conf_headers = "From: The College of Media & Communication <comc@ttu.edu>\r\n";
        $conf_headers .= "Reply-To: Julia Heard <julia.heard@ttu.edu>\r\n";
        $conf_headers .= "MIME-Version: 1.0\r\n";
        $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $conf_to = $email;
        $conf_subject = "Graduation RSVP Confirmation";

        // Message
        $conf_message = '<html><body>';
        $conf_message .= '<table width="100%" cellpadding="10">';
        $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>RSVP Confirmation For Graduation</h1></td></tr>";
        $conf_message .= "<tr style='text-align:center;'><td><p>We have received your RSVP. If you have any questions or need to change anything on your RSVP, please email Julia Heard at <a href='mailto:julia.heard@ttu.edu'>julia.heard@ttu.edu</a>. Thank you!</p></td></tr>";
        $conf_message .= "</table>";
        $conf_message .= "</body></html>";

        // Send Message
        mail($conf_to, $conf_subject, $conf_message, $conf_headers);
      ?>
    <h2 style="text-align: center; width: 100%;">We have recieved your rsvp!</h2>
    <p style="text-align: center;">You will recieve a confirmation email shortly. If you have any questions in the mean time, please email Julia Heard at <a href="mailto:julia.heard@ttu.edu">julia.heard@ttu.edu</a>. Thank you!</p>
    <?php

        // } else {
        //   echo "<h1>Bummer! Something went wrong.</h1>";
        //   $errors = $resp->getErrorCodes();
        //   if (in_array("missing-input-response", $errors)) {
        //     echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.<br><br><a href=\"sponsor.php\">Go Back</a></p>";
        //   } else {
        //     echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to our <a href=\"mailto:kuhrt.cowan@ttu.edu\">webmaster</a> along with your message and we will get it taken care of. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
        //     foreach ($errors as $error) {
        //       echo "<li>" . $error . "</li>";
        //     }
        //     echo "</ul>";
        //   }
        //   exit();
        // }

      } else { // This closes if request is POST statement

  ?>

    <?php echo '<form class="ldpforms" method="post" action="' . $_SERVER['PHP_SELF'] . '">'; ?>
        <fieldset>
          <legend>
              Diploma Information
          </legend>
          <label for="firstName">Name (<em>Exactly how you want it on your diploma</em>):</label>
          <input id="firstName" type="text" placeholder="First Name" required="required" name="firstName" />
          <input id="middleName" type="text" placeholder="Middle Name" name="middleName" />
          <input id="lastName" type="text" placeholder="Last Name" required="required" name="lastName" />
          <br />
          <br />
          <label for="rNumber">R Number (<em>Number Only</em>):</label>
          <input type="number" id="rNumber" name="rNumber" required="required" />
          <br />
          <br />
          <label for="email">Email:</label>
          <input id="email" type="email" name="email" />
          <br />
          <br />
          <label for="phoneNumber">Cell Phone Number:</label>
          <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Format: 123-456-7890" />
          <br />
          <br />
          <label for="gender">Gender</label>
          <select id="gender" name="gender">
              <option value="">-- Please Select --</option>
              <option value="F">Female</option>
              <option value="M">Male</option>
          </select>
          <br />
          <br />
          <label for="graduationMonth">Graduation Date:</label>
          <select id="graduationMonth" name="graduationMonth">
            <option value=''>--Select Month--</option>
            <option selected value='1'>Janaury</option>
            <option value='2'>February</option>
            <option value='3'>March</option>
            <option value='4'>April</option>
            <option value='5'>May</option>
            <option value='6'>June</option>
            <option value='7'>July</option>
            <option value='8'>August</option>
            <option value='9'>September</option>
            <option value='10'>October</option>
            <option value='11'>November</option>
            <option value='12'>December</option>
          </select>
          <select id="graduationYear" name="graduationYear">
              <?php  ?>
          </select>
          <label for="major">Major:</label>
          <select id="major" name="major" required="required">
              <option value="">-- Please Select --</option>
              <option value="Advertising">Advertising</option>
              <option value="Communication Studies">Communication Studies</option>
              <option value="Electronic Media and Communications">Electronic Media and Communications</option>
              <option value="Journalism">Journalism</option>
              <option value="Media Strategies">Media Strategies</option>
              <option value="Public Relations">Public Relations</option>
          </select>
          <br />
          <br />
          <label for="minor">Minor:</label>
          <input type="text" id="minor" name="minor" />
          <br />
          <br />
          <label for="concentration">Concentration:</label>
          <input type="text" id="concentration" name="concentration" />
          <br />
          <br />
          <label for="diplomaAddress">Address For Mailing Diploma:</label>
          <input type="text" id="diplomaAddress" name="diplomaAddress" required="required" />
          <br />
          <label for="diplomaCity">City:</label>
          <input type="text" id="diplomaCity" name="diplomaCity" required="required" />
          <br />
          <label for="diplomaState">State:</label>
          <input type="text" id="diplomaState" name="diplomaState" required="required" />
          <br />
          <label for="diplomaZip">Zipcode:</label>
          <input type="number" id="diplomaZip" name="diplomaZip" required="required" />
          <br />
          <br />
          <label for="hometown">Hometown (<em>For Commencement Program</em>):</label>
          <input type="text" id="hometown" name="hometown" />
          <br />
          <br />
          <label for="localAddress">Local Address:</label>
          <input type="text" id="localAddress" name="localAddress" />
          <br />
          <label for="localCity">City:</label>
          <input type="text" id="localCity" name="localCity" />
          <br />
          <label for="localState">State:</label>
          <input type="text" id="localState" name="localState" />
          <br />
          <label for="localZip">Zipcode:</label>
          <input type="number" id="localZip" name="localZip" />

        </fieldset>

      <!-- <div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div> -->
      <input class="button" type="submit" value="submit" />
      <div class="form-loader"></div>
    <?php echo '</form>'; ?>

    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" defer="defer" async=""></script>
    <script type="text/javascript">

      // When the submit button is clicked
      $('form :submit').click(function () {
        // Making sure all require fields are filled
        var isValid = true;
        $('input[required="required"]').each(function() {
          if ( $(this).val() === '' )
          isValid = false;
        });

        // If required fields are filled
        if (isValid) {
          // Fading form
          $('form').fadeTo('fast', 0.4);
          // Showing loader next to button
          $('.form-loader').fadeTo('fast', 1);
          // Changing text in button
          $('form :submit').attr('value', 'Loading...');
        }
      });

    </script>

  <?php } ?>
