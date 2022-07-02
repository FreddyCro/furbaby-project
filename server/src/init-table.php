<?php
include_once './config/database.php';

function craeteQuizTable($db, $table_name)
{
  // create furkid_questions table
  $db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255),
    participants INT NOT NULL,
    correct INT NOT NULL,
    PRIMARY KEY (id)
  );");

  // insert data into furkid_questions table
  if ($db->query("SELECT 1 FROM $table_name")->rowCount() != 0) {
    echo "Table $table_name already exists \n";
  } else {
    for ($i = 1; $i <= 7; $i++) {
      $sql = 'INSERT INTO ' . $table_name . '(name, participants, correct) VALUES(:name, :participants, :correct)';

      $statement = $db->prepare($sql);
      $statement->execute([
        ':name' => 'q' . $i,
        ':participants' => 0,
        ':correct' => 0
      ]);
    }
  }
}

function createRankTable($db, $table_name)
{

  $db->exec("CREATE TABLE IF NOT EXISTS " . $table_name . "(
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255),
    score INT NOT NULL,
    PRIMARY KEY (id)
  );");

  if ($db->query("SELECT 1 FROM $table_name")->rowCount() != 0) {
    echo "Table $table_name already exists \n";
  } else {
    for ($i = 1; $i <= 7; $i++) {
      $sql = 'INSERT INTO ' . $table_name . '(name, score) VALUES(:name, :score)';

      $statement = $db->prepare($sql);
      $statement->execute([
        ':name' => 'q' . $i,
        ':score' => 0
      ]);
    }
  }
}

function printQuizTable($db, $table_name)
{
  $sql = "SELECT * FROM $table_name";
  $statement = $db->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();

  echo "<h3><$table_name></h3>";
  echo "<table>";
  echo "<tr>";
  echo "<th>id</th>";
  echo "<th>name</th>";
  echo "<th>participants</th>";
  echo "<th>correct</th>";
  echo "</tr>";

  foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['participants'] . "</td>";
    echo "<td>" . $row['correct'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}

function printRankTable($db, $table_name)
{
  $sql = "SELECT * FROM $table_name";
  $statement = $db->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();

  echo "<h3><$table_name></h3>";
  echo "<table>";
  echo "<tr>";
  echo "<th>id</th>";
  echo "<th>name</th>";
  echo "<th>score</th>";
  echo "</tr>";

  foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['score'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}

try {
  $database = new Database();
  $db = $database->getConnection();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dogQuizTableName = $database->dog_quiz_table_name;
  $dogRankTableName = $database->dog_rank_table_name;
  $catQuizTableName = $database->cat_quiz_table_name;
  $catRankTableName = $database->cat_rank_table_name;

  // create quiz table
  craeteQuizTable($db, $dogQuizTableName);
  craeteQuizTable($db, $catQuizTableName);

  // print quiz table
  printQuizTable($db, $dogQuizTableName);
  printQuizTable($db, $catQuizTableName);

  // create rank table
  createRankTable($db, $dogRankTableName);
  createRankTable($db, $catRankTableName);

  // print rank table
  printRankTable($db, $dogRankTableName);
  printRankTable($db, $catRankTableName);
} catch (PDOException $exception) {
  echo "Database could not be connected: " . $exception->getMessage();
}
