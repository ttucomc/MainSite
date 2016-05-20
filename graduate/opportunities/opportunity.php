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

  public static function createNewOpportunity(PDO $db, $jobType, $isPaid, $jobName, $jobPosition, $description, $start, $end, $company) {

    try {

      $createOpportunity = $db->prepare('INSERT INTO jobs (isActive, jobType, isPaid, jobName, jobPosition, description, startDate, endDate, company)
                                         VALUES (1, :jobType, :isPaid, :jobName, :jobPosition, :description, :start, :end, :company)');

      $createOpportunity->bindParam(':jobType', $jobType, PDO::PARAM_INT);
      $createOpportunity->bindParam(':isPaid', $isPaid, PDO::PARAM_INT);
      $createOpportunity->bindParam(':jobName', $jobName, PDO::PARAM_STR);
      $createOpportunity->bindParam(':jobPosition', $jobPostion, PDO::PARAM_STR);
      $createOpportunity->bindParam(':description', $description, PDO::PARAM_STR);
      $createOpportunity->bindParam(':start', $start);
      $createOpportunity->bindParam(':start', $end);
      $createOpportunity->bindParam(':company', $company, PDO::PARAM_INT);

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
