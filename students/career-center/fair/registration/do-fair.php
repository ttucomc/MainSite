<?php

$gRecaptchaResponse = $_POST['g-recaptcha-response'];
require('/comc/includes/autoload.php');
$siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
$secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
$recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

if ($resp->isSuccess()) {

	// Form variables
	$companyname = stripslashes($_POST[companyname]);
    $num_of_representatives = stripslashes($_POST[num_of_representatives]);
	// $representatives = stripslashes($_POST[representatives]);
	// $representatives2 = stripslashes($_POST[representatives2]);
	// $representatives3 = stripslashes($_POST[representatives3]);
	// $representatives4 = stripslashes($_POST[representatives4]);
	$street_address = stripcslashes($_POST[street_address]);
	$city = stripslashes($_POST[city]);
	$state = stripslashes($_POST[state]);
	$phonenumber = stripslashes($_POST[phone]);
	$webaddress = stripslashes($_POST[webaddress]);
	$contact = stripslashes($_POST[primary]);
	$contacttitle = stripslashes($_POST[primarytitle]);
	$contactphone = stripslashes($_POST[contactphone]);
	$contactemail = stripslashes($_POST[contactemail]);
	$avpowerneeds = stripslashes($_POST[av_power_needs]);
	$avpowerneeds2 = stripslashes($_POST[av_power_needs2]);
	$avpowerneeds3 = stripslashes($_POST[av_power_needs3]);
	$companydescription = stripslashes($_POST[companydescription]);
	$positionsavailable = stripslashes($_POST[positionsavailable]);
	$majors = stripslashes($_POST[majors]);
	$majors2 = stripslashes($_POST[majors2]);
	$majors3 = stripslashes($_POST[majors3]);
	$majors4 = stripslashes($_POST[majors4]);
	$skillstraits = stripslashes($_POST[skillstraits]);

	// // Variable for email checking
	// $regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";
	// // Checking if the email is valid
	// if (!eregi($regexp, $_POST[contactemail])) {
	// 	die ("Your e-mail is invalid. Please use your browser's back button to revisit the form.");
	// }

	function checkEmail($contactemail) {
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$contactemail))
		{
			return true;
		}
		return false;
	}
	// Test for @ signs in name field
	if(strstr ($_POST[primary], "@"))  {
		die ("Your name is not valid");
	// Test for name abnormalities
	} elseif
		($_POST[primary] == "")  { die ("Please check your name.");
	} elseif
	(strlen($_POST[contactemail]) >40) {
		die ("Your email address is too long.");
	} else {

		/*---Email to CoMC-------------------------------------*/

		$headers = "From: " . $contactemail . "\r\n";
        $headers .= "Reply-To: ". $contactemail . "\r\n";
        $headers .= "Cc: justin.m.lugo@ttu.edu\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $to = "career.comc@ttu.edu";
        $subject = "Career Fair Registration";

        $message = '<html><body>';
        $message .= '<table width="100%" cellpadding="10">';
        $message .= "<tr><td colspan='2'><h1>Career Fair Registration</h1></td></tr>";
        $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><strong>Company:</strong> </td><td>".$companyname."</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Number of Representatives Attending:</strong> </td><td>" . $num_of_representatives . "</td>";

        // "</tr><tr style='background: #EEEEEE;'><td></td><td>" . $representatives2 . "</td></tr><tr style='background: #EEEEEE;'><td></td><td>" . $representatives3 . "</td></tr><tr style='background: #EEEEEE;'><td></td><td>" . $representatives4 . "</td></tr>";

        $message .= "<tr style='background: #D4D4D4;'><td><strong>Street Address:</strong> </td><td>" . $street_address . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>City:</strong> </td><td>" . $city . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>State:</strong></td><td>" . $state . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>Phone Number:</strong> </td><td>" . $phonenumber . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Website:</strong></td><td>" . $webaddress . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>Contact:</strong> </td><td>" . $contact . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Contact Title:</strong></td><td>" . $contacttitle . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>Contact Phone Number:</strong> </td><td>" . $contactphone . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Contact Email:</strong></td><td>" . $contactemail . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>AV Power Needs:</strong> </td><td>" . $avpowerneeds . "</td></tr><tr style='background: #D4D4D4;'><td></td><td>" . $avpowerneeds2 . "</td></tr><tr style='background: #D4D4D4;'><td></td><td>" . $avpowerneeds3 . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Company Description:</strong></td><td>" . $companydescription . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>Positions Available:</strong> </td><td>" . $positionsavailable . "</td></tr>";
        $message .= "<tr style='background: #EEEEEE;'><td><strong>Majors of Interest:</strong></td><td>" . $majors . "</td></tr><tr style='background: #EEEEEE;'><td></td><td>" . $majors2 . "</td></tr><tr style='background: #EEEEEE;'><td></td><td>" . $majors3 . "</td></tr><tr style='background: #EEEEEE;'><td></td><td>" . $majors4 . "</td></tr>";
        $message .= "<tr style='background: #D4D4D4;'><td><strong>Skills/Traits Company is Looking For:</strong> </td><td>" . $skillstraits . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        mail ($to, $subject, $message, $headers);

		/*---Email to Applicant-------------------------------------*/

        $conf_headers = "From: career.comc@ttu.edu\r\n";
        $conf_headers .= "Reply-To: career.comc@ttu.edu\r\n";
        $conf_headers .= "MIME-Version: 1.0\r\n";
        $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $conf_to = " ". $contactemail . "\r\n";
        $conf_subject = "Career Fair Registration";

        $conf_message = '<html><body>';
        $conf_message .= '<div width="100%" style="background: #CC0000; padding:15px;">';
        $conf_message .= "<h3 style='text-align:center; color: #FFFFFF; font-size: 32;'>Thank you for registering " . $contact . "!</h3>";
        $conf_message .= '</div>';
        $conf_message .= '<div width="100%">';
        $conf_message .= "<p align=center>The CoMC Career Center will get back with you soon confirming your registration.</p>";
        $conf_message .= "<p align=center>If you have any questions, please email the CoMC Career Center at <a href='mailto:career.comc@ttu.edu'>career.comc@ttu.edu</a>.";
        $conf_message .= '</div>';
        $conf_message .= '</body></html>';

        mail ($conf_to, $conf_subject, $conf_message, $conf_headers);

        // Forwarding to confirmation page
    	header('Location: /comc/students/career-center/fair/registration/confirmation/');

	}

} else {
	echo "<h2>Bummer! Something went wrong.</h2>";
	$errors = $resp->getErrorCodes();
	if (in_array("missing-input-response", $errors)) {
		echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.";
	} else {
		echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to our <a href=\"mailto:justin.m.lugo@ttu.edu\">student web assistant</a> along with your message and we will resolve the issue. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
	}
	exit();
}

?>
