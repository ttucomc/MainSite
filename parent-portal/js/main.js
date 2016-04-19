/******************************************************
LANDING PAGE
******************************************************/
// Showing major description on the landing page
$('#question select').change(function() {
  // If the #description div is hidden, show it
  if ($('#description').css('display') == 'none') {
    $('#description').slideToggle('slow');
    $('html, body').animate({ scrollTop: $(document).height() }, 'slow');
  }
  // If the original 'Select a Major' gets re-selected, hide the #description div
  if ($(this).val() == 'select') {
    $('#description').slideToggle('slow');
  }
  // Putting the right description with the right major
  if ($(this).val() == 'Adv') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('The Department of Advertising develops leaders with an understanding of the creative and business-related aspects of advertising in the current media landscape.<br><br>Students participate in a rigorous degree program that provides the background and training to become leaders in advertising communication. Advertising majors gain an understanding of the creative and business-related aspects of advertising, including copywriting, sales, production, creative strategy, design and layout, media planning, and research. We also host industry professionals who speak to students about internships and careers in advertising.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_adv.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
  if ($(this).val() == 'Coms') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('The Department of Communication Studies prepares students for careers in business, industry, social service and education. Our curriculum is focused on the study of communication skills and theories as they apply to problems in work and social settings.<br><br>In addition to classroom instruction, we sponsor co-curricular and extracurricular activity in forensics (speech and debate) and support a chapter of Lambda Pi Eta, the National Communication Honor Society of the National Communication Association. Undergraduate internships afford students the opportunity to apply classroom learning in a real-world work environment.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_coms.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
  if ($(this).val() == 'EMC') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('In the Electronic Media & Communications (EMC) program, we are devoted to preparing students for leadership positions in electronic media industries. <br><br>The EMC program offers professional courses in electronic media, visual communication, digital media production, photography and writing. In addition to electronic media skills, students also explore management topics and industry trends and challenges. Our core curriculum explores the social, technological, economic, and political contexts of mass communications.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_jem.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
  if ($(this).val() == 'Jour') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('Our journalism faculty are leading the way in teaching multimedia storytelling skills and preparing students for success in the multimedia world.<br><br>Journalism classes are steeped in traditional journalism values and emphasize the importance of effective storytelling which requires clarity, conciseness, accuracy and fairness in reporting. In our multi-platform program, all journalism majors study the unique attributes of print, broadcast, and online news content and production. Students have the opportunity to produce news and information using a variety of media including social, print, broadcast and online.<br><br>CoMC journalism faculty and staff also work with news organizations in the Southwest to provide students meaningful internships and other career-advancing opportunities.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_jem.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
  if ($(this).val() == 'MS') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('The media strategies program stresses integration of media and communication disciplines to drive media innovation and entrepreneurial thinking.<br><br>CoMC’s media strategies program combines coursework in entrepreneurship with the training necessary for students to create, pitch, develop, and manage entrepreneurial and entrepreneurial media innovations. A hallmark of our program, interdisciplinary study, requires courses in media literacy, professional communication, and other courses from across CoMC’s departments including Journalism and Public Relations.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_pr.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
  if ($(this).val() == 'PR') {
    $('#description p').fadeToggle('fast', function() {
      $('#description p').empty();
      $('#description p').append('Our award-winning public relations faculty prepares students to succeed in technical and managerial roles in public relations firms, as well as corporate and nonprofit organizations.<br><br>Coursework emphasizes relationship management and strategic campaign planning, the role of traditional and new media in public relations practice, principles of persuasive communication, globalization and diversity, the history of the field, and legal and ethical challenges that practitioners may face. We offer special topic courses related to media relations, crisis communication, social media, community relations, sports communication, government relations, international communication, and other practice areas.<br><br>More information in the TTU catalog:<br><a href="http://www.depts.ttu.edu/officialpublications/catalog/mc_pr.php" class="button" target="_blank">More Info...</a>')
    }).fadeToggle('fast');
  }
});

/******************************************************
CAREER PAGE
******************************************************/
// Variables for where the array needs to start
var careerStart = 4;
var employerStart = 4;

// When the Careers "More..." button is clicked
$('#career-list .load-more').click(function() {
  // Looping through 5 times since we want 5 more items
  for (var i = 0; i < 5; i++) {
    // Setting the array to start at the next value
    careerStart++;
    // Keep adding to the list as long as there's still values
    if (careerStart < careerList.length) {
      // Appending the next list item as hidden for effect
      $('#career-list ul').append("<li style='display:none;'>" + careerList[careerStart] + "</li>");
      // Fading in the appended list item
      $('#career-list ul li').last().slideToggle('slow');
    } else {
      // Fading out the more button when we've reached the end
      $('#career-list a').fadeOut('slow');
    }
  }
});
// When the Employers "More.." button is clicked
$('#employer-list .load-more').click(function() {
  // Looping through 5 times since we want 5 more items
  for (var i = 0; i < 5; i++) {
    // Setting the array to start at the next value
    employerStart++;
    // Keep adding to the list as long as there's still values
    if (employerStart < careerList.length) {
      // Appending the next list item as hidden for effect
      $('#employer-list ul').append("<li style='display:none;'>" + employerList[employerStart] + "</li>");
      // Fading in the appended list item
      $('#employer-list ul li').last().slideToggle('slow');
    } else {
      // Fading out the more button when we've reached the end
      $('#employer-list a').fadeOut('slow');
    }
  }
});
