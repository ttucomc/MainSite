<?php

  $pageTitle = "Why CoMC? | Parent Portal | CoMC | TTU";

  include '../inc/header.php';
?>

  <div id="why-comc">

    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div class="title">
        <h1>Why CoMC?</h1>
      </div>
      <div class="scrollDown">
        <p>
          Scroll Down
        </p>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <?php include 'visit.php' ?>

    <?php include 'events.php' ?>

    <section>

      <div class="studentOpportuntiesContainer">

          <?php

            include 'studentopportunties.php';

            foreach ($studentOpportunties as $key => $value) {
              ?>
                <div class="studentItems">
                  <h6><?php echo $value['title']; ?></h6>
                  <br />
                  <p><?php echo $value['description']; ?></p>
                  <div class="contactContainer">
                    <div class="email"><?php echo $value['url']; ?></div>
                    <?php if(!empty($value["twitter"])) { ?>
                    <div class="twitter"><?php echo $value['twitter']; ?></div>
                    <?php } ?>
                  </div>
                </div>
              <?php
            }

          ?>

      </div>

    </section>

  </div>

<?php include '../inc/footer.php'; ?>
