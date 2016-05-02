<footer>
  <div class="row" data-equalizer>
    <div class="medium-4 columns" data-equalizer-watch>
      <a href="http://comc.ttu.edu"><img src="<?php echo BASE_URL; ?>img/CoMC-horizontal-logo.svg" alt="College of Media &amp; Communication" title="College of Media &amp; Communication" /></a>
    </div>
    <div class="medium-4 columns" id="resources-btn" data-equalizer-watch>
      <a>More Resources</a>
    </div>
  </div>
  <div class="row" id="resources">
    <div class="medium-5 medium-offset-1 columns">
      <ul>
        <li>
          <a href="http://www.texastechparents.org/" target="_blank">TTU Parents Association</a>
        </li>
        <li>
          <a href="http://www.depts.ttu.edu/registrar/private/transfer/" target="_blank">TTU Transfer Equivalency</a>
        </li>
        <li>
          <a href="https://www.depts.ttu.edu/tsi/" target="_blank">Texas Success Initiative</a>
        </li>
        <li>
          <a href="http://www.depts.ttu.edu/admissions/visit-events/" target="_blank">Visit TTU</a>
        </li>
      </ul>
    </div>
    <div class="medium-5 columns end">
      <ul>
        <li>
          <a href="http://www.depts.ttu.edu/admissions/" target="_blank">TTU Admissions</a>
        </li>
        <li>
          <a href="http://www.depts.ttu.edu/admissions/payforcollege/index.php" target="_blank">Pay for College</a>
        </li>
        <li>
          <a href="http://www.depts.ttu.edu/financialaid/netCostCalcHome.php" target="_blank">Net Cost Calculator</a>
        </li>
        <li>
          <a href="http://www.depts.ttu.edu/comc/advising/" target="_blank">Advising</a>
        </li>
      </ul>
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
        triggerElement: '#title',
        triggerHook: 'onLeave',
        offset: -125
      })
      .setTween(TweenMax.to("#title h1", 0.5, {scale: 10, opacity: 0 }))
      .addTo(controller);


  // Show/Hide Resources in footer
  $('#resources-btn').click(function() {
    $('#resources').slideToggle('slow');
    $('html, body').animate({ scrollTop: $(document).height() }, 'slow');
    $('#resources-btn a').toggleClass('show');
  });

</script>




</body>
</html>
