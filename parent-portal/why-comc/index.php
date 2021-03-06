<?php

  $pageTitle = "Why CoMC? | Parents | CoMC | TTU";
  $pageDescription = "We know there's a million choices on which school your student can pick. See why the College of Media & Communication is the best choice!";
  $pageURL = "http://www.depts.ttu.edu/comc/parents/why-comc/";

  include '../inc/header.php';
?>

  <div id="why-comc">

    <!-- MAIN TITLE SECTION -->
    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div id="title">
        <h1>Why CoMC?</h1>
      </div>
      <div class="scrollDown">
        <p>
          Scroll Down
        </p>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <!-- VISIT TTU SECTION -->
    <?php include 'visit.php' ?>

    <!-- FACTULY SECTION -->
    <section id='faculty'>

      <h2>Faculty</h2>

      <div class="row">
        <div class="large-6 columns">
          <div class="faculty">

            <!-- <i class="fa fa-university fa-5x"></i> -->
            <h3>Experience</h3>
            <p>
              Our award-winning faculty bring real-world experiences into the classroom every day.
              Each department within the College of Media &amp; Communication boasts faculty members with experience working in a variety of media organizations—from small non-profits to large media companies.
              This background provides unique opportunities for your students to learn.
              Our faculty are creative, innovative and approachable—willing to answer any questions you and your student have about academic and career opportunities.
            </p>
          </div>
        </div>

        <div class="large-6 columns">

          <div class="faculty">

            <!-- <i class="fa fa-graduation-cap fa-5x"></i> -->
            <h3>Research</h3>
            <p>
              As a Tier 1 research institution, Texas Tech CoMC faculty bring their research into the classroom, allowing undergraduate students to learn about and even participate in media and communication-related academic study.
              Recent topics our faculty are researching include: video games and their effects, social media and the environment, children’s television programming, sports media broadcasts and how they are produced, and dozens of others.
            </p>

            <i class="fa fa-heart fa-5x"></i>
          </div>
        </div>
      </div>

      <a href="https://www.depts.ttu.edu/comc/faculty/" class="button">Meet our Faculty &amp; Staff</a>

    </section>

    <!-- EVENTS SECTION
    <section id="events">

      <h2>Events</h2>
      <hr />


      <?php

        /*

        include 'events.php';

        foreach($events as $key => $value) {
          ?>

          <div class="eventContainer mdl-shadow--2dp">
            <div class="eventDate">
              <div class="eventTitle"><?php echo $value['title']; ?></div>
              <br />
              <span><?php echo $value['month']; ?></span><span class="day"><?php echo $value['day']; ?></span><span>'<?php echo $value['year']; ?></span>
            </div>

            <div class="eventLocation"><?php echo $value['location']; ?></div>
            <p><?php echo $value['description']; ?></p>
          </div>
          <br />

          <?php
        }

        */

      ?>

    </section> -->

    <section id="lubbock">
      <h2>What is there to do in lubbock?</h2>

      <br />
      <div class="listContainer">

        <div class="listGroup">
          <div class="listTitle">Only in Lubbock</div>
          <ul>
            <li>
              <a href="http://www.visitlubbock.org" target="_blank">Visit Lubbock</a>
            </li>
            <li><a href="http://ffat.org/" target="_blank" rel="nofollow">First Friday Art Trail</a></li>
            <li><a href="https://www.facebook.com/piebarlubbock/" target="_blank" rel="nofollow">Choc’late Mousse Pie Bar</a></li>
            <li><a href="https://www.mylubbock.us/departmental-websites/departments/parks-recreation/prairie-dog-town" target="_blank" rel="nofollow">Prairie Dog Town</a></li>
            <li><a href="https://issuu.com/lajonline/docs/bol2015" target="_blank" rel="nofollow">Best of Lubbock 2015</a></li>
          </ul>
        </div>

        <div class="listGroup">
          <div class="listTitle">Where to study</div>
          <ul>
            <li><a href="http://www.jandbcoffeeco.com/" target="_blank" rel="nofollow">J&amp;B Coffee Co.</a></li>
            <li><a href="http://yellowhousecoffee.com/" target="_blank" rel="nofollow">Yellow House Coffee</a></li>
            <li><a href="http://www.gatsbyscoffeehouse.com/" target="_blank" rel="nofollow">Gatsby's Coffeehouse</a></li>
          </ul>
        </div>

        <div class="listGroup">
          <div class="listTitle">Outdoor Pursuits</div>
          <div class="row">
            <div class="large-6 columns">
              <p class='subHead'>Lubbock</p>
              <ul>
                <li>Golfing</li>
                <li>Disc Golf</li>
                <li>Parks</li>
                <li>Walking Trails</li>
                <li>Lubbock Water Rampage</li>
                <li>Lake Alan Henry</li>
                <li>Ransom Canyon</li>
              </ul>
            </div>
            <div class="large-6 columns">
              <p class='subHead'>Nearby Lubbock</p>
              <ul>
                <li>Palo Duro Canyon (1.5 hour drive)</li>
                <li>Caprock Canyons (2 hour drive)</li>
                <li>Buffalo Springs Lake (30 minute drive)</li>
              </ul>
            </div>
          </div>
        </div>

      </div>

    </section>


    <!-- STUDENT OPPORTUNITIES SECTION -->

    <section id="opportunities">

      <h2 class="studentOpportuntiesTitle">Student Opportunites</h2>
      <br /><br /><br />
      <div class="studentOpportuntiesContainer">

          <?php

            include 'studentopportunties.php';

            foreach ($studentOpportunties as $key => $value) {
              ?>
                <div class="studentItems">
                  <h4><?php echo $value['title']; ?></h4>
                  <br />
                  <p><?php echo $value['description']; ?></p>
                  <div class="contactContainer">

                    <div class="email">

                    <?php if(!empty($value["url"])) { ?>

                      <a href="http://<?php echo $value['url']; ?>" target="_blank">Visit Us</a>

                    <?php } ?>

                    </div>

                    <div class="twitter">

                    <?php if(!empty($value["twitter"])) {

                      //We need to cut the '@' from the twitter handle to link it to twitter.

                      $twitterLink = substr($value['twitter'], 1, strlen($value['twitter']));

                      ?>

                        <a href="http://www.twitter.com/<?php echo $twitterLink; ?>/" target="_blank"><?php echo $value['twitter']; ?></a>

                    <?php } ?>

                    </div>
                  </div>
                </div>
              <?php
            }

          ?>

      </div>

    </section>

  </div>

  <script>
  $('.scrollDown').click(function() {
    $('html,body').animate({
      scrollTop: $('#visit').position().top - 70
    }, 800);
  });
  </script>

<?php include '../inc/footer.php'; ?>
