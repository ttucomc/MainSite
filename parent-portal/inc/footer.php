<!-- Vendor JS -->
<script src="<?php echo BASE_URL; ?>js/greensock/TweenMax.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
<script src="<?php echo BASE_URL; ?>js/scrollmagic/plugins/animation.gsap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>

<!-- MAIN JS -->
<script src="<?php echo BASE_URL; ?>js/triangles.js"></script>
<script src="<?php echo BASE_URL; ?>js/menu.js"></script>
<script src="<?php echo BASE_URL; ?>js/main.js"></script>

<script type="text/javascript">
  // wrapping each h1 letter in spans
  // $(".title h1").children().andSelf().contents().each(function(){
  //     var $this = $(this);
  //     $this.replaceWith($this.text().replace(/(\w)/g, "<span>$&</span>"));
  // });

  // Kicking off ScrollMagic
  var controller = new ScrollMagic.Controller();

  // Calling growing h1
  new ScrollMagic.Scene({
        triggerElement: '.title',
        triggerHook: 'onLeave',
        offset: -125
      })
      .setTween(TweenMax.to(".title h1", 0.5, {scale: 10, opacity: 0 }))
      .addTo(controller);

</script>

<script>
  $('.scrollDown').click(function() {
    $('html,body').animate({
      scrollTop: $('#overview').position().top - 70
    }, 800);
  });
</script>



</body>
</html>
