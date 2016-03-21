<?php
/*

  Mario Jimenez
  03/14/16
  Texas Tech University
  College of Mass Communications

*/
?>
<script src="http://cdn.youvisit.com/Assets/js/tour/embed/embed.min.js?v=2.16.03.17"></script>

<section id="visit">

  <div class="masterImageContainer">
    <div class="imageContainer">
      <div id="ttu_1"></div>
      <div id="ttu_2"></div>
      <div id="ttu_3"></div>
      <div id="ttu_4"></div>
    </div>

    <i class="fa fa-map-marker marker"></i>
    <div class="transparent">
      <div class="dailyTours">
        <h2 class="dailyTours">Daily Tours</h2>
        <p>
          Me? i'm dishonest, and a dishonest man you can always trust to be dishonest.
          honestly. it's the honest ones you want to watch out for,
          because you can never predict when they're going to do something incredibly... stupid.
        </p>
      </div>
    </div>
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

      <div class="tourContainer">
        <a class="virtualtour_embed" title="Virtual Reality, Virtual Tour" href="http://www.youvisit.com" data-platform="v" data-link-type="image" data-inst="59975" data-image-width="100%" data-image-height="100">Virtual Tour</a>
      </div>
  </div>

  <div class="moreInfo">
    <h2>More Information <hr /></h2>

    <p>
      Find more information here, link here.
    </p>
  </div>

</section>

<script type="text/javascript" src="http://www.youvisit.com/tour/Embed/js2" defer=""></script>

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
