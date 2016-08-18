<?php

class NewsStories
{

  private $title;
  private $stories = array();

  public function __construct($title = null) {
    $this->setTitle($title);
  }

  public function setTitle($title) {
    if (empty($title)) {
      $this->title = null;
    } else {
      $this->title = ucwords($title);
    }
  }

  public function addStory($story) {
    $this->stories[] = $story;
  }

  public function getStories() {
    return $this->stories;
  }

}
