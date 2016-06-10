<?php

  $pageTitle = "Parents | CoMC | TTU";
  $pageDescription = "The College of Media &amp; Communication recognizes the important role parents play in their students’ education.";
  $pageURL = "http://www.depts.ttu.edu/comc/parents/";

  include 'inc/header.php';
?>
  <section id="landing" class="page1 active">

    <div id="container" class="container">
      <div id="output">
      </div>
    </div>

    <div id="title">
      <img id="logoWords" src="img/CoMC-logo-white.svg" alt="College of Media &amp; Communication" title="College of Media &amp; Communication" />
      <h1>Parents</h1>
    </div>
    <div class="scrollDown">
      <p>
        Scroll Down
      </p>
      <img src="img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
    </div>
  </section>

  <section id="parent-video">
    <div id="video-play">
      <p>
        <a href="" class="button">Hear from our parents!<br /><i class="fa fa-youtube-play fa-2x"></i></a>
      </p>
    </div>
    <div id="video">
      <iframe id="player" width="560" height="315" src="https://www.youtube.com/embed/zj6zcLw2vDQ" frameborder="0" allowfullscreen></iframe>
    </div>
  </section>

  <section id="overview">
    <section class="dark-grey info">
      <div class="row">
        <p>
          The College of Media &amp; Communication recognizes the important role parents play in their students’ education. It is with parents in mind that we have created this information and resource section. From details about what to do in Lubbock to finding financial resources and support to learning about our engaging faculty, we have compiled a wealth of information for parents to peruse. We hope you find it helpful.
        </p>
      </div>
    </section>
    <section class="square-menu-container">
      <div class="square-menu">
        <a href="<?php echo BASE_URL; ?>careers/" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-building fa-3x">

            </figure>
            <p>
              What kind of career can my student have?
            </p>
          </div>
        </a>
        <a href="<?php echo BASE_URL; ?>why-comc/" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-heart fa-3x">

            </figure>
            <p>
              Why CoMC?
            </p>
          </div>
        </a>
        <a href="<?php echo BASE_URL; ?>applying/" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-pencil fa-3x">

            </figure>
            <p>
              How does my student apply?
            </p>
          </div>
        </a>
        <a href="<?php echo BASE_URL; ?>financial-aid/" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-money fa-3x">

            </figure>
            <p>

              Is there help with the cost?

            </p>
          </div>
        </a>
      </div>
    </section>
  </section>

  <section id="interested">
    <div id="question">
      <h2>
        My student is interested in&nbsp;
        <select>
          <optgroup>
            <option value="select">
              -- Select an Area --
            </option>
            <option value="Adv">
              Advertising
            </option>
            <option value="Coms">
              Communication Studies
            </option>
            <option value="EMC">
              Electronic Media and Communications
            </option>
            <option value="Jour">
              Journalism
            </option>
            <option value="MS">
              Media Strategies
            </option>
            <option value="PR">
              Public Relations
            </option>
          </optgroup>
        </select>
      </h2>
      <p>
        CoMC consists of four academic departments offering a total of six undergraduate and four graduate degrees. Undergraduates can earn a Bachelor of Arts degree in: advertising, communication studies, electronic media and communications, journalism, media strategies, and public relations.
      </p>
    </div>
    <div id="description" class="row">
      <p>
        The Department of Advertising develops leaders with an understanding of the creative and business-related aspects of advertising in the current media landscape.<br><br>Students participate in a rigorous degree program that provides the background and training to become leaders in advertising communication. Advertising majors gain an understanding of the creative and business-related aspects of advertising, including copywriting, sales, production, creative strategy, design and layout, media planning, and research. We also host industry professionals who speak to students about internships and careers in advertising.<br><br>More information in the TTU catalog:<br><a href="http://catalog.ttu.edu/preview_entity.php?catoid=2&ent_oid=190&returnto=184" class="button" target="_blank">More Info...</a>
      </p>
    </div>
  </section>


  <script>
    $('.scrollDown').click(function() {
      $('html,body').animate({
        scrollTop: $('#parent-video').position().top - 70
      }, 800);
    });

    $("#video-play .button").click(function(e) {
      e.preventDefault();
      $('#video').css({'opacity': '1', 'pointer-events': 'auto'});
      $("#player")[0].src += "?autoplay=1";
    });
  </script>

<?php include 'inc/footer.php'; ?>
