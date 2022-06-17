<?php
class Question
{

  // Connection
  private $conn;

  // Table
  private $db_table = "furkid_questions";

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
}
