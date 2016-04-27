<?php

  $pageTitle = "Why CoMC? | Parent Portal | CoMC | TTU";

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

    <!-- EVENTS SECTION -->
    <section id="events">

      <h2>Events</h2>
      <hr />



      <?php

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


      ?>

    </section>

    <br />

    <section id="lubbock">
      <h2>What is there to do in lubbock?</h2>
      <br />
      <div class="listContainer">

        <div class="listGroup">
          <div class="listTitle">Only in Lubbock</div>
          <ul>
            <li><a href="http://ffat.org/" rel="nofollow">First Friday Art Trail</a></li>
            <li><a href="https://www.facebook.com/thechoclatemousse/info/?tab=overview" rel="nofollow">Choc’late Mousse Pie Bar</a></li>
            <li><a herf="https://www.mylubbock.us/departmental-websites/departments/parks-recreation/prairie-dog-town" rel="nofollow">Prairie Dog Town</a></li>
          </ul>
        </div>

        <div class="listGroup">
          <div class="listTitle">Where to study</div>
          <ul>
            <li><a href="http://www.jandbcoffeeco.com/" rel="nofollow">J&amp;B Coffee Co.</a></li>
            <li><a href="http://yellowhousecoffee.com/" rel="nofollow">Yellow House Coffee</a></li>
            <li><a href="http://www.gatsbyscoffeehouse.com/" rel="nofollow">Gatsby's Coffeehouse</a></li>
          </ul>
        </div>

        <div class="listGroup">
          <div class="listTitle">Outdoor Pursuits</div>
          <ul>
            <li>
              <ul>
                <li>Golfing</li>
                <li>Disc Golf</li>
                <li>Parks</li>
                <li>Walking Trails</li>
                <li>Lubbock Water Rampage</li>
                <li>Lake Alan Henry</li>
                <li>Randsom Canyon</li>
              </ul>
            </li>
            <li>
              <p class='subHead'>Nearby Lubbock</p>
              <ul>
                <li>Palo Duro Canyon (1.5 hour drive)</li>
                <li>Caprock Canyons (2 hour drive)</li>
                <li>Buffalo Springs Lake (30 minute drive)</li>
              </ul>
            </li>
          </ul>
        </div>

      </div>

    </section>


    <!-- STUDENT OPPORTUNITIES SECTION -->

    <section>

      <h2 class="studentOpportuntiesTitle">Student Opportunites</h2>
      <hr />
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

<?php include '../inc/footer.php'; ?>
