<?php
class Database
{
  // appache host
  private $host = "192.168.99.100";

  // [MYSQL_PORT] from docker env
  private $port = "3306";

  // [MYSQL_DATABASE] from docker env
  private $database_name = "furkid";

  // [MYSQL_USER] from docker env
  private $username = "test";

  // [MYSQL_PASSWORD] from docker env
  private $password = "test";

  public $dog_quiz_table_name = "furkid_dog_quiz";
  public $dog_rank_table_name = "furkid_dog_rank";
  public $cat_quiz_table_name = "furkid_cat_quiz";
  public $cat_rank_table_name = "furkid_cat_rank";

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
