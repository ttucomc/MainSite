<?php
include ($_SERVER["DOCUMENT_ROOT"] . '/comc/includes/ttu-db-config.php');
// Importing classes
spl_autoload_register(function ($class) {
    include ($_SERVER["DOCUMENT_ROOT"] . '/comc/utilities11/news/classes/' . $class . '.class.php');
});

// New database connection
$database = new Database();
$database->query('SELECT * FROM newsblurb ORDER BY date DESC');
$rows = $database->getAll();

// Options
$display = $_REQUEST["cat"]; // Which stories are we displaying? use newsfeed.php?cat=alumni for alumni stories
// Max number of stories to display, change this to whatever you need by setting $_REQUEST['feedsize'] = # in the file that calls it.
if (isset($_REQUEST['feedsize'])) {
  $feedsize = $_REQUEST['feedsize'];
} else {
  // Default
  $feedsize = 6;
}

// Getting the stories to show
$news = new NewsStories();
foreach ($rows as $row) {
  // Creating a new story
  $story = new Story();
  $story->addTitle($row['headline']);
  $categories = array($row['cat1'], $row['cat2'], $row['cat3'], $row['cat4'], $row['cat5']);
  foreach ($categories as $category) {
    if ($category != 'None') {
      $story->addCategory($category);
    }
  }
  $story->addDate(date('m/d/Y', strtotime($row['date'])));
  $story->addBlurb($row['blurb']);
  $story->addPicture($row['thumbnail']);

  $news->addStory($story);
}

// If a category is set, get all stories that match that category. If not, get them all.
if (isset($_REQUEST["cat"])) {
  $stories = $news->getStoriesByCat($display);
} else {
  $stories = $news->getStories();
}
?>
<div class="newsfeed">
  <?php
    $story_i = 0; // Story iterator
    foreach ($stories as $story):
      $story_i++;
      $title = $story->getTitle();
      $picture = $story->getPicture();
  ?>
    <?php if ($story_i <= $feedsize): ?>
      <article class="clearfix">
        <?php if (!empty($title)): ?>
          <h4><?php echo $title; ?></h4>
        <?php endif; ?>
        <h5><?php echo $story->getDate(); ?></h5>
        <?php if (!empty($picture)): ?>
          <figure>
            <img src="/comc/images/news/<?php echo $story->getPicture(); ?>">
          </figure>
        <?php endif; ?>
        <p>
          <?php echo htmlspecialchars_decode($story->getBlurb()); ?>
        </p>
      </article>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
