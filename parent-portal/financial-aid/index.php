<?php

  $pageTitle = "Financial Aid | Parents | CoMC | TTU";
  $pageDescription = "See the cost of your student attending CoMC and see financial aid and scholarship options to help!";
  $pageURL = "http://www.depts.ttu.edu/comc/parents/financial-aid/";

  include '../inc/header.php';
?>

  <div id="cost">

    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div id="title">
        <h1>Financial Aid</h1>
      </div>
      <div class="scrollDown">
        <p>
          Scroll Down
        </p>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <section id="scholarships">
      <h2>Scholarships</h2>
      <div class="row">
        <p>
          Scholarships offered through CoMC can be found using the general <a href="https://www.applytexas.org/" target="_blank">Apply Texas</a> form. The college adheres to the same deadlines as general scholarships.
        </p>
        <p id="deadline">
          DEC 1st
        </p>
        <h3>Deadline for the 2017-18 School Year</h3>
        <p>
          Scholarship recipients are selected by a committee of faculty and staff from CoMC. -	Students will receive an acceptance form when they are offered a scholarship. This form must be completed and returned to the College of Media &amp; Communication scholarship coordinator.
        </p>
        <p>
          <a href="http://www.depts.ttu.edu/scholarships/ScholarshipsFAQ.php" target="_blank" class="button">More Scholarship Information</a>
        </p>
      </div>
    </section>

    <section id="cost-to-attend">
      <div class="row">
        <h2>Cost to Attend</h2>
        <h3>Undergraduate Tuition &amp; Fees for the 2017-18 Academic Year</h3>
        <p class="fees">
          $10,772
        </p>
        <p>
          <a href="http://www.depts.ttu.edu/financialaid/costToAttend.php" target="_blank" class="button">See Detailed Costs Here</a>
        </p>
        <div id="calculator">
          <p>
            The Office of Financial Aid &amp; Scholarships provides a calculator for you to see a detailed estimate of the cost for your student.
            <br />
            <a href="http://www.depts.ttu.edu/financialaid/netCostCalcHome.php" class="button" target="_blank">Net Cost Calculator</a>
          </p>
        </div>
      </div>
    </section>

  </div>

  <script>
  $('.scrollDown').click(function() {
    $('html,body').animate({
      scrollTop: $('#scholarships').position().top - 70
    }, 800);
  });
  </script>

<?php include '../inc/footer.php'; ?>
