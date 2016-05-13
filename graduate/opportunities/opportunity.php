<?php


class Opportunity {

  private $id;

  /*
    @param db PDO Database
    @param jobType int
    Jobs may be one of two categorys:
    Internship: 0
    Job: 1

    jobType is an Int incase other job types arise in the future

    @param jobName string
    @param companyName string

  */
  public $db;
  public $jobType;
  public $jobName;
  public $companyName;



  public static function createNewOpportunity(PDO $db, $jobName, $jobType, $companyName) {

    $instance = new self();

    try {
      //PDO Functions to add Opportunity here

    } catch(Exception $e){
      echo "Unable to add Opportunity";
      echo $e->getMessage();
      die();
    }

    //$instance->id = $db->lastInsertId();
    //$instance->db = $db;

    return $instance;
}



public static function getOpportunity(PDO $db, $id) {
  $instance = new self();
  return $instance->loadByID($db, $id);
}






?>
