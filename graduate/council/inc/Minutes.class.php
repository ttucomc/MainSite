<?php

/**
 * A group of individual Minute objects
 */
class Minutes
{
    /**
     * @var string[] $attendees Array of who was there to discuss these minutes
     * @var Minute[] $minutes    Array of Minute objects that should be grouped together
     */
    private $attendees = array();
    private $minutes = array();

    /**
     * Adds an attendee to the attendees array
     *
     * @param string $attendee The persons name who was there to be added to the array
     */
    public function addAttendee($attendee) {
        $this->attendees[] = $attendee;
    }
    /**
     * Returns the array of attendees that discussed the mintues
     *
     * @return string[] The array of attendees' names
     */
    public function getAttendees() {
        return $this->attendees;
    }

    /**
     * Adds a Minute object to the array
     *
     * @param Minute[] $minute The Minute object to be added to this array
     */
    public function addMinute($minute) {
        $this->minutes[] = $minute;
    }
    /**
     * Returns the array of Minute objects
     *
     * @return Minute[] The array of Minute objects 
     */
    public function getMinutes() {
        return $this->minutes;
    }
}
