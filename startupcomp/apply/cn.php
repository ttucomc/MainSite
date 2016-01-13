<?php

$conn = mssql_connect("kadett.ttu.edu","Masscomm_web","G3K5Swgn") or die("Couldn't connect to the server.");
$db = mssql_select_db("Masscomm", $conn) or die("Couldn't select database.");

?>
