<?php
/*

  Mario Jimenez
  03/14/16
  Texas Tech University
  College of Mass Communications

*/
?>
<script src="http://cdn.youvisit.com/Assets/js/tour/embed/embed.min.js?v=2.16.03.17"></script>
<script type="text/javascript" src="http://www.youvisit.com/tour/Embed/js2" defer=""></script>
<script>

  //Scrolling images JS
  $(document).ready(function(){
    $('.imageContainer').slick({
      autoplay: true,
      autoplaySpeed: 7500,
      speed: 1350,
      arrows: false,
      pauseOnHover: false,
    });
  });

</script>

<section id="visit">

  <div class="masterImageContainer">

    <div class="visit-cards">
      <div class="large-6 columns visit-card">
        <div class="dailyTours">
          <h2>Daily Tours</h2>
          <p>
            We conduct campus tours Monday through Friday at 8:30 a.m. and 1 p.m. and at 8:30 a.m. on select Saturday mornings.
            <br /><br />Plan to spend a whole day with us.
            <br />Meet our students. Hear their stories. Find out why they love Texas Tech!
          </p>
          <p>
            <a href='http://www.depts.ttu.edu/admissions/visit-events/' class="button">More information</a>
          </p>
        </div>
      </div>

      <div class="large-6 columns visit-card">
        <div class="virtualTour">
            <h2>Virtual Tour</h2>
            <p>Can't make it to campus?<br />Check out Texas Tech virtually!</p>
            <br />
            <div class="tourContainer">
              <a class="virtualtour_embed" title="Virtual Reality, Virtual Tour" href="http://www.youvisit.com" data-platform="v" data-link-type="image" data-inst="59975" data-image-width="100%" data-image-height="200">Virtual Tour</a>
            </div>
        </div>
      </div>
    </div>

    <div class="imageContainer">
      <div id="ttu_1"></div>
      <div id="ttu_2"></div>
      <div id="ttu_3"></div>
    </div>
  </div>

</section>
