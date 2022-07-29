<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/rank.php';

try {
  $database = new Database();
  $db = $database->getConnection();

  $category = isset($_GET["c"]) ? $_GET["c"] : null;
  $score = isset($_GET["sc"]) ? $_GET["sc"] : null;
  $username = isset($_GET["n"]) ? $_GET["n"] : null;
  // $level = isset($_GET["lv"]) ? $_GET["lv"] : null;
  // $wrongScore = isset($score) ? max(7 - (int) $score, 0) : null;

  $title = "你有自信成為皇家級的飼主嗎?";

  if (isset($username) && isset($category) && isset($score)) {
    $ranking = null;

    // get ranking
    if (isset($category)) {
      $items = new Rank($db);

      if ($category == 'dog') $tableName = $database->dog_rank_table_name;
      if ($category == 'cat') $tableName = $database->cat_rank_table_name;

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

        $ranking = $participants - $acc + 1;
      }
    }

    // handle title
    $title = "{$username}剛剛測驗自己的毛寵達人級數，答對{$score}題";

    if (isset($ranking)) {
      $title = $title . "，排名為{$ranking}";
    }

    echo json_encode($title);
  } else {
    echo json_encode($title);
  }
} catch (Exception $e) {
  // do nothing
}
