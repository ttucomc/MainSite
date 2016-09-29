<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" xmlns:lr="http://adobe.com/lrg/0.0"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" xmlns:lr="http://adobe.com/lrg/0.0"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" xmlns:lr="http://adobe.com/lrg/0.0"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xmlns:lr="http://adobe.com/lrg/0.0"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Scholarship Luncheon 2015 Photos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <link rel="stylesheet" type="text/css" media="screen" title="Custom Settings" href="assets/css/custom.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="assets/js/libs/modernizr.custom.23122.js"></script>

        <style type="text/css">
        html,
        body {
            height: 100%;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        </style>
    </head>
    <body class="has-header row-spacing-md" data-pagination-style="scroll" data-target-row-height="200">
                        <header class="">
            <div class="background"></div>
            <div class="meta-left">
                <a href="http://www.depts.ttu.edu/comc/"><img src="images/CoMCDoubleT.svg" id="logo" alt="CoMC Double T and Signature"></a>
            </div>
            <div class="meta-right">
                
            </div>
        </header>
        <section id="instructions">

            <?php
                // Captcha code
                $gRecaptchaResponse = $_POST['g-recaptcha-response'];
                require('autoload.php');
                $siteKey = '6Lc8LAsTAAAAAL6lEJwvfn41TY3aFliMRkdZ4QvY';
                $secret = '6Lc8LAsTAAAAAOHTC42UTYGN3JroKYT57uXiO8tO';
                $recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\SocketPost());
                $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
                // If captcha is successful
                if ($resp->isSuccess()) {

                    $user_name = stripslashes($_POST[user_name]);
                    $user_email = stripslashes($_POST[user_email]);
                    $user_message = stripslashes($_POST[user_message]);
                    $comc = stripslashes('College of Media & Communication');
                    
                    /*---Email to Marketing Dept.-------------------------------------*/
                    
                    $headers = "From: " . $user_email . "\r\n";
                    $headers .= "Reply-To: ". $user_email . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
                    $to = " kuhrt.cowan@ttu.edu, jacob.copple@ttu.edu";
                    $subject = "Scholarship Luncheon Photos";
                    
                    $message = '<html><body>';
                    $message .= '<table width="100%" cellpadding="10">';
                    $message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><strong>Sender's Name:</strong> </td><td>".$user_name."</td></tr>";
                    $message .= "<tr style='background: #EEEEEE;'><td><strong>Email:</strong> </td><td>" . $user_email . "</td></tr>";
                    $message .= "<tr style='background: #EEEEEE;'><td><strong>Pictures Requested:</strong> </td><td>" . $user_message . "</td></tr>";
                    $message .= "</table>";
                    $message .= "</body></html>";
                    
                    mail ($to, $subject, $message, $headers);
                    
                    /*---Email to Applicant-------------------------------------*/
                    
                    $conf_headers = "From: MassComm_Web@ttu.edu\r\n";
                    $conf_headers .= "Reply-To: kuhrt.cowan@ttu.edu\r\n";
                    $conf_headers .= "MIME-Version: 1.0\r\n";
                    $conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
                    $conf_to = " ". $user_email . "\r\n";
                    $conf_subject = "Scholarship Luncheon Photos";
                    
                    $conf_message = '<html><body>';
                    $conf_message .= '<div width="100%" style="background: #CC0000; padding:15px;">';
                    $conf_message .= "<h3 style='text-align:center; color: #FFFFFF; font-size: 32;'>Thank you for your submission " . $user_name . "!</h3>";
                    $conf_message .= '</div>';
                    $conf_message .= '<div width="100%">';
                    $conf_message .= "<p align=center>We will get back to you as soon as possible with a link to the pictures you have requested</p>";
                    $conf_message .= "<p align=center>If you have any questions please email <a href='mailto:kuhrt.cowan@ttu.edu'>Kuhrt Cowan</a>.";
                    $conf_message .= '</div>';
                    $conf_message .= '</body></html>';
                    
                    mail ($conf_to, $conf_subject, $conf_message, $conf_headers);


                    
                    echo "<h1>Thank You, " . $user_name . "</h1>";
                    echo "<h3>We will get your download link to you shortly.</h3>";
                    echo "<p>If you have any questions or would like to check the status, please contact <a href='mailto:kuhrt.cowan@ttu.edu'>Kuhrt Cowan</a>.</p>";
                } else {
                    echo "<h1>Bummer! Something went wrong.</h1>";
                    $errors = $resp->getErrorCodes();
                    if (in_array("missing-input-response", $errors)) {
                        echo "<p>Please complete and verify the captcha at the bottom of the form to get your message to send.<br><br><a href=\"index.html\">Go Back</a></p>";
                    } else {
                        echo "<p>I'm so sorry, the problem is on our side. Please try again! If you get this message again, please copy the error codes below and email it to <a href=\"mailto:kuhrt.cowan@ttu.edu\">kuhrt.cowan@ttu.edu</a> along with your message and I will get it taken care of. Sorry for the inconvenience!</p><strong>Errors:</strong><br><ul>";
                        foreach ($errors as $error) {
                            echo "<li>" . $error . "</li>";
                        }
                        echo "</ul>";
                    }
                    exit();
                }
                
            ?>
            
        </section>
               
        <footer>
            <div>
                <a href="http://www.facebook.com/TTUMCOM"><i class="fa fa-facebook-square fa-2x"></i></a>
                <a href="http://twitter.com/TTU_MCOM"><i class="fa fa-twitter-square fa-2x"></i></a>
                <a href="https://www.youtube.com/user/TTUMCOM/featured"><i class="fa fa-youtube-square fa-2x"></i></a>
            </div>
        </footer>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/libs/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="assets/js/libs/jquery.velocity.min.js"></script>
        <script src="assets/js/main.js"></script>
        </script>
    </body>
</html>
