<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>OP Manual | Graduate | CoMC | TTU</title>

  <link rel="stylesheet" type="text/css" href="../../css/ttu.css">
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css">

  <script src="../../js/modernizr.js"></script>
  <script src="../../js/ttuglobal.js"></script>
  <script src="../../js/ttuglobal-onload.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- OUR CUSTOM HEAD START -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/graduate.css" />

</head>

<body>
  <?php include '../../includes/ttu-body-head.php'; ?>

  <h1>Graduate Council</h1>

  <?php

    $members = array(
                array('name' => 'Erik Bucy', 'title' => 'At-Large Representative, Graduate Student Recruitment & Retention Subcommittee Chair', 'email' => 'erik.bucy@ttu.edu', 'photo' => 'ebucy.jpg'),
                array('name' => 'Amy Heuman', 'title' => 'Communication Studies Representative', 'email' => 'amy.heuman@ttu.edu', 'photo' => 'aheuman.jpg'),
                array('name' => 'Andy King', 'title' => 'At-Large Representative, Ph.D. Career Development Subcommittee Chair', 'email' => 'andy.king@ttu.edu', 'photo' => 'aking.jpg'),
                array('name' => 'Robert Peaslee', 'title' => 'At-Large Representative, Graduate Scholarship Subcommittee Chair', 'email' => 'robert.peaslee@ttu.edu', 'photo' => 'rpeaslee.jpg'),
                array('name' => 'Eric Rasmussen', 'title' => 'Public Relations Representative', 'email' => 'eric.rasmussen@ttu.edu', 'photo' => 'erasmussen.jpg'),
                array('name' => 'Melanie Sarge', 'title' => 'Advertising Representative', 'email' => 'melanie.sarge@ttu.edu', 'photo' => 'msarge.jpg'),
                array('name' => 'Trent Seltzer', 'title' => 'Council Chair', 'email' => 'trent.seltzer@ttu.edu', 'photo' => 'tseltzer.jpg'),
                array('name' => 'John Velez', 'title' => 'Journalism & Electronic Media Representative', 'email' => 'john.velez@ttu.edu', 'photo' => 'jvelez.jpg'),
                array('name' => 'Kent Wilkinson', 'title' => 'At-Large Representative', 'email' => 'kent.wilkinson@ttu.edu', 'photo' => 'kwilkinson.jpg')
               );

  ?>

  <section id="members">
    <h2>Council Members</h2>

    <?php foreach ($members as $member): ?>
    <article class="member row">
      <div class="medium-3 columns">
        <?php echo "<img src=\"/comc/faculty/images/" . $member["photo"] . "\" alt=\"" . $member["name"] . "\" title=\"" . $member["name"] . "\" />"; ?>
      </div>
      <div class="medium-9 columns">
        <h3><?php echo $member["name"]; ?></h3>
        <hr />
        <h4><?php echo $member["title"]; ?></h4>
        <p>
          <?php echo "<a href=\"mailto:" . $member["email"] . "\" class=\"mail\">" . $member["email"] . "</a>" ?>
        </p>
      </div>
    </article>
    <?php endforeach; ?>

  </section>

  <?php include '../../includes/ttu-body-foot.php'; ?>
</body>


</html>
