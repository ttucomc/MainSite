<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
	<title>The Degree You Want | Online Masters | CoMC</title>
  <meta name="description" content="The Degree You Want" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css" />
</head>
<body>

  <?php

  require_once('/comc/includes/ttu-db-config.php');
  require_once('/comc/includes/ttu-db.php');

  // Overall if statement to determine if the form has been submitted or not
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*---Variables-------------------------------------*/
    // Title
    $onlineMasters = 'Online Master\'s in Strategic Communication';

    // Invitee's Information
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $campaign = $_POST['campaign'];


    /*---Sending Info to DB-------------------------------------*/
    try {

      // Info for interested person
      $stmt = $db->prepare("
                            INSERT INTO ads (first_name, last_name, email, campaign)
                            VALUES (:first_name, :last_name, :email, :campaign)
                          ");
      // Binding Parameters
      $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
      $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':campaign', $campaign, PDO::PARAM_STR);
      // Executing to DB
      $stmt->execute();

    } catch (Exception $e) {
      echo "Couldn't add information into database.";
      exit();
    }


    /*---Email to Online Graduate Staff-------------------------------------*/
    $headers = "From: " . $firstName . " " . $lastName . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    // $headers .= "CC: kuhrt.cowan@ttu.edu\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $to = "kuhrt.cowan@ttu.edu";

    $subject = $onlineMasters . " Info Request";

    // Message
    $message = '<html><body>';
    $message .= '<table width="100%" cellpadding="10">';
    $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . $firstName . " " . $lastName . " would like more info!</h1></td></tr>";
    $message .= "<tr style='background: #EEEEEE;'><td><strong>Email:</strong></td><td>" . $email . "</td></tr>";
    $message .= "<tr><td><strong>Campaign Used:</strong></td><td>" . $campaign . "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";

    // Send Message
    mail($to, $subject, $message, $headers);


    /*---Email to Interested Person-------------------------------------*/
    $conf_headers = "From: The College of Media & Communication <kristi.gilmore@ttu.edu>\r\n";
    $conf_headers .= "Reply-To: kristi.gilmore@ttu.edu\r\n";
    $conf_headers .= "MIME-Version: 1.0\r\n";
    $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $conf_to = $email;
    $conf_subject = $onlineMasters;

    // Message
    $conf_message = '<html><body>';
    $conf_message .= '<table width="100%" cellpadding="10">';
    $conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>Thanks, " . $firstName . ", for your intrest in our " . $onlineMasters . "!</h1></td></tr>";
    $conf_message .= "<tr style='text-align:center;'><td><p>This is just a confirmation email and we will send you more information about our program soon. If you have any questions or would like to talk to someone, please contact Kristi Gilmore at <a href='mailto:kristi.gilmore@ttu.edu'>kristi.gilmore@ttu.edu</a>. Thanks again!</p></td></tr>";
    $conf_message .= "</table>";
    $conf_message .= "</body></html>";

    // Send Message
    mail($conf_to, $conf_subject, $conf_message, $conf_headers);

  ?>

  <section id="top" class="container-fluid" style="background-image:url('img/GraduateSocial-4.jpg')">
    <div class="row text-center">
      <div class="col-sm-8 col-sm-offset-2">
        <h1>Thanks, <?php echo $firstName; ?>, for your interest in our program!</h1>
        <p>
          You will be hearing from us soon with the information you've requested. If you have any questions in the meantime or would like to speak with someone, contact Kristi Gilmore at <a href="mailto:kristi.gilmore@ttu.edu">kristi.gilmore@ttu.edu</a>. Thanks again!
        </p>
      </div>
    </div>
  </section>


  <?php

    } else { // Ends overall if statement, opens else

      $campaign_id = 0;
      // if an ID is specified in the query string, use it
      if (isset($_GET["id"])) {
      	$campaign_id = intval($_GET["id"]);
      }

      // Array that has all of the 10 campaigns they want to push summer 2016
      $campaigns = array(
        // Brand Recruitment
        array(
          'Campaign' => 'Now Online',
          'Title' => 'The Strategic Communication Master\'s Degree',
          'Text' => 'Earn Your Master of Strategic Communication Degree from Texas Tech University! Comprehensive, convenient 100% online. Update yours skills to be competitive in today\'s global and digitally focused environment. Learn more now! <em>The Degree You Want.</em>',
          'Photo' => 'img/GraduateSocial-1.jpg'
        ),
        array(
          'Campaign' => 'For Professionals',
          'Title' => 'Texas Tech University Online Strategic Communication MA',
          'Text' => 'Pursue the Master of Strategic Communication from Texas Tech University 100% online. Contact the College of Media & Communication today to learn more about our Online M.A. designed for professionals. <em>The Degree You Want.</em>',
          'Photo' => 'img/GraduateSocial-2.jpg'
        ),
        array(
          'Campaign' => 'Advance Your Career',
          'Title' => 'The Online Strategic Communication MA',
          'Text' => 'Earn your M.A. in Strategic Communication from Texas Tech University to advance your skills, career and earning power. Complete in as few as 18 months. Learn more now. <em>The Degree You Want.</em>',
          'Photo' => 'img/GraduateSocial-3.jpg'
        ),
        array(
          'Campaign' => 'Completion in as Few as 18 Months',
          'Title' => 'Texas Tech University MA 100% Online',
          'Text' => 'Rolling enrollment starts any term. Thirty hour program is comprehensive, accelerated and online. Contact us today for more information. <em>The Degree You Want.</em>',
          'Photo' => 'img/GraduateSocial-4.jpg'
        ),
        array(
          'Campaign' => '100% Online From Texas Tech University',
          'Title' => 'The MA Degree For Professionals',
          'Text' => 'The Online M.A. Program is comprehensive, rigorous and taught by full-time faculty. Take yournext career step with a focus on global and digital strategic communication. Visit our website to learn more. <em>The Degree You Want.</em>',
          'Photo' => 'img/GraduateSocial-5.jpg'
        )
      );

      // Getting the right campaign from the id
      $campaign = $campaigns[$campaign_id];

      // Setting variables for content
      $title = $campaign['Title'];
      $subTitle = $campaign['Campaign'];
      $text = $campaign['Text'];
      $photo = $campaign['Photo'];

  ?>

  <section id="top" class="container-fluid" style="background-image:url('<?php echo $photo; ?>')">
    <div class="row text-left">
      <div class="col-sm-5 <?php if($campaign_id == 0) { echo 'col-sm-offset-6'; } else { echo 'col-sm-offset-2'; } ?>">
        <h1><?php echo $title; ?></h1>
        <h2><?php echo $subTitle; ?></h2>
        <p>
          <?php echo $text; ?>
        </p>
      </div>
    </div>
  </section>
  <section id="the-form">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <fieldset>
            <legend>
              Get more information!
            </legend>
            <div class="form-group">
              <label for="first_name">Name:</label>
              <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" required />
              <br />
              <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" class="form-control" required />
            </div>
            <input type="hidden" name="campaign" value="<?php echo $subTitle; ?>" />
            <input type="submit" value="Submit" class="btn btn-primary btn-block" />
          </fieldset>
        </form>
      </div>
    </div>
  </section>

  <?php } // Ends overall else statement ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-38232832-1', 'auto');
    ga('send', 'pageview');

  </script>
</body>
</html>
