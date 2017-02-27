<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Council | Graduate | CoMC | TTU</title>

  <link rel="stylesheet" type="text/css" href="../../css/ttu.css">
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css">

  <script src="../../js/modernizr.js"></script>
  <script src="../../js/ttuglobal.js"></script>
  <script src="../../js/ttuglobal-onload.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- OUR CUSTOM HEAD START -->
    <link rel="stylesheet" type="text/css" href="../css/graduate.css" />


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

  <?php include '../../includes/ttu-body-head.php'; ?>
  <h1>CoMC Graduate Council</h1>


  <!-- CoMC Edits Start -->


  <?php

    include '/comc/graduate/council/inc/AgendaItem.class.php';
    include '/comc/graduate/council/inc/Agenda.class.php';
    include '/comc/graduate/council/inc/Minute.class.php';
    include '/comc/graduate/council/inc/Minutes.class.php';
    include '/comc/graduate/council/inc/Meeting.class.php';

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
  <p>
      The College of Media &amp; Communication Graduate Council represents the interests of the graduate faculty at large, debates and vets policy options, presents policy options to college graduate faculty for consideration and brings issues to attention of the college graduate program administration. <a href="/comc/graduate/opmanual/" class="button">Graduate Operating Policies</a>&nbsp;<a href="#members" class="button">Council Members</a>
  </p>
  <section>
      <h2>Latest Meeting</h2>
      <?php

        // Creating agenda items to be added to the agenda
        $agendaItem1 = new AgendaItem('Comments from Dean Perlmutter');
        $agendaItem2 = new AgendaItem('Finalize Graduate Program OPs; prep for dissemination/discussion with graduate faculty');
        $agendaItem3 = new AgendaItem('Discuss draft proposal for 4th year of PHD funding (competitive award)');
        $agendaItem4 = new AgendaItem('Doctoral student visit');
        $agendaItem5 = new AgendaItem('Time permitting:');
        $agendaItem5->addItem('Discuss PHD program cognates');
        $agendaItem5->addItem('Discuss MAMC capstone project (6050 project)');
        $agendaItem6 = new AgendaItem('Other business');

        // Creating the agenda and adding all items
        $agenda = new Agenda();
        $agenda->addItem($agendaItem1);
        $agenda->addItem($agendaItem2);
        $agenda->addItem($agendaItem3);
        $agenda->addItem($agendaItem4);
        $agenda->addItem($agendaItem5);
        $agenda->addItem($agendaItem6);

        // Creating minute items and their sub-items
        $minute1 = new Minute('Discussion of 4th Year PHD Funding Proposal');
        $minute1->addPoint('Dean Perlmutter expressed his concerns and goals for the program; clarified that the funding is intended to support exceptional students and increase their market value.');
        $minute1->addPoint('Dean also stated that he needed to verify availability of funding annually.');
        $minute1->addPoint('Dr. Seltzer to revise existing proposal per Dean’s comments and send to the Council for further revision/comment.');

        $minute2 = new Minute('PHD Admissions');
        $minute2->addPoint('Council voted unanimously to admit five strong applicants and fund four (the fifth did not request funding).');
        $minute2->addPoint('Dr. Seltzer will set up an online survey so that Council can review remaining applicants (those who have submitted completed packets to date), vote whether to admit/fund, and rank order applicants so that Dr. Callison can prioritize targeted recruits. Council will complete evaluations by Thurs., Feb. 23.');
        $minute2->addPoint('Council granted Dr. Callison authority to make offers to potential doctoral students given the constraints of the recruiting timeline.');

        $minute3 = new Minute('Graduate Program OPs');
        $minute3->addPoint('Due to limited time, Dr. Seltzer requested that faculty review the current draft of the OPs and submit any substantive, major changes to the group for consideration via email.');
        $minute3->addPoint('Revisions to be submitted no later than Mar. 6.');
        $minute3->addPoint('Dr. Kent Wilkinson will resend his suggested revisions for consideration by the group.');
        $minute3->addPoint('Goal is to have a draft of the OPs out to the graduate faculty for feedback so that they can be finalized at Mar. 20 meeting and then submitted to faculty for a vote');
        $minute3->addPoint('Dr. Seltzer stated he wanted the OPs finalized before the Graduate Program Review onsite team arrives in April.');

        $minute4 = new Minute('Other Business');
        $minute4->addPoint('Next meeting scheduled for Mar. 20, 2017, 2-3:30 p.m.');
        $minute4->addPoint('Council identified Graduate Faculty Status Review procedures as next priority once OPs finalized.');

        $minute5 = new Minute('Meeting adjourned at 3:40');

        // Creating the minutes and adding the individual minutes
        $minutes = new Minutes();
        $minutes->addAttendee('Dr. Coy Callison');
        $minutes->addAttendee('Dr. Rob Peaslee');
        $minutes->addAttendee('Dr. Kent Wilkinson');
        $minutes->addAttendee('Dr. Erik Bucy');
        $minutes->addAttendee('Dr. John Velez');
        $minutes->addAttendee('Dr. Andy King');
        $minutes->addAttendee('Dr. Melanie Sarge');
        $minutes->addAttendee('Dr. Eric Rasmussen');
        $minutes->addAttendee('Dr. Amy Heuman');
        $minutes->addAttendee('Dr. Trent Seltzer (chair)');
        $minutes->addAttendee('Dr. Shayla Hammock (minutes)');
        $minutes->addAttendee('Dean Perlmutter');
        $minutes->addAttendee('Kevin Stoker');
        $minutes->addAttendee('Marilda Oviedo');
        $minutes->addMinute($minute1);
        $minutes->addMinute($minute2);
        $minutes->addMinute($minute3);
        $minutes->addMinute($minute4);
        $minutes->addMinute($minute5);

        // Creating the meeting and adding it's agenda and minutes
        $meeting = new Meeting('Mon., Feb. 20, 2017, 2:00-3:30 p.m.', 'CoMC 156');
        $meeting->addAgenda($agenda);
        $meeting->addMinutes($minutes);
        $meetingAgenda = $meeting->getAgenda();
        $meetingMinutes = $meeting->getMinutes();

        // Displaying the meeting time and location
        echo "<h4>". $meeting->getDate() . "<br />" . $meeting->getLocation() . "</h4>";

      ?>
      <div class="row">
          <div class="medium-6 columns">

              <h3>Agenda</h3>
              <?php echo "<ol class=\"default-list\">"; ?>
                  <?php foreach($meetingAgenda->getItems() as $item): ?>
                      <?php echo "<li>"; ?>
                          <?php echo $item->getTitle(); ?>
                          <?php if($item->lengthOfItems() > 0 ): ?>
                              <ul>
                              <?php foreach($item->getListItems() as $subItem): ?>
                                  <li>
                                      <?php echo $subItem; ?>
                                  </li>
                              <?php endforeach; ?>
                              </ul>
                          <?php endif; ?>
                      <?php echo "</li>"; ?>
                  <?php endforeach; ?>
              <?php echo "</ol>"; ?>

          </div>
          <div class="medium-6 columns">

              <h3>Minutes</h3>
              <p>
                  <strong>Attending: </strong><?php echo implode(', ', $meetingMinutes->getAttendees()); ?>
              </p>
              <?php echo "<ol class=\"default-list\">"; ?>
                  <?php foreach($meetingMinutes->getMinutes() as $minute): ?>
                      <?php echo "<li>"; ?>
                          <?php echo $minute->getTitle(); ?>
                          <?php if($minute->lengthOfPoints() > 0 ): ?>
                              <ul>
                              <?php foreach($minute->getPoints() as $point): ?>
                                  <li>
                                      <?php echo $point; ?>
                                  </li>
                              <?php endforeach; ?>
                              </ul>
                          <?php endif; ?>
                      <?php echo "</li>"; ?>
                  <?php endforeach; ?>
              <?php echo "</ol>"; ?>

          </div>
      </div>

  </section>

  <section id="members">
      <h2>Council Members</h2>
      <?php foreach ($members as $member): ?>
          <article class="member row">
              <div class="medium-3 columns"><?php echo "<img src=\"/comc/faculty/images/" . $member["photo"] . "\" alt=\"" . $member["name"] . "\" title=\"" . $member["name"] . "\" />"; ?></div>
              <div class="medium-9 columns">
                  <h3><?php echo $member["name"]; ?></h3>
                  <hr />
                  <h4><?php echo $member["title"]; ?></h4>
                  <p><?php echo "<a href=\"mailto:" . $member["email"] . "\" class=\"mail\">" . $member["email"] . "</a>" ?></p>
              </div>
          </article>
    <?php endforeach; ?>
  </section>


  <!-- CoMC Edits End -->



  <?php include '../../includes/ttu-body-foot.php'; ?>

</body>
</html>
