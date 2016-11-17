<?php

  $pageTitle = "Careers | Parents | CoMC | TTU";
  $pageDescription = "Find out what a communication degree from the College of Media & Communication can do for your students career!";
  $pageURL = "http://www.depts.ttu.edu/comc/parents/careers/";

  include '../inc/header.php';
?>

  <div id="careers">

    <section class="top">
      <div id="container" class="container">
        <div id="output">
        </div>
      </div>
      <div id="title">
        <h1>Careers</h1>
      </div>
      <div class="scrollDown">
        <p>
          Scroll Down
        </p>
        <img src="<?php echo BASE_URL; ?>img/scroll-down-arrow.svg" alt="Arrow Down" title="Click to scroll down or scroll down" />
      </div>
    </section>

    <section id="overview">
      <div class="row">
        <p>
          Graduates of the College of Media &amp; Communication are employed in various industries and sectors including, marketing, corporate communication, nonprofit, independent communication firms, radio, television, film, higher education, sports media and many, many more. Students are encouraged to pursue their interests, from sports to entertainment, to technology to law, and everything in between. A CoMC degree sets the course for a successful career in whatever field or industry your student chooses!
        </p>
      </div>
    </section>

    <section id="lists">
      <?php
      $careerList = array (
                      "Academic Advisor",
                      "Account Executive/Coordinator/Manager",
                      "Advertising Account Executive",
                      "Advertising Buyer",
                      "Advertising Media Planner",
                      "Advertising Sales Manager",
                      "Announcer",
                      "Art Director",
                      "Art Sales Manager",
                      "Audio Engineer",
                      "Author",
                      "Blogger",
                      "Brand Manager",
                      "Broadcast News Analyst",
                      "Broadcaster",
                      "Camera Operator",
                      "Communications Director",
                      "Community Outreach Specialist",
                      "Consultant",
                      "Consumer Market Strategist",
                      "Content Creator",
                      "Content Producer",
                      "Copywriter",
                      "Corporate Communications Specialist",
                      "Creative Director",
                      "Crisis Communications Specialist",
                      "Digital Media Manager",
                      "Digital Specialist",
                      "Direct Marketing Specialist",
                      "Director (Lighting, Technical, Audio)",
                      "Director of Advertising",
                      "Editor",
                      "Editorial Cartoonist",
                      "Entrepreneur",
                      "Executive Producer",
                      "Film Director",
                      "Foreign Correspondent",
                      "Government Relations Specialist",
                      "Graduate School",
                      "Graphic Designer",
                      "Human Resources Manager",
                      "Illustrator",
                      "Integrated Marketing Communications ",
                      "International Public Relations Specialist",
                      "Interpreter",
                      "Law School",
                      "Lawyer",
                      "Magazine Editor",
                      "Marketing and Consumer Public Relations Specialist",
                      "Marketing Director",
                      "Media Buyer",
                      "Media Relations Specialist",
                      "Media Sales",
                      "Media/Marketing/Promotions",
                      "Mobile Media Management",
                      "Movie Producer",
                      "Multimedia Journalist",
                      "Museum Curator",
                      "Nonprofit Public Relations Specialist",
                      "Online Information Architect",
                      "Photographer",
                      "Photojournalist",
                      "Political Communication Director",
                      "Political Lobbyist",
                      "Production Manager",
                      "Professor of Higher Education",
                      "Program Director",
                      "Public Administrator",
                      "Public Information Officer",
                      "Public Relations Manager",
                      "Publicist/Publicity",
                      "Recruiter",
                      "Reporter",
                      "Research Director",
                      "Sales Manager",
                      "Screenwriter",
                      "Social Media Manager,",
                      "Social Media Specialist",
                      "Sound Technician",
                      "Spokesperson",
                      "Sports Information Director",
                      "Sports, Entertainment, or Travel Publicist",
                      "Teacher",
                      "Technical Illustrator",
                      "Technical Writer",
                      "Television Producer",
                      "Translator",
                      "Videographer",
                      "Web Designer",
                      "Web Producer",
                      "Writer"
                    );
      $employerList = array (
                        "Adoption agencies",
                        "Advertising Agencies and Firms",
                        "Amusement parks",
                        "Apartment and housing complexes",
                        "Banks and credit unions",
                        "Business Corporations",
                        "Cable television",
                        "Campaign committees, coalitions, initiatives, and networks",
                        "Chambers of commerce",
                        "Clubs and Camps",
                        "Colleges and universities",
                        "Commerical broadcast stations",
                        "Community Centers",
                        "Community residential homes",
                        "Companies specializing in webcasting services and technology",
                        "Computer systems design firms",
                        "Conference centers",
                        "Construction companies",
                        "Consulting and freelance operations",
                        "Consulting firms",
                        "Convention/Tradeshow planning",
                        "Corporate Advertising Departments",
                        "Corporate in-house public relations departments",
                        "Day care centers and nursery schools",
                        "Design firms",
                        "Educational product developers",
                        "Employee assistance programs",
                        "Employment agencies",
                        "Engineering firms",
                        "Entertainment/Event planning",
                        "Executive search firms",
                        "Family and child welfare agencies",
                        "Federal, state, and local governments",
                        "Festivals",
                        "Film industry",
                        "Film studios",
                        "Financial companies",
                        "Foster care organizations",
                        "Freelance or private video production companies",
                        "Government",
                        "Government Agencies",
                        "Historical, cultural, and natural attractions",
                        "Hospice",
                        "Hospitality and tourism industry",
                        "Hospitals and other healthcare organizations",
                        "Hotels",
                        "Human resources",
                        "In-house communication, marketing, or public relations departments",
                        "In-house creative departments",
                        "Insurance companies",
                        "Internet companies",
                        "Internet Marketers",
                        "Internet media companies",
                        "Labor unions",
                        "Law firms",
                        "Learning centers",
                        "Leisure organizations, like sports clubs, recreation centers, country clubs, fitness centers",
                        "Lodging and resorts",
                        "Magazines",
                        "Major television networks",
                        "Major, medium, and small market stations",
                        "Management consulting firms",
                        "Manufacturers",
                        "Marketing companies",
                        "Marketing research firms",
                        "Media marketing",
                        "Media research",
                        "Medical facilities",
                        "Mental health organizations",
                        "Motion picture production firms",
                        "Museums and attractions",
                        "National foundations and associations",
                        "National public radio",
                        "National radio networks",
                        "Newspapers",
                        "Nonprofit organizations",
                        "Nursing and retirement homes",
                        "Office operations",
                        "Oil and gas industry",
                        "Online publications",
                        "Online retailers",
                        "Philanthropies",
                        "Post-production companies",
                        "Print and electronic media",
                        "Prisons and correctional facilities",
                        "Private and public school systems",
                        "Private practices",
                        "Private production companies",
                        "Product and service organizations",
                        "Professional associations",
                        "Programs and activity planning",
                        "Public and private corporations",
                        "Public interest organizations",
                        "Public opinion research firms and organizations",
                        "Public relations firms",
                        "Public service organizations",
                        "Public television stations",
                        "Public welfare agencies",
                        "Publicity firms",
                        "Publishers",
                        "Publishing firms/houses",
                        "Radio",
                        "Real estate",
                        "Rehabilitation centers",
                        "Religiously affiliated organizations",
                        "Research laboratories",
                        "Reservation companies",
                        "Restaurants",
                        "Retail stores",
                        "Savings and loans associations",
                        "School districts",
                        "Senior centers",
                        "Social media/ Social networking websites",
                        "Social service agencies",
                        "Software firms",
                        "Specialty Advertising Firms",
                        "Sport and athletic organizations",
                        "Sports and entertainment organizations",
                        "Stadiums and sport/concert venues",
                        "State or regional networks",
                        "Television",
                        "Temporary or staffing agencies",
                        "Trade associations",
                        "Transportation/Travel industry",
                        "Travel agencies",
                        "Travel planning",
                        "Victim services organizations",
                        "Video game designers",
                        "Visitor bureaus",
                        "Volunteer coordination"
                      );
        shuffle($careerList);
        shuffle($employerList);
      ?>
      <div class="row">
        <div id="career-list">
          <h2>Careers</h2>
          <ul>
            <?php
              $i = 0;
              foreach ($careerList as $career) {
                if($i == 5) { break; }
                echo "<li>" . $career . "</li>";
                $i++;
              }
            ?>
          </ul>
          <a class="button load-more">More...</a>
        </div>
        <div id="employer-list">
          <h2>Employers</h2>
          <ul>
            <?php
              $i = 0;
              foreach ($employerList as $key => $employer) {
                if($i == 5) { break; }
                echo "<li>" . $employer . "</li>";
                $i++;
              }
            ?>
          </ul>
          <a class="button load-more">More...</a>
        </div>
      </div>
    </section>
    <section id="rankings">
      <h2>Communication Skills</h2>
      <div class="row">
        <div class="medium-4 columns">
          <i class="fa fa-list fa-5x"></i>
          <h3>Top Ten</h3>
          <p>
            Multiple communication skills listed in the top ten skills employers say they seek.
          </p>
          <p class="cite">
            <a href="http://www.forbes.com/sites/susanadams/2014/11/12/the-10-skills-employers-most-want-in-2015-graduates/" target="_blank">- Forbes</a>
          </p>
        </div>
        <div class="medium-4 columns">
          <i class="fa fa-heart fa-5x"></i>
          <h3>Most Desired</h3>
          <p>
            Every industry is wanting people with quality communication skills.
          </p>
          <p class="cite">
            <a href="http://www.bloomberg.com/graphics/2015-job-skills-report/" target="_blank">- Bloomberg</a>
          </p>
        </div>
        <div class="medium-4 columns">
          <i class="fa fa-trophy fa-5x"></i>
          <h3>#1 Skill</h3>
          <p>
            Americans rank this as the number one skill to get ahead in life.
          </p>
          <p class="cite">
            <a href="https://www.entrepreneur.com/article/243128" target="_blank">- Entrepreneur</a>
          </p>
        </div>
      </div>
    </section>
    <section id="internships">
      <h2>Internships</h2>
      <div class="row">
        <p>
          It is never too early to get started thinking about internships. Many companies require students to earn course credit for an internship, and the college does have some basic prerequisites students must complete to be eligible for course credit. To learn the ins and outs of securing an internship, encourage your student to set up an appointment with our college’s career counselor, Ali Luempert.<br />
          <a href="mailto:ali.j.luempert@ttu.edu" class="button">Email Ali</a>
        </p>
      </div>
    </section>
    <section id="alumni">

      <h2>Our Alumni</h2>

      <div class="personContainer">
        <div class="row alumni-block" data-equalizer>
          <div class="columns medium-6" data-equalizer-watch>
            <div class="personPicture">
              <img src="../img/alumni/sara-krueger.jpg" alt="Sara Krueger" title="Sara Krueger" />
            </div>
            <div class="personName">
              Sara Krueger
            </div>
            <div class="personSubtitle">
              Communications Specialist
            </div>
            <div class="personDegree">
              OCI Solar Power
            </div>
          </div>
          <div class="columns medium-6" data-equalizer-watch>
            <div class="quote">
              <p>
                I never had a class that was not driven by real-world applications or professional development. I really credit the college with preparing me for everything that has come my way.
              </p>
            </div>
          </div>
        </div>

        <div class="row alumni-block">
          <div class="small-12 columns">
            <div class="row" data-equalizer>
              <div class="columns medium-6 medium-push-6" data-equalizer-watch>
                <div class="personPicture">
                  <img src="../img/alumni/sydney-holmes.jpg" alt="Sara Krueger" title="Sara Krueger" />
                </div>
                <div class="personName">
                  Sydney Holmes
                </div>
                <div class="personSubtitle">
                  Corporate &amp; Agent PR Lead
                </div>
                <div class="personDegree">
                  Compass
                </div>
              </div>
              <div class="columns medium-6 medium-pull-6" data-equalizer-watch>
                <div class="quote">
                  <p>
                    I recommend that students become friends with their professors. I feel like I have people invested in my career and future since getting to know some of my former professors.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row alumni-block" data-equalizer>
          <div class="columns medium-6" data-equalizer-watch>
            <div class="personPicture">
              <img src="../img/alumni/regan-howle.jpg" alt="Sara Krueger" title="Sara Krueger" />
            </div>
            <div class="personName">
              Regan Howle
            </div>
            <div class="personSubtitle">
              Branding Sales Executive
            </div>
            <div class="personDegree">
              etc group, inc
            </div>
          </div>
          <div class="columns medium-6" data-equalizer-watch>
            <div class="quote">
              <p>
                You can be creative and have fun ideas. There are just so many different directions you can go...
              </p>
            </div>
          </div>
        </div>
      </div>

    </section>


  </div>
  <script>
    <?php
      echo "
              var careerList = " . json_encode($careerList) . ";
              var employerList = " . json_encode($employerList) . ";
           ";
    ?>

    $('.scrollDown').click(function() {
      $('html,body').animate({
        scrollTop: $('#overview').position().top - 70
      }, 800);
    });
  </script>

<?php include '../inc/footer.php'; ?>
