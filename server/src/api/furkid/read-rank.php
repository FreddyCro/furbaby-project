<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/rank.php';

$database = new Database();

$table = isset($_GET['table']) ? $_GET['table'] : die();
if ($table == 'dog') $tableName = $database->dog_rank_table_name;
if ($table == 'cat') $tableName = $database->cat_rank_table_name;

$db = $database->getConnection();

$items = new Rank($db);

$stmt = $items->getRank($tableName);
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
  $rankArr = array();
  $rankArr["body"] = array();
  $rankArr["itemCount"] = $itemCount;

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($rankArr["body"], $row);
  }

  echo json_encode($rankArr);
} else {
  http_response_code(404);
  echo json_encode(
    array("message" => "No record found.")
  );
}
