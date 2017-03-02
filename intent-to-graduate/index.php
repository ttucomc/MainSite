<?php
require_once('inc/config.php');
require_once('inc/db.php');

    // Overall if statement to determine if the form as been submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      // Captcha code
      $gRecaptchaResponse = $_POST['g-recaptcha-response'];
      require('/comc/includes/autoload.php');
      $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
      $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
      $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
      $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

      // If captcha is successful
      if ($resp->isSuccess()) {

        /*---Variables-------------------------------------*/
        // Graduation Information
        $firstName = trim($_POST['firstName']);
        $middleName = trim($_POST['middleName']);
        $lastName = trim($_POST['lastName']);
        $rNumber = $_POST['rNumber'];
        $email = trim($_POST['email']);
        $phone = trim($_POST['phoneNumber']);
        $gender = $_POST['gender'];
        $graduationMonth = $_POST['graduationMonth'];
        $graduationYear = $_POST['graduationYear'];
        $major = $_POST['major'];
        $minor = trim($_POST['minor']);
        $concentration = trim($_POST['concentration']);
        $diplomaAddress = trim($_POST['diplomaAddress']);
        $diplomaCity = trim($_POST['diplomaCity']);
        $diplomaState = trim($_POST['diplomaState']);
        $diplomaZip = $_POST['diplomaZip'];
        $localAddress = trim($_POST['localAddress']);
        $localCity = trim($_POST['localCity']);
        $localState = trim($_POST['localState']);
        $localZip = $_POST['localZip'];
        $hometown = trim($_POST['hometown']);



        /*---Sending Info to DB-------------------------------------*/
        try {
          // Info for graduate
          $stmt = $db->prepare("
                                INSERT INTO intent_to_graduate (first_name, middle_name, last_name, r_number, email, cellphone_number, gender, graduation_month, graduation_year, major, minor, concentration, mailing_address, mailing_city, mailing_state, mailing_zipcode, local_address, local_city, local_state, local_zipcode, hometown)
                                VALUES (:first_name, :middle_name, :last_name, :r_number, :email, :cellphone_number, :gender, :graduation_month, :graduation_year, :major, :minor, :concentration, :mailing_address, :mailing_city, :mailing_state, :mailing_zipcode, :local_address, :local_city, :local_state, :local_zipcode, :hometown)
                              ");

          $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
          $stmt->bindParam(':middle_name', $middleName, PDO::PARAM_STR);
          $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
          $stmt->bindParam(':r_number', $rNumber, PDO::PARAM_INT);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':cellphone_number', $phone, PDO::PARAM_INT);
          $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
          $stmt->bindParam(':graduation_month', $graduationMonth, PDO::PARAM_INT);
          $stmt->bindParam(':graduation_year', $graduationYear, PDO::PARAM_INT);
          $stmt->bindParam(':major', $major, PDO::PARAM_STR);
          $stmt->bindParam(':minor', $minor, PDO::PARAM_STR);
          $stmt->bindParam(':concentration', $concentration, PDO::PARAM_STR);
          $stmt->bindParam(':mailing_address', $diplomaAddress, PDO::PARAM_STR);
          $stmt->bindParam(':mailing_city', $diplomaCity, PDO::PARAM_STR);
          $stmt->bindParam(':mailing_state', $diplomaState, PDO::PARAM_STR);
          $stmt->bindParam(':mailing_zipcode', $diplomaZip, PDO::PARAM_INT);
          $stmt->bindParam(':local_address', $localAddress, PDO::PARAM_STR);
          $stmt->bindParam(':local_city', $localCity, PDO::PARAM_STR);
          $stmt->bindParam(':local_state', $localState, PDO::PARAM_STR);
          $stmt->bindParam(':local_zipcode', $localZip, PDO::PARAM_INT);
          $stmt->bindParam(':hometown', $hometown, PDO::PARAM_STR);
          $stmt->execute();

        } catch (Exception $e) {
          echo "Couldn't add information into database.\n";
          exit();
        }



        /*---Email to Advising-------------------------------------*/
        $headers = "From: " . $firstName . " " . $lastName . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        switch ($major) {
            case 'Advertising':
                $to = "carly.carthel@ttu.edu";
                break;

            case 'Communication Studies':
                $to = "judy.poffenbarger@ttu.edu";
                break;

            case 'Electronic Media and Communications':
                $to = "donald.ellis@ttu.edu";
                break;

            case 'Journalism':
                $to = "heath.tolleson@ttu.edu";
                break;

            case 'Media Strategies':
                $to = "rose.cruz@ttu.edu";
                break;

            case 'Public Relations':
                $to = "kim.bergan@ttu.edu";
                break;

            default:
                $to = "julia.heard@ttu.edu";
                break;
        }

        $subject = "Intent to Graduate";

        // Message
        $message = '<html><body>';
        $message .= '<table width="100%" cellpadding="10">';
        $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $firstName . " " . $middleName . " " . $lastName . "</h1><h2>Intent to Graduate</h2></td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>R Number:</strong></td><td>" . $rNumber . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong></td><td>" . $email . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Cellphone Number:</strong></td><td>" . $phone . "</td></tr>";
        $message .= "<tr><td><strong>Gender:</strong></td><td>" . $gender . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Graduation Date:</strong></td><td>" . $graduationMonth . "/" . $graduationYear . "</td></tr>";
        $message .= "<tr><td><strong>Major:</strong></td><td>" . $major . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Minor:</strong></td><td>" . $minor . "</td></tr>";
        $message .= "<tr><td><strong>Concentration:</strong></td><td>" . $concentration . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Mailing Address:</strong></td><td>" . $diplomaAddress . "<br />" . $diplomaCity . ", " . $diplomaState . " " . $diplomaZip . "</td></tr>";
        $message .= "<tr><td><strong>Local Address:</strong></td><td>" . $localAddress . "<br />" . $localCity . ", " . $localState . " " . $localZip . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Hometown:</strong></td><td>" . $hometown . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        // Send Message
        mail($to, $subject, $message, $headers);


        /*---Email to Graduate-------------------------------------*/
        $conf_headers = "From: The College of Media & Communication <comc@ttu.edu>\r\n";
        $conf_headers .= "Reply-To: College of Media & Communication <" . $to . ">\r\n";
        $conf_headers .= "MIME-Version: 1.0\r\n";
        $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $conf_to = $email;
        $conf_subject = "Intent to Graduate Confirmation";

        // Message
        $conf_message = '<html><body>';
        $conf_message .= '<table width="100%" cellpadding="10">';
        $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>Intent to Graduate Confirmation</h1></td></tr>";
        $conf_message .= "<tr style='text-align:center;'><td><p>We have received your Intent to Graduate from CoMC. If you have any questions or need to change anything, please email Julia Heard at <a href='mailto:julia.heard@ttu.edu'>julia.heard@ttu.edu</a>. Thank you!</p></td></tr>";
        $conf_message .= "</table>";
        $conf_message .= "</body></html>";

        // Send Message
        mail($conf_to, $conf_subject, $conf_message, $conf_headers);
      ?>
    <h2 style="text-align: center; width: 100%;">We have recieved your Intent to Graduate!</h2>
    <p style="text-align: center;">You will recieve a confirmation email shortly. If you have any questions in the mean time, please email Julia Heard at <a href="mailto:julia.heard@ttu.edu">julia.heard@ttu.edu</a>. Thank you!</p>
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

      } else { // This closes if request is POST statement

  ?>
    <h2>Bachelor of Arts</h2>
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
          <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="123-456-7890" />
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
            <option value=''>-- Select Month --</option>
            <option value='5'>May</option>
            <option value='8'>August</option>
            <option value='12'>December</option>
          </select>
          <?php
          echo "<select id=\"graduationYear\" name=\"graduationYear\">";
            echo "<option value=\"\">-- Select Year --</option>";
            $i = 0;
            while ($i < 4) {
              $year = date('Y');
              $year += $i;

              echo "<option value=\"" . $year . "\">" . $year . "</option>";

              $i++;
            }
          echo "</select>";
          ?>
          <br />
          <br />
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
          <br />
          <br />
          <label for="hometown">Hometown (<em>For Commencement Program</em>):</label>
          <input type="text" id="hometown" name="hometown" />
        </fieldset>

      <div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div>
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
