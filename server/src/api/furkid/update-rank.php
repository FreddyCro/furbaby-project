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
  include_once '../../class/rank.php';

  $database = new Database();
  $table = isset($_GET['table']) ? $_GET['table'] : die();
  if ($table == 'dog') $tableName = $database->dog_rank_table_name;
  if ($table == 'cat') $tableName = $database->cat_rank_table_name;
  $db = $database->getConnection();

  $item = new Rank($db);

  $id = isset($_GET['id']) ? $_GET['id'] : die();

  if ($item->updateRank($tableName, $id)) {
    echo json_encode("Rank data updated.");
  } else {
    echo json_encode("Data could not be updated");
  }
}
