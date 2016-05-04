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

  // Overall if statement to determine if the form as been submitted or not
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  ?>


  <?php

    } else { // Ends overall if statement, opens else

      $campaign_id = 0;
      // if an ID is specified in the query string, use it
      if (isset($_GET["id"])) {
      	$campaign_id = intval($_GET["id"]);
      }

      $campaigns = array(
        // Brand Recruitment
        array(
          'Campaign' => 'Now Online',
          'Title' => 'The Strategic Communication Master\'s Degree',
          'Text' => 'Earn your Masters of Strategic Communication degree from Texas Tech University! Accredited, convenient 100% online. Update your skills to be competitive in today\'s global and digitally focused environment. Learn more now! The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/people'
        ),
        array(
          'Campaign' => 'For Professionals',
          'Title' => 'Texas Tech University Online Strategic Communication MA',
          'Text' => 'Pursue the Master\'s in Strategic Communication from Texas Tech University 100% online. Contact the College of Media & Communication today to learn more about our Online MA designed for professionals. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/animals'
        ),
        array(
          'Campaign' => 'Advance Your Career',
          'Title' => 'The Online Strategic Communication MA',
          'Text' => 'Earn your MA in Strategic Communication from Texas Tech University to advance your skills, career and earning power. Complete in as few as 18 months. Learn more now. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/abstract'
        ),
        array(
          'Campaign' => 'Completion in as Few as 18 Months',
          'Title' => 'Texas Tech University MA 100% Online',
          'Text' => 'Rolling enrollment starts any term. Thirty hour program is accelerated, accredited and online. Contact us today for more information. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/business'
        ),
        array(
          'Campaign' => '100% Online From Texas Tech University',
          'Title' => 'The MA Degree For Professionals',
          'Text' => 'The Online MA Program is accredited, rigorous and taught by full-time faculty. Take your next career step with a focus on global and digital strategic communication. Visit our website to learn more. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/cats'
        ),
        // Enrollment Deadlines
        array(
          'Campaign' => 'Application deadlines approaching.',
          'Title' => 'Texas Tech University Online Graduate MA Program Deadline',
          'Text' => 'Earn an MA in Strategic Communication through our Online Courses! Admission is limited - apply now. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/city'
        ),
        array(
          'Campaign' => 'No GRE required based on applicant qualifications.',
          'Title' => 'Master\'s in Strategic Communication Online from Texas Tech University Applications Due',
          'Text' => 'Deadlines approaching and class size is limited. Start your application today. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/food'
        ),
        array(
          'Campaign' => 'Accredited, Accelerated & Online From Texas Tech University.',
          'Title' => 'Application Deadlines For The Online MA Approaching',
          'Text' => 'No GRE required based on applicant qualifications. Apply now for next term admission. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/nightlife'
        ),
        array(
          'Campaign' => 'Apply Today',
          'Title' => 'MA Strategic Communications Texas Tech University',
          'Text' => 'Thirty hour program completes in as few as 18 months. 100% Online taught by full time faculty. Act now to meet enrollment deadlines. Admission is limited. The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/fashion'
        ),
        array(
          'Campaign' => 'Deadlines Coming Soon',
          'Title' => 'Study Strategic Communication Online at Texas Tech University',
          'Text' => 'Further your career by earning an MA degree focusing on global and digital strategic communication. Program deadlines approaching - apply today! The Degree You Want.',
          'Photo' => 'http://lorempixel.com/1920/1920/sports'
        )
      );

      $campaign = $campaigns[$campaign_id];

      // Setting variables for content
      $title = $campaign['Title'];
      $subTitle = $campaign['Campaign'];
      $text = $campaign['Text'];
      $photo = $campaign['Photo'];

  ?>

  <section id="top" class="container-fluid" style="background-image:url('<?php echo $photo; ?>')">
    <div class="row text-center">
      <div class="col-sm-8 col-sm-offset-2">
        <h1><?php echo $title; ?></h1>
        <h2><?php echo $subTitle; ?></h2>
        <p>
          <?php echo $text; ?>
        </p>
      </div>
    </div>
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
            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="tel" id="phone" name="phone" class="form-control" required />
            </div>
            <input type="hidden" name="campaign" value="<?php echo $campaign_id; ?>" />
            <input type="submit" value="Submit" class="btn btn-primary btn-block" />
          </fieldset>
        </form>
      </div>
    </div>
  </section>

  <?php } // Ends overall else statement ?>
</body>
</html>
