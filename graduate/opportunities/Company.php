<?php

/*

Texas Tech University
College Of Media and Communications
5/12/16

*/

class Company {

    /*

    ------- Company -------
    @param companyName string
    @param city string
    @param state string

    */
    private $id = 0;
    private $db;

    public $companyName = "";
    public $city = "";
    public $state = "";

    public static function create($db, $name, $city, $state) {

      try {

        $createCompany = $db->prepare('INSERT INTO companies (companyName, city, state) VALUES (?, ?, ?)')
        $createCompany->bindParam(1, $name, PDO::PARAM_STR);
        $createCompany->bindParam(2, $city, PDO::PARAM_STR);
        $createCompany->bindParam(3, $state, PDO::PARAM_STR);

        $createCompany->execute();

      } catch(Exception $e) {
        echo $e->getMessage();
        die();
      }

    }

    public static function withID($db, $id) {

      $instance = new self();

      $instance->id = $id;
      $instance->db = $db;
      $instance->loadCompany();

      return $instance;
    }

    public function loadCompany() {

      try {

        $getCompany = $this->db->prepare('SELECT * FROM companies WHERE id = ?');

        $getCompany->bindParam(1, $this->id, PDO::PARAM_INT);
        $getCompany->execute();

      } catch(Exception $e) {
        echo $e->getMessage();
        die();
      }

      $company = $getCompany->fetch();

      $this->companyName = $company["companyName"];
      $this->city = $company["city"];
      $this->state = $company["state"];
    }



}


?>
