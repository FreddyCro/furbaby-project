<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/question.php';

$database = new Database();
$table_name = $database->table_name;
$db = $database->getConnection();

$items = new Question($db);

$id = isset($_GET['id']) ? $_GET['id'] : die();
$stmt = $items->getOneQuestion($table_name, $id);

$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
  echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "No record found.")
  );
}
