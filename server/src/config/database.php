<?php
class Database
{
  private $host = "192.168.99.100";
  private $port = "8366";
  private $database_name = "furkid";
  private $username = "test";
  private $password = "test";

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
