<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './config/database.php';

try {
  // $pdo = new PDO("mysql:host=localhost;port=8306;dbname=some_db", "some_user", "some_password");

  $database = new Database();
  $db = $database->getConnection();

  echo "Connected to database";

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $pdo->exec("CREATE TABLE IF NOT EXISTS my_first_test_table(
    page_ID INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255),
    PRIMARY KEY (page_ID)
  );");

  $name = "John" . rand();
  $sql = 'INSERT INTO my_first_test_table(name) VALUES(:name)';
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':name' => $name
  ]);

  $data = $pdo->query('SELECT * FROM my_first_test_table');
  foreach ($data as $row) {
    print_r($row);
  }
} catch (PDOException $pe) {
  die("Could not connect to the database: " . $pe->getMessage());
}
