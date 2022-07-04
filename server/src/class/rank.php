<?php
class Rank
{
  // Connection
  private $conn;

  // Columns
  public $id;
  public $name;
  public $score;

  // Db connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getRank($table_name)
  {
    if (!isset($table_name)) return null;

    $sqlQuery = "SELECT id, name, score FROM " . $table_name . "";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
  }

  public function updateRank($table_name, $id)
  {
    if (!isset($table_name)) return null;

    $sqlQuery = "UPDATE " . $table_name . " SET score = score + 1 WHERE id = " . $id . "";
    $stmt = $this->conn->prepare($sqlQuery);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
