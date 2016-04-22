<?php

  $pageTitle = "Applying | Parent Portal | CoMC | TTU";

  include '../inc/header.php';
?>

  <div id="applying">

    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div class="title">
        <h1>Applying</h1>
      </div>
      <div class="scrollDown">
        <li>
          Scroll Down
        </li>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <section id="howToApply" class="row large-collapse" data-equalizer>

      <h2>My student is<hr /></h2>

      <div class="large-6 columns" data-equalizer-watch>

        <div class="applyBanner">
            <div class="freshman">Incoming Freshman</div>
        </div>

        <div id="freshman" class="freshmanContainer">

          <ol type='1'>
            <li>Submit a freshman application at <a href='https://www.applytexas.org/adappc/gen/c_start.WBX'>ApplyTexas</a> and pay an application fee.</li>

            <li>Send a official high school transcript with GPA and class rank to the Office of Undergraduate Admission.
              <br />
              <br />
              <div>
                Undergraduate Admissions
                <br />
                2500 Broadway
                <br />
                Box 45005
                <br />
                Lubbock, TX 79409-5005
                <br />
                Phone: 806.742.1480
              </div>
              <br />
            </li>

            <li>College entrance test scores, SAT or ACT, send from the testing agency at the time the test is taken.</li>

            <li>
              Individuals who are not high school graduates may be eligible for admission to Texas Tech University when the following have been submitted:
              <br />
              <br />
              <div>
                I. Application for Admission.
                <br />
                II. Scores on the SAT or ACT.
                <br />
                III. Current Application Fee.
              </div>
              <br />
            </li>
          </ol>

        </div>

      </div>


      <div class="large-6 columns " data-equalizer-watch>

        <div class="applyBanner">
            <div class="transfer">Transfer Student</div>
        </div>

        <div id='transfer' class="transferContainer">

          <div class='transferInfo'>
            Applicants after their first semester of college should apply as transfer students but also meet the following:
          </div>

          <ol>
            <li>Freshman admission requirements.</li>
            <li>Submit SAT or ACT scores.</li>
            <li>Provide a high school transcript with graduation date.</li>
          </ol>

        </div>

      </div>

      <div class="small-12 columns">
        <div class='contactUs'>
          If you have any questions, give us a call: <a href='tel:806-742-1480'>806.742.1480</a>
          <br />
          <br />
          Or send us an email: <a href="mailto:admissions@ttu.edu">admissions@ttu.edu</a>
          <br />
          <br />
          <a href='http://www.depts.ttu.edu/officialpublications/catalog/_admit_requirements.php' rel='nowfollow'>More detailed information may be found here.</a>
        </div>
      </div>


    </section>



  </div>

<?php include '../inc/footer.php'; ?>
