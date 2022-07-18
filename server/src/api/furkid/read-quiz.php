<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/quiz.php';

$database = new Database();

$table = isset($_GET['table']) ? $_GET['table'] : die();
if ($table == 'dog') $tableName = $database->dog_quiz_table_name;
if ($table == 'cat') $tableName = $database->cat_quiz_table_name;

$db = $database->getConnection();

$items = new Question($db);

$stmt = $items->getQuestions($tableName);
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
  $questionArr = array();
  $questionArr["body"] = array();
  $questionArr["itemCount"] = $itemCount;

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($questionArr["body"], $row);
  }

  echo json_encode($questionArr);
} else {
  echo json_encode(
    array("message" => "No record found.")
  );
}
