<?php
class Database
{
  private $host = "localhost";
  private $port = "3306";
  private $database_name = "furkid";
  private $username = "test";
  private $password = "test";
  public $table_name = "furkid_questions";
  public $conn;

  public function getConnection()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    } catch (PDOException $exception) {
      echo "Database could not be connected: " . $exception->getMessage();
    }
    
    return $this->conn;
  }
}
