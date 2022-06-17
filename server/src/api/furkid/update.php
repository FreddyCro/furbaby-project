<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
  http_response_code(400);
  echo "Only POST method is allowed";
} else {
  include_once '../../config/database.php';
  include_once '../../class/question.php';

  $database = new Database();
  $table_name = $database->table_name;
  $db = $database->getConnection();

  $item = new Question($db);

  $id = isset($_GET['id']) ? $_GET['id'] : die();

  if ($item->updateQuestion($table_name, $id)) {
    echo json_encode("Employee data updated.");
  } else {
    echo json_encode("Data could not be updated");
  }
}
