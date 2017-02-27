<?php

/**
 * An individual item to be added to an agenda
 */
class AgendaItem
{
    /**
     * @var string $title     The name of the agenda item
     * @var array  $listItems Any additional sub-items for the agenda item
     */
    private $title;
    private $listItems = array();

    function __construct($title)
    {
        $this->setTitle($title);
    }

    /**
     * Sets the title of the agenda item
     *
     * @param string $title The name of the agenda item
     */
    public function setTitle($title) {
        $this->title = $title;
    }
    /**
     * Returns the title
     *
     * @return string The name of the agenda item
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Adds a sub-item to the listItems array
     *
     * @param string The sub-item to be added
     */
    public function addItem($item) {
        $this->listItems[] = $item;
    }
    /**
     * Returns the array of sub-items of the agenda item
     *
     * @return array Array of the agenda item's sub-items
     */
    public function getListItems() {
        return $this->listItems;
    }

    /**
     * Returns how many sub-items this agenda item has
     *
     * @return int The size of the listItems array
     */
    public function lengthOfItems() {
        return count($this->listItems);
    }
}
