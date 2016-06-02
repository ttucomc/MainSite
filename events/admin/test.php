<?php

require_once('inc/config.php');
require_once('inc/functions.php');

$testing = toggle_event_listing(1);

echo '<pre>';
var_dump($testing);
