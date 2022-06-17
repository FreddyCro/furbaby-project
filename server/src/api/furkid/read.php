<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/question.php';

$database = new Database();
$table_name = $database->table_name;
$db = $database->getConnection();

$items = new Question($db);

$stmt = $items->getQuestions($table_name);
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
  http_response_code(404);
  echo json_encode(
    array("message" => "No record found.")
  );
}
