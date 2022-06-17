<?php
class Question
{

  // Connection
  private $conn;

  // Columns
  public $id;
  public $name;
  public $participants;
  public $correct;

  // Db connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getQuestions($table_name)
  {
    if (!isset($table_name)) return null;

    $sqlQuery = "SELECT id, name, participants, correct FROM " . $table_name . "";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
  }

  public function getOneQuestion($table_name, $id)
  {
    if (!isset($table_name)) return null;

    $sqlQuery = "SELECT id, name, participants, correct FROM " . $table_name . " WHERE id = " . $id . "";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
  }

  // update single question
  public function updateQuestion($table_name, $id)
  {
    if (!isset($table_name)) return null;

    $sqlQuery = "UPDATE " . $table_name . " SET participants = participants + 1 WHERE id = " . $id . "";
    $stmt = $this->conn->prepare($sqlQuery);

    if ($stmt->execute()) {
      return true;
    }
    
    return false;
  }
}
