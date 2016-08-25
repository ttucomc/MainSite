<?php

class NewsStories
{
  /**
   * @var str   $title   Title of the collection
   * @var array $stories All of the stories from the db
   */
  private $title;
  private $stories = array();

  /**
   * Class constructor
   */
  public function __construct($title = null) {
    $this->setTitle($title);
  }

  /**
   * Setting the title of the collection
   *
   * @var str $title Name of the collection
   */
  public function setTitle($title) {
    if (empty($title)) {
      $this->title = null;
    } else {
      $this->title = ucwords($title);
    }
  }

  /**
   * Adds a story to the collection
   *
   * @var object $story The story class to be added to the collection
   */
  public function addStory($story) {
    $this->stories[] = $story;
  }

  /**
   * Gets all the stories from the array
   *
   * @return array All the stories from the db
   */
  public function getStories() {
    return $this->stories;
  }

  /**
   * Gets all the stories from the array that match a category
   *
   * @var str   $cat            Category to match
   * @var array $matchedStories All the stories that match
   * @return array Stories that matched the category
   */
  public function getStoriesByCat($cat) {
   $matchedStories = array();
   foreach ($this->stories as $story) {
     if (in_array(strtolower($cat), $story->getCategories())) {
       $matchedStories[] = $story;
     }
   }

   return $matchedStories;
  }

}
