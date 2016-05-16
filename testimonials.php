<?php

$testimonials = array(
  array(
    'name' => 'Alexa Rosas',
    'hometown' => 'San Antonio, Texas',
    'major' => 'Public Relations',
    'quote' => 'Being a part of the CoMC is great because it means being around people that are always ready and willing to help you succeed.',
    'photo' => 'alexa-rosas'
  ),
  array(
    'name' => 'Amber Smith',
    'hometown' => 'Keller, Texas',
    'major' => 'Public Relations',
    'quote' => 'Living in a Learning Community is convenient and helpful, to have friends next door that can help with studying because you\'re in the same classes more than likely.',
    'photo' => 'amber-smith'
  ),
  array(
    'name' => 'Lea Fulton',
    'hometown' => 'Nottingham, England',
    'major' => 'Electronic Media and Communications',
    'quote' => 'I love having the opportunity to be creative in my classes and I also love meeting like-minded people that I can collaborate musically with outside of class.',
    'photo' => 'lea-fulton'
  ),
  array(
    'name' => 'Mary Katherine Hart',
    'hometown' => 'Houston, Texas',
    'major' => 'Communication Studies',
    'quote' => 'Being a part of CoMC here at Texas Tech is amazing because of the immediate community it gives you.',
    'photo' => 'mary-hart'
  ),
  array(
    'name' => 'Ryan Ortegon',
    'hometown' => 'El Paso, Texas',
    'major' => 'Electronic Media and Communications',
    'quote' => 'Living in the CoMC Learning Community allows students to network and share ideas with their peers in the same major.',
    'photo' => 'ryan-ortegon'
  ),
  array(
    'name' => 'Socorra Austin',
    'hometown' => 'Albuquerque, New Mexico',
    'major' => 'Electronic Media and Communications',
    'quote' => 'The College of Media &amp; Communication does a very good job at offering opportunities and support to help fulfill your dreams.',
    'photo' => 'socorra-austin'
  ),
  array(
    'name' => 'Tim Hays',
    'hometown' => 'Keizer, Oregon',
    'major' => 'Journalism',
    'quote' => 'The College of Media &amp; Communication provides me with so many opportunities and helps me achieve the goals that I have.',
    'photo' => 'tim-hays'
  )
);
shuffle($testimonials);
$testimonials_js = json_encode($testimonials);
$testimonial = $testimonials[0];

?>

<section id="testimonials" class="row">
  <div class="medium-6 columns" id="quote">
    <blockquote>
      <p><?php echo $testimonial['quote']; ?></p>
    </blockquote>
    <?php echo '<img src="/comc/images/home/MCLC/SIG-' . $testimonial['photo'] . '.png" alt="' . $testimonial['name'] . ' Signature" />'; ?>
    <cite>
      <?php echo $testimonial['name']; ?><br />
      <?php echo $testimonial['hometown']; ?><br />
      <?php echo $testimonial['major']; ?>
    </cite>
  </div>
  <div class="medium-6 columns" id="photo">
    <?php echo '<img src="/comc/images/home/MCLC/MCLC-' . $testimonial['photo'] . '.png" alt="' . $testimonial['name'] . '" title="' . $testimonial['name'] . '" />'; ?>
  </div>
</section>
