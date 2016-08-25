<?php

class Story
{
  /**
   * @var str   $title      Title of the story
   * @var array $categories List of all the categories of the story
   * @var str   $date       Date the story posted
   * @var str   $blurb      The news story
   * @var str   $picture    File name of the picture for the story
   */
  private $title;
  private $categories = array();
  private $date;
  private $blurb;
  private $picture;

  /**
   * Constructor method
   *
   */
  public function __contruct($title = null) {
    $this->addTitle($title);
  }

  /**
   * Sets the title of the story
   *
   * @var str $title The title of the story, null if there is not one
   */
  public function addTitle($title) {
    if (empty($title)) {
      $this->title = null;
    } else {
      $this->title = ucwords($title);
    }
  }

  /**
   * Gets the title from the story
   *
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Adds a category to the story
   *
   * @var array $cat One the category to add to the story
   */
  public function addCategory($cat) {
    $this->categories[] = strtolower(trim($cat));
  }

  /**
   * Gets all the categories for the story
   *
   */
  public function getCategories() {
    return $this->categories;
  }

  /**
   * Adds the post date to the story
   *
   * @var str $date The post date of the story
   */
  public function addDate($date) {
    $this->date = $date;
  }

  /**
   * Gets the post date of the story
   *
   */
  public function getDate() {
    return $this->date;
  }

  /**
   * Adds the actually story
   *
   * @var str $blurb The news story
   */
  public function addBlurb($blurb) {
    $this->blurb = htmlspecialchars(trim($blurb));
  }

  /**
   * Gets the actual news story
   *
   */
  public function getBlurb() {
    return $this->blurb;
  }

  /**
   * Adds the file name of the picture if there is one
   *
   * @var str $picture The file name of the picture
   */
  public function addPicture($picture) {
    if (empty($picture)) {
      $this->picture = null;
    } else {
      $this->picture = trim($picture);
    }
  }

  /**
   * Gets the picture file name
   *
   */
  public function getPicture() {
    return $this->picture;
  }

}
