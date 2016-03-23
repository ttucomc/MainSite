<html>
<head>

  <link rel="stylesheet" href="../css/ttu.css" />

</head>
<body>
<?php

  require_once('../inc/config.php');
  require_once('../inc/db.php');

  // Overall if statement to determine if the form as been submitted or not
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captcha code
    // $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    // require('/comc/includes/autoload.php');
    // $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
    // $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
    // $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
    // $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
    //
    // // If captcha is successful
    // if ($resp->isSuccess()) {

    // Take this out and add it to reCaptcha if statement when we go live
    $password = strtolower($_POST['password']);
    if($password == 'morris2016'){

      /*---Variables-------------------------------------*/
      // Title
      $morris = 'Morris Lectureship RSVP';

      // Person's Information
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $email = $_POST['email'];
      $info = $_POST['info'];
      $eventID = 1;



      /*---Sending Info to DB-------------------------------------*/
      try {
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
      } catch (Exception $e) {
        echo "Couldn't add information into database.\r\n" . $e->getMessage();
        exit();
      }




      /*---Email to Approval Comittee-------------------------------------*/
      // $headers = "From: " . $startup . " <studentstartup.comc@ttu.edu>\r\n";
      // $headers .= "Reply-To: studentstartup.comc@ttu.edu\r\n";
      // $headers .= "CC: kuhrt.cowan@ttu.edu\r\n";
      // $headers .= "MIME-Version: 1.0\r\n";
      // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      //
      // $to = "geoffrey.graybeal@ttu.edu, studentstartup.comc@ttu.edu";
      //
      // $subject = "Startup Team Application";
      //
      // // Message
      // $message = '<html><body>';
      // $message .= '<table width="100%" cellpadding="10">';
      // $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>Student Startup Application For " . $projectTitle . "</h1></td></tr>";
      // $message .= "<tr style='background: #EEEEEE;'><td colspan='2'><h2>Category: " . $projectCat . "</h2></td></tr>";
      // $message .= "<tr><td><strong>Team Members:</strong></td><td><ol><li>" . $tMember1 . "</li><li>" . $tMember2 . "</li><li>" . $tMember3 . "</li><li>" . $tMember4 . "</li><li>" . $tMember5 . "</li></ol></td></tr>";
      // $message .= "<tr style='background: #EEEEEE;'><td><strong>Team Contact Email:</strong></td><td>" . $teamEmail . "</td></tr>";
      // $message .= "<tr><td><strong>Video Link:</strong></td><td>" . $videoLink . "</td></tr>";
      // $message .= "</table>";
      // $message .= "</body></html>";
      //
      // // Send Message
      // mail($to, $subject, $message, $headers);
      //
      //
      //
      // /*---Email to Applicant-------------------------------------*/
      // $conf_headers = "From: " . $startup . " <studentstartup.comc@ttu.edu>\r\n";
      // $conf_headers .= "Reply-To: studentstartup.comc@ttu.edu\r\n";
      // $conf_headers .= "MIME-Version: 1.0\r\n";
      // $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      //
      // $conf_to = " ". $teamEmail . "\r\n";
      // $conf_subject = "Startup Application Confirmation";
      //
      // // Message
      // $conf_message = '<html><body>';
      // $conf_message .= '<table width="100%" cellpadding="10">';
      // $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>Application Confirmation For " . $projectTitle . "</h1></td></tr>";
      // $conf_message .= "<tr style='text-align:center;'><td><p>We have received your application for the 2016 Student Startup Competition. You will be hearing from us soon. In the mean time, if you have any questions, please email us at <a href='mailto:studentstartup.comc@ttu.edu'>studentstartup.comc@ttu.edu</a>. We look forward to checking out your submission! Thanks again!</p></td></tr>";
      // $conf_message .= "</table>";
      // $conf_message .= "</body></html>";
      //
      // // Send Message
      // mail($conf_to, $conf_subject, $conf_message, $conf_headers);
      ?>
<h2 style="text-align: center; width: 100%;">We have recieved your rsvp!</h2>
<p style="text-align: center;">You will recieve a confirmation email shortly. If you have any questions in the mean time, please email Taryn Meixner at <a href="mailto:taryn.meixner@ttu.edu">taryn.meixner@ttu.edu</a>. Thank you!</p>
<?php


    } elseif ($password != 'morris2016') {

      ?>

      <h2 style="text-align: center; width: 100%;">We're sorry! The password you entered is incorrect.</h2>
      <p style="text-align: center;">
        Please go back and enter in the correct password to rsvp. Thanks!
      </p>

      <?php

    }

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

  } else {

 ?>


  <h1>Morris RSVP</h1>
  <form class="ldpforms" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
    <fieldset>
      <legend>
        Contact Information
      </legend>
      <label for="firstName">Name:</label>
      <input type="text" id="firstName" name="firstName" required="required" placeholder="First Name" />
      <input type="text" id="lastName" name="lastName" required="required" placeholder="Last Name" />
      <br /><br />
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required="required" />
      <br /><br />
      <label for="foodAccommodations">Food Accommodations:</label>
      <textarea id="foodAccommodations" name="info"></textarea>
      <br /><br />
      <label for="password">Password (<em>This is in your invitation</em>)</label>
      <input type="text" required="required"  id="password" name="password" />
      <input type="submit" value="submit" class="button" />
    </fieldset>
  </form>
  <?php }; ?>
</body>
</html>
