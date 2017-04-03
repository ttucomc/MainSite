<?php

require('config.php');
require('db.php');
require('/comc/includes/aws/aws-autoloader.php');
use Aws\S3\S3Client;

/** Variables */
$submitData = [];

$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$affiliation = trim($_POST['affiliation']);
$degree = trim($_POST['degree']);
$school = trim($_POST['school']);
$photo = $_FILES['photo'];
$photoName = $_POST['photoName'];
$cv = $_FILES['cv'];
$cvName = $_POST['cvName'];
$positionId = (int)$_POST['positionId'];

// Start the S3 client for the photo
$s3 = S3Client::factory(array(
  'version' => 'latest',
  'region'  => 'us-east-1',
  'credentials' => array(
    'key' => 'AKIAJJ2WE5LKQVSYOLMQ',
    'secret'  => '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'
  )
));

// Start the S3 client for the cv
$s3cv = S3Client::factory(array(
  'version' => 'latest',
  'region'  => 'us-east-1',
  'credentials' => array(
    'key' => 'AKIAJJ2WE5LKQVSYOLMQ',
    'secret'  => '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'
  )
));
// Name of the s3 bucket it's going to
$bucket = 'comc-faculty-search';

try {

    // Upload the photo
    $result = $s3->putObject(array(
        'Bucket'       => $bucket,
        'Key'          => 'photos/' . $photoName,
        'SourceFile'   => $photo['tmp_name'],
        'ContentType'  => 'text/plain',
        'ACL'          => 'public-read',
        'StorageClass' => 'REDUCED_REDUNDANCY'
    ));

    // Upload the cv
    $result = $s3cv->putObject(array(
        'Bucket'       => $bucket,
        'Key'          => 'cvs/' . $cvName,
        'SourceFile'   => $cv['tmp_name'],
        'ContentType'  => 'text/plain',
        'ACL'          => 'public-read',
        'StorageClass' => 'REDUCED_REDUNDANCY'
    ));

} catch (Exception $e) {
    $submitData['success'] = false;
    $submitData['message'] = "Bummer! The photo and cv was not added! Please try again. " . $e->getMessage();

    // Echoing back the data in JSON for AJAX
    echo json_encode($submitData);
    exit;
}

/** Making the call to the database */
try {

    $stmt = $db->prepare('
                          INSERT INTO faculty_search_candidates (first_name, last_name, affiliation, degree, school, photo, cv, position_id)
                          VALUES (:firstName, :lastName, :affiliation, :degree, :school, :photo, :cv, :positionId)
                        ');
    $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $stmt->bindParam(':affiliation', $affiliation, PDO::PARAM_STR);
    $stmt->bindParam(':degree', $degree, PDO::PARAM_STR);
    $stmt->bindParam(':school', $school, PDO::PARAM_STR);
    $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
    $stmt->bindParam(':cv', $cv, PDO::PARAM_STR);
    $stmt->bindParam(':positionId', $positionId, PDO::PARAM_INT);
    $stmt->execute();

    $submitData['success'] = true;
    $submitData['message'] = "Success! $firstName $lastName was added as a candidate!";
    $submitData['affiliation'] = $affiliation;
    $submitData['degree'] = $degree;
    $submitData['school'] = $school;

} catch (Exception $e) {

    $submitData['success'] = false;
    $submitData['message'] = "Bummer! Couldn't add the position to the database.";

}

// Echoing back the data in JSON for AJAX
echo json_encode($submitData);
