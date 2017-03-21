<?php

require_once('inc/config.php');
require_once('inc/functions.php');

$testing = toggle_event_rsvp(28);

echo '<pre>';
var_dump($testing);
