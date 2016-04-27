<footer>
  <div class="row">
    <div class="medium-4 columns end">
      <a href="http://comc.ttu.edu"><img src="<?php echo BASE_URL; ?>img/CoMC-horizontal-logo.svg" alt="College of Media &amp; Communication" title="College of Media &amp; Communication" /></a>
    </div>
  </div>
</footer>

<!-- Vendor JS -->
<script src="<?php echo BASE_URL; ?>js/greensock/TweenMax.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
<script src="<?php echo BASE_URL; ?>js/scrollmagic/plugins/animation.gsap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/slick.min.js"></script>

<!-- MAIN JS -->
<script src="<?php echo BASE_URL; ?>js/triangles.js"></script>
<script src="<?php echo BASE_URL; ?>js/menu.js"></script>
<script src="<?php echo BASE_URL; ?>js/main.js"></script>

<script type="text/javascript">
  $(document).foundation();

  // Kicking off ScrollMagic
  var controller = new ScrollMagic.Controller();

  // Calling growing h1
  new ScrollMagic.Scene({
        triggerElement: '#logoWords',
        triggerHook: 'onLeave',
        offset: -125
      })
      .setTween(TweenMax.to(".title h1", 0.5, {scale: 10, opacity: 0 }))
      .addTo(controller);

</script>




</body>
</html>
