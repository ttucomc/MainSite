<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
	<title>Startup Competition Application | CoMC | TTU</title>

	<link rel="stylesheet" type="text/css" href="../../css/ttu.css">
	<link rel="stylesheet" href="http://www.depts.ttu.edu/_ttu-template/design/ouforms.css">
	<link rel="stylesheet" href="http://www.depts.ttu.edu/comc/includes/styles.css">
	<link rel="stylesheet" type="text/css" href="../css/startup.css">

	<script src="../../js/modernizr.js"></script>
	<script src="../../js/ttuglobal.js"></script>
	<script src="../../js/ttuglobal-onload.js"></script>
	<script src="../../js/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="../js/startup.js"></script>

	<style>
		form label {
			font-weight: 700;
		}
	</style>
</head>
<body>
	<!-- HEADER AND NAV START -->
	<div class="page">
	    <header class="header">
	        <div class="nav-trigger-wrapper"><a class="nav-trigger" data-click-target=".nav-mobile" href="#">☰</a></div>
	        <div class="wrapper"><a class="logo" href="http://www.ttu.edu/"><img src="http://cmsdev.ttu.edu/_ttu-template/design/images/logo.png" alt="Texas Tech University"></a>
				<div class="nav-mobile">

		            <nav class="nav-wrapper">
		                <ul class="nav-utility nav-inline">
							<li><a href="http://www.ttu.edu/site/">A-Z Index</a></li>
							<li><a href="http://directory.texastech.edu/">Directory</a></li>
							<li><a href="http://www.raiderlink.ttu.edu/">Raiderlink</a></li>
						</ul>
	                </nav>

		            <form action="http://google.ttu.edu/search" method="post" class="inline-form search-form">
						<fieldset>
							<legend class="search-legend">Search</legend>
							<label for="q">Search</label>
							<input type="search" name="q" id="q" class="search-input" placeholder="Search">
							<input name="site" type="hidden" value="Campus" />
							<input name="numgm" type="hidden" value="5" />
							<input name="client" type="hidden" value="texas_tech" />
							<input name="output" type="hidden" value="xml_no_dtd" />
							<input name="oe" type="hidden" value="UTF-8" />
							<input name="proxystylesheet" type="hidden" value="texas_tech" />
							<div class="search-trigger"><i class="icon-search"></i></div>
							<label for="searchsubmit">Submit</label>
							<input type="submit" name="searchsubmit" id="searchsubmit" class="search-submit">
						</fieldset>
					</form>

		            <div class="nav-primary-moved"></div>
	            </div>
	        </div>
	        <div class="nav-primary-original">
	            <nav class="nav-wrapper clearfix">
	                <ul class="nav-primary nav-inline clearfix">
						<li><a href="http://www.ttu.edu/admissions/">Admissions, Costs &amp; Aid</a></li>
						<li><a href="http://www.ttu.edu/majors-and-colleges/">Majors &amp; Colleges</a></li>
						<li><a href="http://www.vpr.ttu.edu/">Research</a></li>
						<li><a href="http://www.texastechalumni.org/" target="_blank">Alumni Community</a></li>
						<li><a href="http://www.ttu.edu/campus-life/">Campus Life</a></li>
						<li><a href="http://www.texastech.com/" target="_blank">Athletics</a></li>
						<li><a href="http://www.ttu.edu/about/">About TTU</a></li>
					</ul>
	            </nav>
	        </div>
	        <nav class="nav-wrapper-lower clearfix">
	            <div class="nav-trigger-wrapper nav-trigger-wrapper-lower"><a class="nav-trigger icon-down" data-click-target=".nav-primary-lower" href="#"></a></div>
	            <ul class="nav-primary-lower nav-inline clearfix">
					<li><a href="/comc/about/">About</a></li><!-- Required, no changes -->
					<li><a href="/comc/programs/">Programs &amp; Majors</a></li><!-- Required, no changes -->
					<li><a href="/comc/faculty/">Our People</a></li><!-- Required, no changes -->
					<li><a href="/comc/students/">Students</a></li><!-- Optional, can be removed, or changed with C&M review -->
					<li><a href="/comc/graduate/">Graduate Programs</a></li><!-- Optional, can be removed, or changed with C&M review -->
					<li><a href="/comc/alumni/">Alumni</a></li><!-- Optional, can be removed, or changed with C&M review -->
					<li><a href="/comc/research/">Research</a></li><!-- Optional, can be removed, or changed with C&M review -->
					<li><a href="/comc/contact/">Contact Us</a></li><!-- Required, no changes -->
				</ul>
	        </nav>
	    </header>
	</div>
	<!-- HEADER AND NAV END -->
	<!-- TTU BREADCRUMBS AND HEADER 1 START -->
	<div class="wrapper wrapper-padded-mobile">
        <div class="wrapper">
            <div class="wrapper">
                <ul class="breadcrumbs" style="display: none;">
                    <li class="breadcrumbs-item"><a href="http://www.ttu.edu/"></a></li>
                    <li class="breadcrumbs-item"><a href="/comc">College of Media and Communications</a></li>
                </ul>
            </div>
            <div class="content-block">
               	<div class="columns-wrapper column-flex column-flexwrap audience-nav-placeholder-small">
                    <div class="column-full column-centered column-padded-horizontal">
                 	    <h1>Student Startup Application</h1>
                  	</div>
    <!-- TTU BREADCRUMBS AND HEADER 1 END -->







    <!-- MAIN EDITS START -->
					<?php
					// Overall if statement to determine if the form as been submitted or not
					if ($_SERVER["REQUEST_METHOD"] == "POST") {

						// // Captcha code
						// $gRecaptchaResponse = $_POST['g-recaptcha-response'];
						// require('http://www.depts.ttu.edu/comc/includes/autoload.php');
						// $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
						// $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
						// $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
						// $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
						//
						// // If captcha is successful
						// if ($resp->isSuccess()) {

							/*---Variables-------------------------------------*/
							// Title
							$startup = 'Student Startup Competition';

							// Team Information
							$projectTitle = $_POST['project_title'];
							$projectCat = $_POST['project_cat'];
							$tMember1 = $_POST['team-1'];
							$tMember2 = $_POST['team-2'];
							$tMember3 = $_POST['team-3'];
							$tMember4 = $_POST['team-4'];
							$tMember5 = $_POST['team-5'];
							$acceptAward1 = $_POST['award-1'];
							$acceptAward2 = $_POST['award-2'];
							$teamEmail = $_POST['team_email'];
							$videoLink = $_POST['video_submission'];



							/*---Email to Approval Comittee-------------------------------------*/
							$headers = "From: " . $startup . "\r\n";
							$headers .= "Reply-To: studentstartup.comc@ttu.edu\r\n";
							$headers .= "CC: kuhrt.cowan@ttu.edu\r\n";
							$headers .= "MIME-Version: 1.0\r\n";
							$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

							$to = "kuhrt.cowan@ttu.edu";

							$subject = "Startup Team Application";

							// Message
							$message = '<html><body>';
							$message .= '<table width="100%" cellpadding="10">';
							$message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color: #FFFFFF;'>Student Startup Application For " . $projectTitle . "</h1></td></tr>";
							$message .= "<tr style='background: #EEEEEE;'><td><h2>Category: " . $projectCat . "</h2></td></tr>";
							$message .= "<tr><td><strong>Team Members:</strong></td><td><ol><li>" . $tMember1 . "</li><li>" . $tMember2 . "</li><li>" . $tMember3 . "</li><li>" . $tMember4 . "</li><li>" . $tMember5 . "</li></ol></td></tr>";
							$message .= "<tr style='background: #EEEEEE;'><td><strong>Team Members Who Will Accept Award:</strong></td><td><ol><li>" . $acceptAward1 . "</li><li>" . $acceptAward2 . "</li></td></tr>";
							$message .= "<tr><td><strong>Team Contact Email:</strong></td><td>" . $teamEmail . "</td></tr>";
							$message .= "<tr style='background: #EEEEEE;'><td><strong>Video Link:</strong></td><td>" . $videoLink . "</td></tr>";
							$message .= "</table>";
							$message .= "</body></html>";

							// Send Message
							mail($to, $subject, $message, $headers);



							/*---Email to Applicant-------------------------------------*/
							$conf_headers = "From: " . $startup . "\r\n";
							$conf_headers .= "Reply-To: studentstartup.comc@ttu.edu\r\n";
							$conf_headers .= "MIME-Version: 1.0\r\n";
							$conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

							$conf_to = " ". $teamEmail . "\r\n";
							$conf_subject = "Startup Application Confirmation";

							// Message
							$conf_message = '<html><body>';
							$conf_message .= '<table width="100%" cellpadding="10">';
							$conf_message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><h1 style='color:#FFFFFF; text-align:center;'>Application Confirmation For " . $projectTitle . "</h1></td></tr>";
							$conf_message .= "<tr style='text-align:center;'><td><p>We have received your application for the 2016 Student Startup Competition. You will be hearing from us soon. In the mean time, if you have any questions, please email us at <a href='mailto:studentstartup.comc@ttu.edu'>studentstartup.comc@ttu.edu</a>. We look forward to checking out your submission! Thanks again!</p></td></tr>";
							$conf_message .= "</table>";
							$conf_message .= "</body></html>";

							// Send Message
							mail($conf_to, $conf_subject, $conf_message, $conf_headers);
							?>

							<h2 style="text-align:center; width:100%;">Application Submission Successful!</h2>
							<p style="text-align:center;">
								You will recieve a confirmation email shortly. We will be contacting you soon about your application. If you have any questions in the mean time, please email us at <a href="mailto:studentstartup.comc@ttu.edu">studentstartup.comc@ttu.edu</a>. Thank you for your interest in joing the Student Startup Competition!
							</p>

							<?php


						// } else {
						// 	echo "<h1>Bummer! Something went wrong.</h1>";
						// 	$errors = $resp->getErrorCodes();
						// 	if (in_array("missing-input-response", $errors)) {
						// 		echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.<br><br><a href=\"sponsor.php\">Go Back</a></p>";
						// 	} else {
						// 		echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to our <a href=\"mailto:kuhrt.cowan@ttu.edu\">webmaster</a> along with your message and we will get it taken care of. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
						// 		foreach ($errors as $error) {
						// 			echo "<li>" . $error . "</li>";
						// 		}
						// 		echo "</ul>";
						// 	}
						// 	exit();
						// }

					} else { ?>
                    <p>
                        Please fill out the form below to apply for the 2016 startup competition. <em>Please note that if the link to your video is broken or we cannot access the video, the team will be automatically disqualified.</em>
                    </p>
                    <?php echo '<form id="startup-application" name="startup-application" method="post" class="ldpforms" action="' . $_SERVER['PHP_SELF'] . '">'; ?>
                    	<fieldset>
							<legend>
								Team Information
							</legend>
							<label for="project_title">Project Title:</label>
							<input id="project_title" name="project_title" type="text" required="required">
							<br><br>
							<label for="project_cat">Project Category:</label>
							<select id="project_cat" name="project_cat" required="required">
								<option value="">
									Please Select
								</option>
								<option value="Sports Media">
									Sports Media
								</option>
								<option value="Gaming">
									Gaming
								</option>
								<option value="Social Media">
									Social Media
								</option>
								<option value="Digital Entertainment">
									Digital Entertainment
								</option>
								<option value="News and Information Technologies">
									News and Information Technologies
								</option>
								<option value="Public Advocacy and Activism">
									Public Advocacy and Activism
								</option>
								<option value="Innovative Ecommerce">
									Innovative Ecommerce
								</option>
							</select>
							<br><br>
							<label for="team-1">Team Members (up to 5):</label>
							<ol>
								<li>
									<input id="team-1" name="team-1" type="text" required="required">
								</li>
								<li>
									<input id="team-2" name="team-2" type="text">
								</li>
								<li>
									<input id="team-3" name="team-3" type="text">
								</li>
								<li>
									<input id="team-4" name="team-4" type="text">
								</li>
								<li>
									<input id="team-5" name="team-5" type="text">
								</li>
							</ol>
							<br>
							<label for="award-1">Team Members Who Will Accept the Award If You Should Win (up to 2):</label>
							<ol>
								<li>
									<input id="award-1" name="award-1" type="text" required="required">
								</li>
								<li>
									<input id="award-2" name="award-2" type="text">
								</li>
							</ol>
							<br>
							<label for="team_email">Team Contact Email:</label>
							<input id="team_email" name="team_email" type="email" required="required">
							<br><br>
							<label for="video_submission">Video Submission:</label>
							<p>
								The video should be no more than 5 minutes and can be actual video of student team members or a slide show with voice over. The videos should address the team, the problem, the solution (technology, content, relationships), value proposition, prototypes (sketches, wireframes or visuals of your product/process), financials/revenue streams, target market and competitors (and why you'll do better). <em>If the link to your video is broken or we cannot access the video, the team will be automatically disqualified.</em>
							</p>
							<input id="video_submission" name="video_submission" type="text" required="required" placeholder="Paste link here...">
							<br><br><br>
							<input id="accept_legal" name="accept_legal" type="checkbox" required="required"> I certify that I have provided information that is correct and understand that falsification of any of the provided information may void my application. (Check the box).
						</fieldset>
						<div class="g-recaptcha" data-sitekey="6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY"></div>
						<br>
						<input id="btn btn-info" class="submit" type="submit" value="Submit" name="button">
						<div class="form-loader"></div>
                    </form>
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
					<?php }; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- MAIN EDITS END -->








    <!-- TTU WIDE RED AND FOOTER START -->
    <div class="wrapper-wide-red">
		<div class="wrapper">
			<div class="columns-wrapper column-flex column-flexwrap">
				<div class='column-one-third column-centered column-padded-vertical-desktop'>
					<div class='fact fact-icon'>
						<a href='http://www.visit.ttu.edu/'><h3 class='fact-header fact-header-medium'><i class='icon-sign'></i></h3>
							<p class='fact-excerpt'>Visit</p>
						</a>
					</div>
				</div>
				<div class='column-one-third column-centered column-padded-vertical-desktop'>
					<div class='fact fact-icon'>
						<a href='http://www.ttu.edu/admissions/'><h3 class='fact-header fact-header-medium'><i class='icon-pencil'></i></h3>
							<p class='fact-excerpt'>Apply</p>
						</a>
					</div>
				</div>
				<div class='column-one-third column-centered column-padded-vertical-desktop'>
					<div class='fact fact-icon'>
						<a href='/comc/contact/index.php'><h3 class='fact-header fact-header-medium'><i class='icon-phone'></i></h3>
							<p class='fact-excerpt'>Contact Us</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


    <footer class="footer">
        <ul class="sociallinks footer-sociallinks">
			<li>
				<a href="http://www.facebook.com/TexasTechYou" name="Facebook"	onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-facebook"></i>Facebook</a>
			</li>
			<li>
				<a href="http://www.twitter.com/texastech/"	name="twitter"		onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-twitter"></i>Twitter</a>
			</li>
			<li>
				<a href="http://foursquare.com/texastech" name="Foursquare"	onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-foursquare"></i>Foursquare</a>
			</li>
			<li>
				<a href="http://www.youtube.com/user/texastech/" name="YouTube"		onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-youtube"></i>YouTube</a>
			</li>
			<li>
				<a href="http://www.flickr.com/photos/texas-tech/" name="Flickr"		onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-flickr"></i>Flickr</a>
			</li>
			<li>
				<a href="http://followgram.me/texastech"	name="Instagram"	onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-instagram"></i>Instagram</a>
			</li>
			<li>
				<a href="http://www.linkedin.com/companies/texas-tech-university" name="LinkedIn"	onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-linkedin"></i>LinkedIn</a>
			</li>
			<li>
				<a href="http://www.ttu.edu/mobile/" 	name="TTUMobile"	onClick="track(buildLink('socialbar',this.name),'outbound',this.href);"><i class="icon-ttu"></i>TTU</a>
			</li>
		</ul>
		<div class="wrapper">
            <div class="wrapper-footer column-flex">
                <div class="column-one-half">
	                <div class="column-one-half column-centered column-padded-horizontal column-padded-vertical column-border-bottom"><a class="logo logo-small" href="http://www.ttu.edu/"><img src="http://cmsdev.ttu.edu/_ttu-template/design/images/logo-small.png" alt="Texas Tech University"></a></div>
                    <div class="column-one-half column-padded-horizontal column-padded-vertical column-border-left column-border-bottom"><address class="address address-footer"><span class="street">2500 Broadway</span> <span class="citystate">Lubbock, Texas 79409</span>&nbsp;<span class="phone">806-742-2011</span></address>
					</div>
	                <div class="column-full column-padded-horizontal">
	                    <p class="slogan slogan-large">From here, it's possible</p>
	                </div>
	            </div>
	            <div class="column-one-half column-padded-vertical column-flex">
	                <div class="column-one-half column-padded-horizontal column-border-left">
		                <ul class="footer-links">
							<li><a href="http://www.txhighereddata.org/approot/resumes/ir_launch.htm" onclick="track('online-inst-resumes','footer',this.href);" target="_blank" style="font-size:1.2em;">Online Institutional Resumes</a></li>
							<li><a href="http://www.state.tx.us/" target="_blank">State of Texas</a></li>
							<li><a href="http://www2.tsl.state.tx.us/trail/" target="_blank">Statewide Search</a></li>
							<li><a href="http://www.texashomelandsecurity.com/" target="_blank">Texas Homeland Security</a></li>
							<li><a href="http://veterans.portal.texas.gov/en/Pages/default.aspx" target="_blank">Texas Veterans Portal</a></li>
							<li><a href="http://sao.fraud.state.tx.us/" target="_blank">SAO Fraud Reporting</a></li>
							<li><a href="http://www.physicalplant.ttu.edu/EnergyManagement/">Energy Management</a></li>
							<li><a href="http://www.ttu.edu/policy/">General Policy Information</a></li>
							<li><a href="http://www.ttu.edu/courseinfo/">Public Access to Course Info</a></li>
							<li><a href="http://www.ttu.edu/emergency/">Emergency Communication Center</a></li>
						</ul>
					</div>
	                <div class="column-one-half column-padded-horizontal column-border-left column-copyright">
		                <ul class="footer-links">
							<li><a href="http://www.texastech.edu/">TTU System</a></li>
							<li><a href="http://www.ttuhsc.edu/">TTU Health Sciences Center</a></li>
							<li><a href="http://elpaso.ttuhsc.edu/">TTUHSC at El Paso</a></li>
							<li><a href="http://www.angelo.edu/">Angelo State University</a></li>
							<li><a href="http://www.ttu.edu/about/contact.php">Contact Us</a></li>
							<li><a href="http://www.ttu.edu/map/">Campus Map</a></li>
							<li><a href="http://careers.texastech.edu/">Jobs at TTU</a></li>
							<li><a href="http://www.ttu.edu/site/sitemap.php">Site Map</a></li>
						</ul>
	                    <div class="copright">
	                        <p>© 2015 <a href="http://www.ttu.edu/">Texas Tech University</a></p>
	                        <p>Updated:
	                           <a href="http://a.cms.omniupdate.com/10?skin=ttu&amp;account=main&amp;site=comc&amp;action=de&amp;path=/index.pcf" target="_blank">Jul 20, 2015</a>
	                           4:41 PM
	                        </p>
	                    </div>
	                    <p class="slogan slogan-small">From here, it's possible</p>
	                </div>
	            </div>
	        </div>
	    </div>
    </footer>
    <!-- TTU WIDE RED AND FOOTER END -->
</body>
</html>
