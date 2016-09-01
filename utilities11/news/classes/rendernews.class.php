<?php

include ($_SERVER["DOCUMENT_ROOT"] . '/comcsite3/utilities11/news/inc/ttu-db-config.php');
include ($_SERVER["DOCUMENT_ROOT"] . '/comcsite3/utilities11/news/classes/database.class.php');
include ($_SERVER["DOCUMENT_ROOT"] . '/comcsite3/utilities11/news/classes/story.class.php');
include ($_SERVER["DOCUMENT_ROOT"] . '/comcsite3/utilities11/news/classes/newsstories.class.php');

/**
 * Controls all the visual output of any news stories
 *
 */
 class RenderNews
 {
   private $feedsize = 9999;
   private $displayCat;

   /**
    * Constuctor for the class
    *
    * @var int $feedsize Number of stories to display
    */
   public function __construct($feedsize = null) {
     $this->setFeedSize($feedsize);
   }

   /**
    * Display all the stories needed
    *
    */
   public static function listStories($feedsize = null, $cat = null) {

     $i = 0;

     // New database connection
     $database = new Database();
     $database->query('SELECT * FROM stories ORDER BY date DESC');
     $rows = $database->getAll();

     // Creating collection of all the stories
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

     // Setting feed size
     $this->setFeedSize($feedsize);

     // If a category is set, get all stories that match that category. If not, get them all.
     if (!empty($cat)) {
       $stories = $news->getStoriesByCat($display);
     } else {
       $stories = $news->getStories();
     }

     // Starting output
     $output = "<div class='newsfeed'>";
     // Displaying the stories on the page
     foreach ($stories as $story) {

       $i++;
       $title = $story->getTitle();
       $picture = $story->getPicture();
       $blurb = htmlspecialchars_decode($story->getBlurb());

       if ($i <= $this->feedsize) {

         $output .= "<article>";
         // If the story has a title show it
         if (!empty($title)){
           $output .= "<h4>" . $title . "</h4>";
         }
         $output .= "<h5>" . $story->getDate() . "</h5>";
         // If the story has a picture show it
         if (!empty($picture)){
           $output .= "<figure><img src=\"/comc/images/news/" . $story->getPicture() . "\"</figure>";
         }
         // Checking if the blurb has p tags and adding p tags if it doesn't
         if (substr( $string_n, 0, 3 ) === "<p>") {
           $output .= $blurb;
         } else {
           $output .= "<p>" . $blurb . "</p>";
         }
         $output .= "</article>";

       }

     }
     $output .= "</div>";

     return $output;

   }

   /**
    * Sets how many stories show
    *
    * @var int $size Number of stories to be displayed
    */
   public function setFeedSize($size = null) {
     if ($size == null) {
       $this->feedsize = 9999;
     } else {
       $this->feedsize = $size;
     }
   }

   /**
    * Sets the category to be displayed
    *
    * @var str $cat Category to be displayed
    */
   public function setDisplayCat($cat) {
     $this->displayCat = $cat;
   }

 }
