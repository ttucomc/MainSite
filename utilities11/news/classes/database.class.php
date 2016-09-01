<?php

/**
 * The Database class controls any commands and data sent to and from the db.
 *
 */
class Database
{

  /**
   * @var object $db   Contains the PDO object that connects to the db
   * @var object $stmt The SQL being sent to the db
   */
  private $db;
  private $stmt;

  /**
   * Class constructor
   *
   */
  public function __construct() {
    try {
      $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME .";port=" . DB_PORT,DB_USER,DB_PASS);
      $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      echo "Could not connect to the database.";
      exit;
    }
  }

  /**
   * Prepares a SQL query to be sent
   */
   public function query($query){
     $this->stmt = $this->db->prepare($query);
   }

  /**
   * Binds values to the parameters in the SQL statement
   *
   * @var string|int|bool|null $param The parameter in the SQL statement to be replaced
   * @var string|int|bool|null $value The actual data to be put in the SQL statement
   * @var object               $type  Constant to be used for the type of value
   */
  public function bind($param, $value, $type = null) {
    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  /**
   * Actually executes the SQL statement
   *
   * @return object $stmt Excuted statement
   */
   public function execute(){
     return $this->stmt->execute();
   }

  /**
   * Gets all of the rows from the SQL statement
   *
   * @return array A multidimensional array of all the information that matches
   */
  public function getAll() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Gets one row from the db that matches SQL statement
   *
   * @return array An array with one of the matches from the db
   */
  public function getOne() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Returns the number of rows effected by the query
   */
  public function rowCount(){
    return $this->stmt->rowCount();
  }

  /**
   * Returns the ID of the last row effected by the query
   */
  public function lastInsertId(){
    return $this->dbh->lastInsertId();
  }

  /**
   * Begins a transaction with the db
   */
  public function beginTransaction() {
    return $this->db->beginTransaction();
  }

   /**
    * Ends and commits a transaction to the db
    */
   public function endTransaction() {
     return $this->db->commit();
   }

   /**
    * Cancels a transaction with the db
    */
   public function cancelTransaction() {
     return $this->db->rollBack();
   }

}
