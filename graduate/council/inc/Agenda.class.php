<?php
/**
 * A full agenda that contains all items for one agenda
 */
class Agenda
{
    /**
     * @var AgendaItem[] $agendaItems An array of AgendaItem objects
     */
    private $agendaItems = array();

    /**
     * Adds an AgendaItem object to the array
     *
     * @param object $item The AgendItem object to be added
     */
    public function addItem($item) {
        $this->agendaItems[] = $item;
    }
    /**
     * Gets the array of AgendaItem objects
     *
     * @return AgendaItem[] The array of AgendaItem objects 
     */
    public function getItems() {
        return $this->agendaItems;
    }
}
