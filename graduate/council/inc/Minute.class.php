<?php

/**
 * An individual minute/notes on a topic discussed in a meeting
 */
class Minute
{
    /**
     * @var string   $title  The title of what the minute is
     * @var string[] $points An array of individual points discussed about this minute
     */
    private $title;
    private $points = array();

    function __construct($title)
    {
        $this->setTitle($title);
    }

    /**
     * Sets the title of the minute
     *
     * @param string $title The title for the minute
     */
    public function setTitle($title) {
        $this->title = $title;
    }
    /**
     * Returns the title of the minute
     *
     * @return string The title of the minute
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Adds an individual point discussed about this minute to an array
     *
     * @param string $point The point to be added to the array
     */
    public function addPoint($point) {
        $this->points[] = $point;
    }
    /**
     * Returns the array of points of the minute
     *
     * @return string[] The array of points for this minute
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * Returns how many points this minute has
     *
     * @return int The size of the points array
     */
    public function lengthOfPoints() {
        return count($this->points);
    }
}
