<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Alumni | CoMC | TTU</title>

  <link rel="stylesheet" type="text/css" href="/comcsite/css/ttu.css" />
  <link rel="stylesheet" type="text/css" href="css/alumni.css" />

  <script src="/comcsite/js/modernizr.js"></script>
	<script src="/comcsite/js/ttuglobal.js"></script>
	<script src="/comcsite/js/ttuglobal-onload.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

  <style>
    p {
      max-width: 860px;
    }
  </style>

</head>
<body>
  <?php require_once($_SERVER["DOCUMENT_ROOT"] . '/CoMCSite/includes/ttu-body-head.php'); ?>




  <h1>Alumni</h1>

  <!-- ADD MAIN CONTENT BELOW THIS LINE -->
  <section class="row">
    <div class="small-12 column">
      <p><strong>Welcome Alumni! </strong></p>
      <p>This page is designed to help you keep track of what is going on with the College of Media &amp; Communication (formerly the College of Mass Communications) at Texas Tech University.</p>
      <p>We are interested in what you would like to see on this page or on our web site. Please provide your suggestions or comments through our <a href="/comc/alumni/feedback.php">Alumni News and Feedback Form</a>.</p>
      <p>Join our alumni email list below to be included in college updates, Converging News and more!<br /> <a class="btnlink" title="Alumni Email List" href="http://ttu.us2.list-manage.com/subscribe?u=9002e32332ced3c311f7fadcc&amp;id=2440c417a3" target="_blank">Subscribe</a></p>
    </div>
  </section>
  <section class="row" id="career-list">
    <div class="small-12 column">
      <h2>Check out what some of our alumni are doing!</h2>

      <div id="alumni-titles">
        <div id="career-cube">
          <div class="cube">
            <div class="cube-face cube-face-front"><p>Digital Community Promotions Producer - <em>KCBD-TV-Lubbock, Texas</em></p></div>
            <div class="cube-face cube-face-top"><p>&nbsp;</p></div>
            <div class="cube-face cube-face-back"><p>&nbsp;</p></div>
            <div class="cube-face cube-face-bottom"><p>&nbsp;</p></div>
            <div class="cube-face cube-face-left"></div>
            <div class="cube-face cube-face-right"></div>
          </div>
        </div>
        <div id="controls">
          <p>
            <a href="#" class="back icon-left">&nbsp;</a>
            <a href="#" class="forward icon-right">&nbsp;</a>
          </p>
        </div>
      </div>

    </div>
  </section>
  <section class="row">
    <div class="small-12 column">
      <h3>From this page you may wish to visit:</h3>
      <ul>
        <li><a href="/comc/alumni/alumniupdates.php">Alumni Updates</a></li>
        <li><a href="/comc/about/publications/converging/index.php">Converging News</a></li>
        <li><a href="/comc/alumni/halloffame.php">Hall of Fame<br /></a></li>
        <li><a href="/comc/alumni/outstandingalumni.php">Outstanding Alumni</a></li>
        <li><a href="/comc/alumni/pioneers.php">Pioneers of the TAB</a></li>
        <li>Wendell Mays Jr. award-winning editorial <a href="/comc/alumni/files/wendell-mays-jr-editorial-one.mp3">one</a> &amp; <a href="/comc/alumni/files/wendell-mays-jr-editorial-two.mp3">two</a>.</li>
      </ul>
      <h4>For the MC:</h4>
      <ul>
        <li>Do you <a href="/comc/alumni/rememberme.php">remember me</a>?</li>
        <li><a href="/comc/about/publications/mc/">The MC</a></li>
      </ul>
    </div>
  </section>
  <section class="row">
    <div class="small-12 column">
      <h2>Alumni News</h2>
      <?php $_REQUEST['cat'] = 'Alumni';include ($_SERVER['DOCUMENT_ROOT']."/comc/utilities11/newsfeed.php"); ?>
      <p><a class="external" href="/comc/programs/journalism/newsarchiveemc.php">News Archive</a></p>
    </div>
  </section>
  <script src="/comc/includes/js/alumni.js"></script>
  <!-- ADD MAIN CONTENT ABOVE THIS LINE -->




  <?php require_once($_SERVER["DOCUMENT_ROOT"] . '/comcsite/includes/ttu-body-foot.php'); ?>
</body>
</html>
