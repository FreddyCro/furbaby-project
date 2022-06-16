<?php
echo "Hello World!!!";

try {
  $pdo = new PDO("mysql:host=localhost;port=8306;dbname=some_db", "some_user", "some_password");

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
