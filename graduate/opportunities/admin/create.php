<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../db.php');
require('../model/Opportunity.php');

//Get values for jobtype.
switch ($_POST['jobtype']) {

  case 'full':
    $jobType = 1;
    $isPaid = true;
    break;

  case 'part':
    $jobType = 2;
    $isPaid = true;
    break;

  case 'paid':
    $jobType = 0;
    $isPaid = true;
    break;

  case 'unpaid':
    $jobType = 0;
    $isPaid = false;
    break;

  default:
    $jobType = 0;
    $isPaid = false;
    break;
}


//Set Opporunity
$opportunity = array(

  'jobType' => $jobType,
  'isPaid' => $isPaid,
  'jobName' => $_POST['job_name'],
  'jobPosition' => $_POST['job_position'],
  'description' => $_POST['job_description'],
  'start' => $_POST['start_date'],
  'end' => $_POST['end_date']

);

//Set Company
$company = array(

  'companyName' => $_POST['company_name'],
  'city' => $_POST['company_city'],
  'state' => $_POST['company_state']

);

//Set Contact
$contact = array(

  'firstName' => $_POST['contact_first_name'],
  'lastName' => $_POST['contact_last_name'],
  'phone' => $_POST['company_phone'],
  'email' => $_POST['company_email']

);

$newOpporunity = Opportunity::createNewOpportunity($db, $opportunity, $company, $contact);

//echo var_dump($opporunity) . "       " . var_dump($company) . "       " . var_dump($contact);


?>
