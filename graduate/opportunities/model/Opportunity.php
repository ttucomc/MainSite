<?php

/*

Texas Tech University
College Of Media and Communications
5/12/16

*/

class Opportunity {

  /*

    ------- Opprotunity Identifiers -------
    @param $id int

    isActive is to show or hide the

    ------- Database -------
    @param db PDO Database

    ------- Organization of Job Types -------
    @param jobType int
    @param paid int

    Jobs may be one of two categorys:
    Internship: 0
    Full Time: 1
    Part Time: 2

    If The job type is an internship, the paid variable represets whether or not the internship is paid.
    Paid: 1
    Unpaid: 0


    ------- Opprotunity Information -------
    @param jobName string
    @param jobPosition string
    @param description string
    @param startDate string
    @param endDate string



    ------- Company -------
    @param companyName string
    @param city string
    @param state string


    ------- Contact -------
    @param id int
    @param db PDO Database
    @param firstName string
    @param lastName string
    @param phone string
    @param email string

  */

  private $id;
  private $db;

  //Organization of Job Types, see comments above.
  public $jobType = 0;
  public $isPaid = 0;

  //Opportunity Information
  public $jobName = "";
  public $jobPostion = "";
  public $description = "";
  public $startDate;
  public $endDate;
  public $company = 0;

  /*
    @param db PDO DB Connection
    @param opportunity array
    @param company array
    @param contact array

    @return new Opportunity

  */

  public static function createNewOpportunity(PDO $db, $opportunity, $company, $contact) {

    try {

      $createOpportunity = $db->prepare('INSERT INTO jobs_all
          (isActive, jobType, isPaid, jobName, jobPosition, description, startDate, endDate,
          companyName, city, state,
          firstName, lastName, phone, email)

          VALUES (1, :jobType, :isPaid, :jobName, :jobPosition, :description, :start, :end,
          :companyName, :city, :state,
          :firstName, :lastName, :phone, :email, now())');

      //Opporunity
      $createOpportunity->bindParam(':jobType', $opportunity['jobType'], PDO::PARAM_INT);
      $createOpportunity->bindParam(':isPaid', $opportunity['isPaid'], PDO::PARAM_INT);
      $createOpportunity->bindParam(':jobName', $opportunity['jobName'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':jobPosition', $opportunity['jobPosition'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':description', $opportunity['description'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':start', $opportunity['start']);
      $createOpportunity->bindParam(':end', $opportunity['end']);

      //Company
      $createOpportunity->bindParam('companyName', $company['companyName'], PDO:PARAM_STR);
      $createOpportunity->bindParam(':city', $company['city'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':state', $company['state'], PDO::PARAM_STR);

      //Contact
      $createOpportunity->bindParam(':firstName', $contact['firstName'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':lastName', $contact['lastName'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':phone', $contact['phone'], PDO::PARAM_STR);
      $createOpportunity->bindParam(':email', $contact['email'], PDO::PARAM_STR);

      $createOpportunity->execute();

    } catch(Exception $e) {
      echo "Unable to add Opportunity";
      echo $e->getMessage();
      die();
    }

    $instance->id = $db->lastInsertId();
    $instance->db = $db;

    return $instance;
}

public static function getOpportunity(PDO $db, $id) {

    $instance = new self();

    $instance->db = $db;
    $instance->id = $id;

    return $instance->loadByID();
}

public function loadByID() {

    try {

      $loadOpportunity = $this->db->prepare('SELECT * FROM jobs WHERE id = ?');
      $loadOpportunity->bindParam(1, $this->id, PDO::PARAM_INT);

      $loadOpportunity->execute();

    } catch(Exception $e) {
      echo "Unable to load Opportunity.";
      echo $e->getMessage();
      die();
    }
}

?>
