<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>College of Media &amp; Communication</title>

	<link rel="stylesheet" type="text/css" href="../../css/ttu.css">
	<link rel="stylesheet" type="text/css" href="../../css/styles.css">
	<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../css/animate.css">
	<!-- <link rel="stylesheet" type="text/css" href="../../css/home.css"> -->

	<script src="../../js/modernizr.js"></script>
	<script src="../../js/ttuglobal.js"></script>
	<script src="../../js/ttuglobal-onload.js"></script>
	<script src="../../js/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- <script src="../../js/home.js"></script> -->

    <!-- OUR CUSTOM HEAD START -->
    <meta itemprop="name" content="College of Media &amp; Communication | TTU">
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
    <meta property="og:image" content="http://www.depts.ttu.edu/comc/images/home/og-image.jpg"/>
    <!-- OUR CUSTOM HEAD END -->
</head>
<body>
  <?php include('../../includes/ttu-body-head.php'); ?>

    <h1>Give to a Scholarship</h1>

    <!-- CoMC edits start here -->

    <?php

    	require_once('/comc/includes/ttu-db-config.php');
      require_once('/comc/includes/ttu-db.php');

      try {

        $results = $db->prepare('SELECT * FROM dbo.scholarship');
        $results->execute();

      } catch (Exception $e) {
        echo "Data could not be retrieved from the database." . $e->getMessage();
        exit;
      }

      $scholarships = $results->fetchAll(PDO::FETCH_ASSOC);

      foreach ($scholarships as $scholarship) {
        echo $scholarship['name'] . "<br />";
      }

    ?>

    <h3>Search Tips</h3>
    <p class="style2">For any &quot;search,&quot; the search engine takes whatever you enter into the search box and locates exact matches. If you enter the word &quot;minority&quot; it will NOT find cases of &quot;minorities.&quot; If you wanted to find both, you would enter &quot;minorit&quot; as your search term.</p>

    <h3>Find scholarships  by major</h3>
        <?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="by_major" id="by_major">'; ?>
          <select name="major" id="major">
            <option value="Please">- Please Select -</option>
            <option value="Advertising">Advertising</option>
            <option value="Electronic Media &amp; Comm">Electronic Media &amp; Comm</option>
            <option value="Journalism">Journalism</option>
            <option value="Mass Communications">Mass Communications</option>
            <option value="Photocommunications">Photocommunications</option>
            <option value="Public Relations">Public Relations</option>
            <option value="Graduate">Graduate</option>
          </select>
          <br />
          <select name="type" id="type">
            <option value="Please">- Please Select -</option>
            <option value="External">External Scholarships</option>
            <option value="Internal">Internal Scholarships</option>
            <option value="Both">Both Internal and External</option>
          </select>
          <input type="submit" name="Submit" value="Find" />
        <?php echo '</form>'; ?>

      <h3>Search a scholarship by name</h3>
      <p>Enter the name of the scholarship or of its sponsor in the field below.
        Hint: Try using just one name (such as the last name).</p>
      <form action="get_ssname.php" method="post" name="find_name" id="find_name">
        <input name="s_name" type="text" id="s_name" size="25" maxlength="30" />
        &nbsp;&nbsp;
        <input name="launch_name" type="submit" id="launch_name" value="Search" />
      </form>

      <!-- CoMC edits end here -->

  <?php include('../../includes/ttu-body-foot.php'); ?>
</body>
</html>
