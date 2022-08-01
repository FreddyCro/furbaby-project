<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/rank.php';

$database = new Database();

$table = isset($_GET['c']) ? $_GET['c'] : die();
$score = isset($_GET['sc']) ? $_GET['sc'] : die();
if ($table == 'dog') $tableName = $database->dog_rank_table_name;
if ($table == 'cat') $tableName = $database->cat_rank_table_name;

$db = $database->getConnection();

$items = new Rank($db);

$stmt = $items->getRank($tableName);
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
  $rankArr = array();
  $participants = 0;
  $acc = 0;

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $participants += $row['score'];
    array_push($rankArr, $row['score']);
  }

  for ($i = 0; $i <= (int) $score; $i++) {
    $row = (int) $rankArr[$i];
    $acc += $row;
  }
  
  echo json_encode($participants - $acc + 1);
} else {
  echo json_encode(1);
  // echo json_encode(
  //   array("message" => "No record found.")
  // );
}
