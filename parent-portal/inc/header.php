<?php require_once("config.php"); ?>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
	<title><?php echo $pageTitle; ?></title>

  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/foundation.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/styles.css">

  <!-- Vendor Imports -->
  <script src="<?php echo BASE_URL; ?>js/modernizr.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/slick.css">



    <!-- Metadata we'll update later -->
    <!-- <meta itemprop="name" content="College of Media &amp; Communication | TTU">
    <meta itemprop="description" content="Check out the College of Media &amp; Communication at Texas Tech University. Discover the power of being a great communicator.">
    <meta itemprop="image" content="http://www.depts.ttu.edu/comc/images/home/og-image.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ttu_comc">
    <meta name="twitter:title" content="College of Media &amp; Communication | TTU">
    <meta name="twitter:description" content="Check out the College of Media &amp; Communication at Texas Tech University. Discover the power of being a great communicator.">
    <meta name="twitter:creator" content="@ttu_comc">
    <meta name="twitter:image:src" content="http://www.depts.ttu.edu/comc/images/home/og-image.jpg">


    <meta property="og:title" content="College of Media &amp; Communication | TTU"/>
    <link href="http://www.depts.ttu.edu/comc/" rel="canonical" />
    <meta property="og:url" content="http://www.depts.ttu.edu/comc/"/>
    <meta property="og:description" content="Check out the College of Media &amp; Communication at Texas Tech University. Discover the power of being a great communicator.">
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="College of Media & Communication"/>
    <meta property="og:image" content="http://www.depts.ttu.edu/comc/images/home/og-image.jpg"/> -->

</head>
<body>
  <header>

    <?php

    /*

    Be sure to Include this at the bottom of every page header is included

    <!-- TTU JS -->
    <script src="js/menu.js"></script>
    */

    //Declare images
    $ttuLogo = "./img/TTU-logo.svg";

    $landingIcon = "./img/comc-hand.svg";
    $whyIcon = "./img/comc-hand.svg";
    $careerIcon = "./img/comc-hand.svg";
    $applyIcon = "./img/comc-hand.svg";

    ?>
    <div id="TTULogo">
      <img src="<?php echo BASE_URL; ?>img/TTU-logo.svg" />
    </div>

    <div id=buttonMasterContainer>
      <div id="buttonContainer">
          <div id="button">
          </div>
      </div>
    </div>

    <div id="menuMasterContainer">
      <div class="menuBoxContainer">

        <!-- Start Top Row -->
        <div class="row small-collapse fullWidth">
          <div class="medium-6 columns">

            <!-- Landing Menu -->
            <a href='#'>
              <div class="menuBox financial-background">
                <div class="title">Financial Aid</div>
              </div>
            </a>
          </div>

          <div class="medium-6 columns">

            <!-- Why COMC Menu -->
            <a href='#'>
              <div class="menuBox why-background">
                <div class="title">Why COMC?</div>
              </div>
            </a>
          </div>
        </div>
        <!-- End Top Row -->

        <!-- Start Bottom Row -->
        <div class="row small-collapse fullWidth">

          <!-- Career Menu -->
          <div class="medium-6 columns">
            <a href='#'>
              <div class="menuBox career-background">
                <div class="title">Career</div>
              </div>
            </a>
          </div>

          <!-- Apply Menu -->
          <div class="medium-6 columns">
            <a href='#'>
              <div class="menuBox apply-background">
                <div class="title">Apply</div>
              </div>
            </a>
          </div>
        </div>
        <!-- End Bottom Row -->

      </div>
    </div>

  </header>
