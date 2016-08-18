<?php

class Story
{
  private $title;
  private $categories = array();
  private $date;
  private $blurb;
  private $picture;

  public function __contruct($title = null) {
    $this->setTitle($title);
  }

  public function setTitle($title) {
    if (empty($title)) {
      $this->title = null;
    } else {
      $this->title = ucwords($title);
    }
  }

  public function getTitle() {
    return $this->title;
  }

  public function addCategory($cat) {
    $this->categories[] = strtolower(trim($cat));
  }

  public function getCategories() {
    return $this->categories;
  }

  public function addDate($date) {
    $this->date = $date;
  }

  public function getDate() {
    return $this->date;
  }

  public function addBlurb($blurb) {
    $this->blurb = htmlspecialchars(trim($blurb));
  }

  public function getBlurb() {
    return $this->blurb;
  }

  public function addPicture($picture) {
    $this->picture = trim($picture);
  }

  public function getPicture() {
    return $this->picture;
  }

}
