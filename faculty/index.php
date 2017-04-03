<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include ('inc/config.php');
    include ('inc/classes/database.class.php');

    $db = new Database();

?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Faculty &amp; Staff | CoMC | TTU</title>

  <link rel="stylesheet" type="text/css" href="css/ttu.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

  <script src="js/modernizr.js"></script>
  <script src="js/ttuglobal.js"></script>
  <script src="js/ttuglobal-onload.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- OUR CUSTOM HEAD START -->


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
    <!-- OUR CUSTOM HEAD END -->
</head>
<body>

  <?php include 'inc/ttu-body-head.php'; ?>


  <!-- CoMC Edits Start -->



  <!-- CoMC Edits End -->



  <?php include 'inc/ttu-body-foot.php'; ?>

</body>
</html>
