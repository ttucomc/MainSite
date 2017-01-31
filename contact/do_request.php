<?php
$approved = array("Alumni relations","4-year degree plans","Graduate studies","Scholarships","Internships","Work Study","Employment","Giving","Research");
$gRecaptchaResponse = $_POST['g-recaptcha-response'];
require('autoload.php');
$siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
$secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
$recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

if ($resp->isSuccess()) {
	if	(!in_array($_POST[info_type], $approved)) { die ("<h2>Please use your browser's back button to return to the request form and select the type of information you desire from the drop-down menu.</h2>");
} elseif
(strstr ($_POST[comment], "[URL= http:"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "./"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "66d583.com"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "[URL=http:"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "sucomi.com"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "squidoo.com"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "rolocdoog.ru"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "[url=http:"))  { die ("Your message failed screening.");
} elseif
(strstr ($_POST[comment], "[url=<a href="))  { die ("Your message failed screening.");
} elseif ($_POST[info_type] == "Scholarships") {
	$to = "shannon.smith@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "4-year degree plans") {
	$to = "todd.chambers@ttu.edu, emily.balke@ttu.edu, r.reddick@ttu.edu, clara.mckenneye@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Internships") {
	$to = "ali.j.luempert@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Research") {
	$to = "coy.callison@ttu.edu, glenn.cummins@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Alumni relations") {
	$to = "taryn.meixner@ttu.edu, kathleen.mcgaughey@ttu.edu, colleen.sisneros@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Graduate studies") {
	$to = "bridget.christopherson@ttu.edu, r.reddick@ttu.edu, coy.callison@ttu.edu, clara.mckenney@ttu.edu, kristi.gilmore@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Work study") {
	$to = "kimberly.wagner@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Employment") {
	$to = "kimberly.wagner@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} elseif ($_POST[info_type] == "Giving") {
	$to = "colleen.sisneros@ttu.edu, r.reddick@ttu.edu, clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu";
} else {
	$to = "kimberly.wagner@ttu.edu, clara.mckenney@ttu.edu, r.reddick@ttu.edu, kuhrt.cowan@ttu.edu";
}
} else {
	echo "<h2>Bummer! Something went wrong.</h2>";
	$errors = $resp->getErrorCodes();
	if (in_array("missing-input-response", $errors)) {
		echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.";
	} else {
		echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to our <a href=\"mailto:kuhrt.cowan@ttu.edu\">webmaster</a> along with your message and we will get it taken care of. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
	}
	exit();
}

$comment = stripslashes($_POST[comment]);
$last_name = stripslashes($_POST[last_name]);
$first_name = stripslashes($_POST[first_name]);
$street = stripslashes($_POST[street]);
$street2 = stripslashes($_POST[street2]);
//$regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";


//if (!eregi($regexp, $_POST[sender_email])) {
//die ("Your e-mail is invalid. Please use your browser's back button to revisit the form.");
function checkEmail($sender_email) {
	if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$sender_email))
	{
		return true;
	}
	return false;
}
if
	(strlen($last_name) >25) {
		die ("Please use a shorter version of your name.");
// Test for @ signs in name field
	} elseif
	(strstr ($_POST[last_name], "@"))  {
		die ("Your name is not valid");
// Test for name abnormalities
	} elseif
	($_POST[first_name] == $_POST[last_name])  { die ("Please check your name.");
} elseif
($_POST[first_name] == "")  { die ("Please check your name.");
} elseif
($_POST[last_name] == "")  { die ("Please check your name.");
} elseif
(strlen($_POST[sender_email]) >40) {
	die ("Your email address is too long.");
} elseif
($info_type == "Alumni relations" || "4-year degree plans" || "Graduate studies" ||
	"Scholarships" || "Internships" || "Work study" || "Employment" || "Giving" || "Research") {

	$msg = "Sender's Full Name: $_POST[first_name] $_POST[last_name]\n";
	$msg .= "Sender's E-mail: $_POST[sender_email]\n";
	$msg .= "Subject: $info_type $_POST[info_type]\n";
	$msg .= "Street address: $_POST[street]\n";
	$msg .= "Address2: $_POST[street]\n";
	$msg .= "City: $city $_POST[city]\n";
	$msg .= "State: $_POST[state]\n";
	$msg .= "Postal code: $_POST[postal]\n";
	$msg .= "Nation: $_POST[nation]\n";
	$msg .= "Phone: $_POST[phone]\n";
	$msg .= "Sender's Comment: $_POST[comment]\n\n";
	$mailheaders = "From: College of Media & Communication <comc@ttu.edu>\n";
	$mailheaders .= "Reply-To: $_POST[$sender_email]\n\n";

	mail($to,$_POST[info_type],$msg,$mailheaders);

	header('Location: /comc/contact/confirmation');

	// echo "<h2 align=center>Thank You, $first_name $last_name</h2>";
	// echo "<p align=center>We value your interest in the College of Media &amp; Communication.</p>";

} else {
	die ("Your subject, \"$info_type,\" is not approved. <br />
		Please use your Back button and select a subject.");
}
?>
