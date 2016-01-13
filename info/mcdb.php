<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'root', 'student_work');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
