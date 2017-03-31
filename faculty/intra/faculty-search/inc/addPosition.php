<?php

require('config.php');
require('db.php');

/** Variables */
$submitData = [];
$title = trim($_POST['title']);
$number = (int)$_POST['number'];
$department = $_POST['department'];
$chair = trim($_POST['chair']);

/** Making the call to the database */
try {

    $stmt = $db->prepare('
                          INSERT INTO faculty_search_positions (title, number, department, chair)
                          VALUES (:title, :number, :department, :chair)
                        ');
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':number', $number, PDO::PARAM_INT);
    $stmt->bindParam(':department', $department, PDO::PARAM_STR);
    $stmt->bindParam(':chair', $chair, PDO::PARAM_STR);
    $stmt->execute();

    $submitData['success'] = true;
    $submitData['message'] = "Success! $title was added to the database!";
    $submitData['title'] = $title;
    $submitData['number'] = $number;
    $submitData['department'] = $department;
    $submitData['chair'] = $chair;

} catch (Exception $e) {

    $submitData['success'] = false;
    $submitData['message'] = "Bummer! Couldn't add the position to the database.";

}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
