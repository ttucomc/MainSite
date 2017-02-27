<?php

/**
 * A full meeting
 */
class Meeting
{
    /**
     * @var string  $date     The date of the meeting
     * @var string  $location Where the meeting is taking or took place
     * @var Agenda  $agenda   The Agenda object for this meeting
     * @var Minutes $minutes  The Minutes object for this meeting
     */
    private $date;
    private $location;
    private $agenda;
    private $minutes;

    function __construct($date = null, $location = null)
    {
        $this->setDate($date);
        $this->setLocation($location);
    }

    /**
     * Sets the date for the meeting
     *
     * @param string $date The date of the meeting
     */
    public function setDate($date) {
        $this->date = $date;
    }
    /**
     * Returns the date for this meeting
     *
     * @return string The date for this meeting
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Sets where the meeting is taking or took place
     *
     * @param string $location The location of the meeting
     */
    public function setLocation($location) {
        $this->location = $location;
    }
    /**
     * Returns the location of this meeting
     *
     * @return string The location of this meeting
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Adds an Agenda object
     *
     * @param Agenda $agenda The Agenda object to be added
     */
    public function addAgenda($agenda) {
        $this->agenda = $agenda;
    }
    /**
     * Returns the array of Agenda objects for this meeting
     *
     * @return Agenda[] The array of Agenda objects
     */
    public function getAgenda() {
        return $this->agenda;
    }

    /**
     * Adds a Minutes object
     *
     * @param Mintues $minutes The Minutes object to be added
     */
    public function addMinutes($minutes) {
        $this->minutes = $minutes;
    }
    /**
     * Returns the array of Minutes objects for this meeting
     *
     * @return Minutes[] The array of Minutes objects
     */
    public function getMinutes(){
        return $this->minutes;
    }
}
