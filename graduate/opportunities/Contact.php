<?php

/*

Texas Tech University
College Of Media and Communications
05/18/16

*/

class Contact {

  /*

  ------- Contact -------
  @param id int
  @param db PDO Database
  @param firstName string
  @param lastName string
  @param phone string
  @param email string

  */

  private $id = 0;
  private $db;

  public $firstName = "";
  public $lastName = "";
  public $phone = "";
  public $email = "";


  public static function addContact($db, $firstName, $lastName, $phone, $email, $company, $job) {

      try {

        $newContact = $db->prepare('INSERT INTO contacts (firstName, lastName, phone, email, company, job)
                      VALUES (:firstName, :lastName, :phone, :email, :company, :job);');
        $newContact->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $newContact->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $newContact->bindParam(':phone', $phone, PDO::PARAM_STR);
        $newContact->bindParam(':email', $email, PDO::PARAM_STR);
        $newContact->bindParam(':company', $company, PDO::PARAM_INT);
        $newContact->bindParam(':job', $job, PDO::PARAM_INT);

        $newContact->execute();

      } catch(Exception $e) {

        echo $e->getMessage();
        die();
      }
  }

  public static function withID(PDO $db, $id) {

    $instance = new self();
    $instance->db = $db;
    $instance->id = $id;

    $instance->loadByID();

    return $instance;
  }

  public function loadByID() {

    try {

      $contact = $this->db->prepare('SELECT firstName, lastName, phone, email
                                     FROM contacts
                                     WHERE id = ?;');

      $contact->bindParam(1, $this->id, PDO::PARAM_INT);
      $contact->execute();

    } catch(Exception $e) {
      echo "Couldnt create contact";
      echo $e->getMessage();
      die();
    }


    $contactList = $contact->fetch();

    $this->firstName = $contactList["firstName"];
    $this->lastName = $contactList["lastName"];
    $this->phone = $contactList["phone"];
    $this->email = $contactList["email"];


    // foreach($contactList as $key => $value) {
    //   echo "Key: " . $key . " Value: " . $value;
    // }
  }





}
