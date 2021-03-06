<?php

  $pageTitle = "Applying | Parents | CoMC | TTU";
  $pageDescription = "Learn the steps it takes to apply and get your student into the College of Media & Communication here.";
  $pageURL = "http://www.depts.ttu.edu/comc/parents/applying/";

  include '../inc/header.php';
?>

  <div id="applying">

    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div id="title">
        <h1>Applying</h1>
      </div>
      <div class="scrollDown">
        <p>
          Scroll Down
        </p>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <section id="howToApply" class="row large-collapse" data-equalizer>

      <h2>How to Apply</h2>

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
            <li>
              If your student has been accepted to the university, select a major within CoMC and they are in the program! There is no additional admissions process for the college.
            </li>
          </ol>

        </div>

      </div>


      <div class="large-6 columns grey-background" data-equalizer-watch>

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
            <li>
              If your student has been accepted to the university, select a major within CoMC and they are in the program! There is no additional admissions process for the college.
            </li>
          </ol>

        </div>

      </div>
    </section>
    <section id="contact-container" class="row">
      <div class="small-12 columns">
        <div id='contactUs'>
          If you have any questions, give us a call: <a href='tel:8067421480'>806.742.1480</a>
          <br />
          <br />
          Or send us an email: <a href="mailto:admissions@ttu.edu">admissions@ttu.edu</a>
          <br />
          <br />
          <a href='http://catalog.ttu.edu/content.php?catoid=2&navoid=156' target='_blank' class="button">More detailed information may be found here</a>
        </div>
      </div>
    </section>

  </div>

  <script>
  $('.scrollDown').click(function() {
    $('html,body').animate({
      scrollTop: $('#howToApply').position().top - 70
    }, 800);
  });
  </script>

<?php include '../inc/footer.php'; ?>
