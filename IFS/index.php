<?php

	require_once('database.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://www.depts.ttu.edu/_ttu-template/design/style.css">
		<link rel="stylesheet" href="http://www.depts.ttu.edu/comc/includes/foundation/css/foundation.css">
		<link rel="stylesheet" href="http://www.depts.ttu.edu/comc/includes/css/animate.css">
		<link rel="stylesheet" type="text/css" href="temp.css">

		<script type="text/javascript" src="foundation/js/vendor/jquery.js"></script>
		<script type="text/javascript" src="foundation/js/foundation/foundation.js"></script>
		<script type="text/javascript" src="foundation/foundation.equalizer.js"></script>

		<meta itemprop="name" content="International Film Series | CoMC | TTU">
	    <meta itemprop="description" content="The International Film Series out of the College of Media &amp; Communication at Texas Tech. Join IFS as we bring international and independent cinema to the South Plains.">
	    <meta itemprop="image" content="http://www.depts.ttu.edu/comc/ifs/images/og-image.png">

	    <meta name="twitter:card" content="summary_large_image">
	    <meta name="twitter:site" content="@IntlFilmTTU">
	    <meta name="twitter:title" content="International Film Series | CoMC | TTU">
	    <meta name="twitter:description" content="The International Film Series out of the College of Media &amp; Communication at Texas Tech. Join IFS as we bring international and independent cinema to the South Plains.">
	    <meta name="twitter:creator" content="@IntlFilmTTU">
	    <meta name="twitter:image:src" content="http://www.depts.ttu.edu/comc/ifs/images/og-image.png">


	    <meta property="og:title" content="International Film Series | CoMC | TTU"/>
	    <link href="http://www.depts.ttu.edu/comc/ifs/" rel="canonical" />
	    <meta property="og:url" content="http://www.depts.ttu.edu/comc/ifs/"/>
	    <meta property="og:description" content="The International Film Series out of the College of Media &amp; Communication at Texas Tech. Join IFS as we bring international and independent cinema to the South Plains.">
	    <meta property="og:type" content="website"/>
	    <meta property="og:site_name" content="International Film Series"/>
	    <meta property="og:image" content="http://www.depts.ttu.edu/comc/ifs/images/og-image.png"/>
	</head>
	<body>
		<div id="header-img" class="ifs-section"><img class="animated fadeIn" style="display: block; margin-left: auto; margin-right: auto;" src="images/IntlFilmSeriesLogo.svg" alt="International Film Series Logo" width="650" height="auto" />
			<h2 class="animated fadeIn" style="text-align: center;">Bringing international and independent cinema to the South Plains</h2>
		</div>
		<section class="ifs-section">
			<div class="row">
				<div class="small-12 columns">
					<h2 id="fall-h2">Spring 2016 Schedule</h2>
				</div>
			</div>
			<?php

			try {
				$results = $db->query("
				SELECT *
				FROM movies
				ORDER BY show_date ASC");
			} catch (Exception $e) {
				echo 'Could not get the data from the database.';
				exit;
			}

			$movies = $results->fetchAll(PDO::FETCH_ASSOC);

			foreach($movies as $movie) {

				$movie_image = $movie['image'];

				$mysql_show_date = strtotime($movie['show_date']);
				$show_date = date('F d', $mysql_show_date);

				$mysql_show_time = strtotime($movie['show_time']);
				$show_time = date('g:i A', $mysql_show_time);

				if ($mysql_show_date >= time()) {
					include("movies.php");
				}
			};
			?>
		</section>
	</body>
</html>
