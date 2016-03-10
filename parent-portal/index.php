<?php include 'inc/header.php'; ?>
  <section id="landing" class="page1 active">
    <div id="container" class="container">
      <div id="output">
      </div>
    </div>
    <div class="title">
      <!-- <img id="comcHand" src="img/comc-hand.svg" alt="My Adventure, My Degree, MyCoMC" title="My Adventure, My Degree, #MyCoMC" /> -->
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
  <section id="overview">
    <section class="dark-grey info">
      <div class="row">
        <p>
          Well, then, i confess, it is my intention to commandeer one of these ships, pick up a crew in tortuga, raid, pillage, plunder and otherwise pilfer my weasely black guts out. me? i'm dishonest, and a dishonest man you can always trust to be dishonest. honestly. it's the honest ones you want to watch out for, because you can never predict when they're going to do something incredibly... stupid. me?
        </p>
      </div>
    </section>
    <section class="square-menu-container">
      <div class="square-menu">
        <a href="" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-building fa-3x">

            </figure>
            <p>
              What kind of career can my student have?
            </p>
          </div>
        </a>
        <a href="" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-heart fa-3x">

            </figure>
            <p>
              Why CoMC?
            </p>
          </div>
        </a>
        <a href="" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-pencil fa-3x">

            </figure>
            <p>
              How does my student apply?
            </p>
          </div>
        </a>
        <a href="" class="column small-6 small-collapse square">
          <div>
            <figure class="fa fa-money fa-3x">

            </figure>
            <p>
              What is the cost?
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
              -- Select a Major --
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
    </div>
    <div id="description" class="row">
      <p>
        The Department of Advertising develops leaders with an understanding of the creative and business-related aspects of advertising in the current media landscape.<br><br>Students participate in a rigorous degree program that provides the background and training to become leaders in advertising communication. Advertising majors gain an understanding of the creative and business-related aspects of advertising, including copywriting, sales, production, creative strategy, design and layout, media planning, and research. We also host industry professionals who speak to students about internships and careers in advertising.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_adv.php" class="button" target="_blank">More Info...</a>
      </p>
    </div>
  </section>
  <script>
    $('.scrollDown').click(function() {
      $('html,body').animate({
        scrollTop: $('#overview').position().top - 70
      }, 800);
    });
  </script>

<?php include 'inc/footer.php'; ?>
