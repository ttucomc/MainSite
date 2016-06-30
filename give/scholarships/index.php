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
		// If a form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'):

			// If they selected a major
			if(isset($_POST["Submit"])) {
	      if ($_POST[major] == "Please") {
	  			exit("<h2>Please select a major</h2>");
	      }

	    	$approved = array("Advertising","Electronic Media and Communications","Journalism","CoMC","Public Relations","Graduate","Photocommunications");
	    	if (!in_array($_POST[major], $approved)) { die ("<h3>Your major is not approved.</h3>"); }

	    	$typeapproved = array("Internal","External","Both");
	    	if (!in_array($_POST[type], $typeapproved)) { die ("<h3>Your scholarship type is not approved.</h3>"); }
			}


    	require_once('/comc/includes/ttu-db-config.php');
      require_once('/comc/includes/ttu-db.php');

      ?>

			<?php if(isset($_POST["Submit"])): // If they selected a major?>

				<h2><?php if($_POST[type] == 'Both'): echo 'All'; else: echo "$_POST[type]"; endif; ?> Scholarships Available to <?php echo "$_POST[major]"; ?> Students</h2>
				<?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="by_major" id="by_major">'; ?>
					<select id="major" name="major">
						<option value="Please">- Please Select -</option>
						<option value="CoMC">Any CoMC Major</option>
						<option value="Advertising">Advertising</option>
						<option value="Electronic Media and Communications">Electronic Media and Communications</option>
						<option value="Journalism">Journalism</option>
						<option value="Public Relations">Public Relations</option>
						<option value="Graduate">Graduate</option>
					</select>
					<br />
					<input type="hidden" name="type" value="Both" />
					<input type="submit" value="Find" name="Submit" />
				<?php echo '</form>'; ?>
				<br />
				<p><small>For any "search," the search engine takes whatever you enter into the search box and locates exact matches. If you enter the word "minority" it will NOT find cases of "minorities." If you wanted to find both, you would enter "minorit" as your search term.</small></p>
		    <?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="find_name" id="find_name">'; ?>
		      <input name="s_name" type="text" id="s_name" size="25" maxlength="30" />
		      &nbsp;&nbsp;
		      <input name="Search" type="submit" id="launch_name" value="Search" />
		    <?php echo '</form>'; ?>

				<?php

				$type = '%'.$_POST[type].'%';
				$major = '%'.$_POST[major].'%';

	      if ($_POST[type] == "Both") {

	        try {
	          $results = $db->prepare("SELECT * FROM scholarship WHERE (major1 like ? OR major2 like ? OR major1 like '%CoMC%' OR major2 like '%CoMC%') ORDER BY name");
						$results->bindParam(1, $major, PDO::PARAM_STR);
						$results->bindParam(2, $major, PDO::PARAM_STR);
	          $results->execute();
	        } catch (Exception $e) {
	          echo "Scholarships could not be retrieved from the database.";
	        }
	        $scholarships = $results->fetchAll(PDO::FETCH_ASSOC);

	      } elseif ($_POST[major]!="Graduate") {

	        try {
	          $results = $db->prepare("SELECT * FROM scholarship WHERE type like ? AND (major1 like ? OR major2 like ? OR major1 like '%CoMC%' OR major2 like '%CoMC%') ORDER BY name");
						$results->bindParam(1, $type, PDO::PARAM_STR);
						$results->bindParam(2, $major, PDO::PARAM_STR);
						$results->bindParam(3, $major, PDO::PARAM_STR);
	          $results->execute();
	        } catch (Exception $e) {
	          echo "Scholarships could not be retrieved from the database.";
	        }
	        $scholarships = $results->fetchAll(PDO::FETCH_ASSOC);

	      } else {

	        try {
	          $results = $db->prepare("SELECT * FROM scholarship WHERE type like ? AND major1 like '%Graduate%' OR major2 like '%Graduate%' ORDER BY name");
						$results->bindParam(1, $type, PDO::PARAM_STR);
	          $results->execute();
	        } catch (Exception $e) {
	          echo "Scholarships could not be retrieved from the database.";
	        }
	        $scholarships = $results->fetchAll(PDO::FETCH_ASSOC);

	      }

	      ?>
				<?php foreach($scholarships as $scholarship): ?>
					<?php
	          $current_dead = new DateTime($scholarship['last_dead']);
	          $current_dead = $current_dead->format('m/d/Y');
	        ?>
					<?php if ($scholarship['type'] != "Internal"): ?>
						<article>
							<table>
								<thead>
									<tr><th><?php echo $scholarship['name']; ?> (<em><?php echo $scholarship['type']; ?></em>)</th></tr>
								</thead>
								<tbody>
									<tr>
										<td>Provided by <?php echo $scholarship['grantor']; ?></td>
									</tr>
									<tr>
										<td>Awarded to <?php echo $scholarship['major1']; if($scholarship['major2']!="" && $scholarship['major2']!=" "): echo ' and ' . $scholarship['major2'] . ' students.'; else: echo ' students.'; endif;?></td>
									</tr>
									<tr>
										<td><strong>Amount:</strong> $<?php echo sprintf("%0.0f",$scholarship['amount']); ?> awarded in <?php echo $scholarship['number'] . ' ' . $scholarship['type']; if($scholarship['number'] > 1): echo ' scholarships'; else: echo ' scholarship'; endif; echo ' ' . $scholarship['frequency'] . '.'; ?></td>
									</tr>
									<tr>
										<td><strong>General Deadline:</strong>&nbsp;<?php echo $scholarship['gen_dead']; ?>&nbsp;&nbsp;<strong>Current Deadline:</strong>&nbsp;<?php echo $current_dead; ?></td>
									</tr>
									<tr>
										<td><strong>Scholarship Description:</strong><br /><?php echo $scholarship['description']; ?></td>
									</tr>
									<tr>
										<td><strong>Special Requirements:</strong><br /><?php echo $scholarship['special']; ?></td>
									</tr>
									<tr>
										<td><strong>Application Process:</strong><br /> <?php if($scholarship['sort1'] != ""): ?> <?php echo $scholarship['process'] . '<br />Online: <a href="' . $scholarship['sort1'] . '" target="_blank">' . $scholarship['sort1'] . '</a>'; ?> <?php else: ?> <?php echo $scholarship['process']; ?> <?php endif; ?></td>
									</tr>
								</tbody>
							</table>
						</article>

						<?php elseif($scholarship['type'] == "Internal"): ?>

						<article>
							<table>
								<thead>
									<tr><th><?php echo $scholarship['name']; ?> (<em><?php echo $scholarship['type']; ?></em>)</th></tr>
								</thead>
								<tbody>
									<tr>
										<td>Provided by <?php echo $scholarship['grantor']; ?></td>
									</tr>
									<tr>
										<td>Awarded to <?php echo $scholarship['major1']; if($scholarship['major2']!="" && $scholarship['major2']!=" "): echo ' and ' . $scholarship['major2'] . ' students.'; else: echo ' students.'; endif;?></td>
									</tr>
									<tr>
										<td><strong>General Deadline:</strong>&nbsp;<?php echo $scholarship['gen_dead']; ?>&nbsp;&nbsp;<strong>Current Deadline:</strong>&nbsp;<?php echo $current_dead; ?></td>
									</tr>
									<tr>
										<td><strong>Scholarship Description:</strong><br /><?php echo $scholarship['description']; ?></td>
									</tr>
									<tr>
										<td><strong>Special Requirements:</strong><br /><?php echo $scholarship['special']; ?></td>
									</tr>
								</tbody>
							</table>
						</article>

					<?php endif; ?>
				<?php endforeach; ?>
			<?php elseif(isset($_POST["Search"])): // If they searched for a term?>
				<?php
					 $banished = array("!","@","#","$","%","*","(",")");
					 if 	 (strstr ($_POST[s_name], "#")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], ")")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], "$")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], "@")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], "%")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], "!")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strstr ($_POST[s_name], "(")) {die ("Your search term contains unapproved characters. Please go back and revise your search.");
					 }elseif (strlen($_POST[s_name]) >20) {
						die ("Your search term is too long; please go back and shorten it.");
					}
				?>

				<h2>Scholarships containing &quot;<?php echo htmlspecialchars("$_POST[s_name]"); ?>&quot; </h2>
				<p><small>For any "search," the search engine takes whatever you enter into the search box and locates exact matches. If you enter the word "minority" it will NOT find cases of "minorities." If you wanted to find both, you would enter "minorit" as your search term.</small></p>
		    <?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="find_name" id="find_name">'; ?>
		      <?php echo '<input name="s_name" type="text" id="s_name" size="25" maxlength="30" value="'. htmlspecialchars($_POST[s_name]) . '" />'; ?>
		      &nbsp;&nbsp;
		      <input name="Search" type="submit" id="launch_name" value="Search" />
		    <?php echo '</form>'; ?>
				<p>
					Search by major instead.
				</p>
				<?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="by_major" id="by_major">'; ?>
					<select id="major" name="major">
						<option value="Please">- Please Select -</option>
						<option value="CoMC">Any CoMC Major</option>
						<option value="Advertising">Advertising</option>
						<option value="Electronic Media and Communications">Electronic Media and Communications</option>
						<option value="Journalism">Journalism</option>
						<option value="Public Relations">Public Relations</option>
						<option value="Graduate">Graduate</option>
					</select>
					<br />
					<input type="hidden" name="type" value="Both" />
					<input type="submit" value="Find" name="Submit" />
				<?php echo '</form>'; ?>

				<?php

				$q = htmlspecialchars($_POST[s_name]);
				$q = '%' . $q . '%';

				// Querying the db with search term
				try {
					$results = $db->prepare("SELECT * FROM scholarship WHERE name like ? OR grantor like ? OR description like ? ");
					$results->bindParam(1, $q, PDO::PARAM_STR);
					$results->bindParam(2, $q, PDO::PARAM_STR);
					$results->bindParam(3, $q, PDO::PARAM_STR);
					$results->execute();
				} catch (Exception $e) {
					echo "Scholarships could not be retrieved from the database." . $e->getMessage();
				}
				$scholarships = $results->fetchAll(PDO::FETCH_ASSOC);

				if(empty($scholarships)){
					echo "<h4>I'm sorry, no scholarships matched your search! Please try again!</h4>";
					exit();
				}
				?>
				<?php foreach($scholarships as $scholarship): ?>
					<?php
	          $current_dead = new DateTime($scholarship['last_dead']);
	          $current_dead = $current_dead->format('m/d/Y');
	        ?>
					<?php if ($scholarship['type'] != "Internal"): ?>
						<article>
							<table>
								<thead>
									<tr><th><?php echo $scholarship['name']; ?> (<em><?php echo $scholarship['type']; ?></em>)</th></tr>
								</thead>
								<tbody>
									<tr>
										<td>Provided by <?php echo $scholarship['grantor']; ?></td>
									</tr>
									<tr>
										<td>Awarded to <?php echo $scholarship['major1']; if($scholarship['major2']!="" && $scholarship['major2']!=" "): echo ' and ' . $scholarship['major2'] . ' students.'; else: echo ' students.'; endif;?></td>
									</tr>
									<tr>
										<td><strong>Amount:</strong> $<?php echo sprintf("%0.0f",$scholarship['amount']); ?> awarded in <?php echo $scholarship['number'] . ' ' . $scholarship['type']; if($scholarship['number'] > 1): echo ' scholarships'; else: echo ' scholarship'; endif; echo ' ' . $scholarship['frequency'] . '.'; ?></td>
									</tr>
									<tr>
										<td><strong>General Deadline:</strong>&nbsp;<?php echo $scholarship['gen_dead']; ?>&nbsp;&nbsp;<strong>Current Deadline:</strong>&nbsp;<?php echo $current_dead; ?></td>
									</tr>
									<tr>
										<td><strong>Scholarship Description:</strong><br /><?php echo $scholarship['description']; ?></td>
									</tr>
									<tr>
										<td><strong>Special Requirements:</strong><br /><?php echo $scholarship['special']; ?></td>
									</tr>
									<tr>
										<td><strong>Application Process:</strong><br /> <?php if($scholarship['sort1'] != ""): ?> <?php echo $scholarship['process'] . '<br />Online: <a href="' . $scholarship['sort1'] . '" target="_blank">' . $scholarship['sort1'] . '</a>'; ?> <?php else: ?> <?php echo $scholarship['process']; ?> <?php endif; ?></td>
									</tr>
								</tbody>
							</table>
						</article>

						<?php elseif($scholarship['type'] == "Internal"): ?>

						<article>
							<table>
								<thead>
									<tr><th><?php echo $scholarship['name']; ?> (<em><?php echo $scholarship['type']; ?></em>)</th></tr>
								</thead>
								<tbody>
									<tr>
										<td>Provided by <?php echo $scholarship['grantor']; ?></td>
									</tr>
									<tr>
										<td>Awarded to <?php echo $scholarship['major1']; if($scholarship['major2']!="" && $scholarship['major2']!=" "): echo ' and ' . $scholarship['major2'] . ' students.'; else: echo ' students.'; endif;?></td>
									</tr>
									<tr>
										<td><strong>General Deadline:</strong>&nbsp;<?php echo $scholarship['gen_dead']; ?>&nbsp;&nbsp;<strong>Current Deadline:</strong>&nbsp;<?php echo $current_dead; ?></td>
									</tr>
									<tr>
										<td><strong>Scholarship Description:</strong><br /><?php echo $scholarship['description']; ?></td>
									</tr>
									<tr>
										<td><strong>Special Requirements:</strong><br /><?php echo $scholarship['special']; ?></td>
									</tr>
								</tbody>
							</table>
						</article>

					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php else: ?>
			<h2>Find scholarships by major</h2>
			<?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="by_major" id="by_major">'; ?>
				<select id="major" name="major">
					<option value="Please">- Please Select -</option>
					<option value="CoMC">Any CoMC Major</option>
					<option value="Advertising">Advertising</option>
					<option value="Electronic Media and Communications">Electronic Media and Communications</option>
					<option value="Journalism">Journalism</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Graduate">Graduate</option>
				</select>
				<br />
				<input type="hidden" name="type" value="Both" />
				<input type="submit" value="Find" name="Submit" />
			<?php echo '</form>'; ?>
			<h3>Search a scholarship by name</h3>
	    <p>Enter the name of the scholarship or of its sponsor in the field below.
	      Hint: Try using just one name (such as the last name).</p>
			<p><small>For any "search," the search engine takes whatever you enter into the search box and locates exact matches. If you enter the word "minority" it will NOT find cases of "minorities." If you wanted to find both, you would enter "minorit" as your search term.</small></p>
	    <?php echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" name="find_name" id="find_name">'; ?>
	      <input name="s_name" type="text" id="s_name" size="25" maxlength="30" />
	      &nbsp;&nbsp;
	      <input name="Search" type="submit" id="launch_name" value="Search" />
	    <?php echo '</form>'; ?>
		<?php endif; ?>

      <!-- CoMC edits end here -->

  <?php include('../../includes/ttu-body-foot.php'); ?>
</body>
</html>
