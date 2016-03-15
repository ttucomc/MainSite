<?php
/*

  Mario Jimenez
  03/14/16
  Texas Tech University
  College of Mass Communications

*/
?>

<section id="visit">

  <div class="masterImageContainer">
    <div class="imageContainer">
      <img src="../img/seal-high.jpg" alt="TTU Seal" />
      <img src="../img/mem-circle-high.jpg" alt="TTU Memorial Circle" />
      <img src="../img/cmc-high.jpg" alt="TTU COMC Building" />
      <img src="../img/library-high.jpg" alt="TTU Library" />
    </div>
    <img src="../img/map-marker.png" alt="Location Marker Icon" class="marker" />
    <div class="transparent">

    </div>
  </div>

  <div class="dailyTours">
    <h2 class="dailyTours">Daily Tours <hr /></h2>
    <p>
      Me? i'm dishonest, and a dishonest man you can always trust to be dishonest.
      honestly. it's the honest ones you want to watch out for,
      because you can never predict when they're going to do something incredibly... stupid.
    </p>
  </div>

  <div class="visitLocal">
    <h2>Visit TTU Local Branch</h2>

    <p>
      Me? i'm dishonest, and a dishonest man you can always trust to be dishonest.
      honestly. it's the honest ones you want to watch out for,
      because you can never predict when they're going to do something incredibly... stupid.
    </p>
  </div>

  <div class="virtualTour">
    <h2>Virtual Tour <hr /></h2>
      <p>Visit Texas Tech using our virtual tour</p>

      <div>
        Virtual tour goes here
      </div>
  </div>

  <h2>More Information</h2>

  <p>
    Find more information here, link here.
  </p>


</section>

<script>

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
