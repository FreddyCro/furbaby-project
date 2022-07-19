<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/rank.php';

$description = "軟萌的幼貓、幼犬惹人憐愛，需要特殊營養為體質打底，隨著牠一天天成長，正確的轉糧與飼主照護觀念更為重要，找朋友一起挑戰你的毛寵達人級數吧！";

try {
  $database = new Database();
  $db = $database->getConnection();

  if (!$db) {
    header("Location: https://event.udn.com/royalcanin2022/");
    die();
  }
  
  $username = isset($_GET["n"]) ? $_GET["n"] : null;
  $category = isset($_GET["c"]) ? $_GET["c"] : null;
  $level = isset($_GET["lv"]) ? $_GET["lv"] : null;
  $score = isset($_GET["sc"]) ? $_GET["sc"] : null;
  $wrongScore = isset($score) ? max(7 - (int) $score, 0) : null;
  
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
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)['score']) {
          $participants += $row;
          array_push($rankArr, $row);
        }
    
        for ($i = 0; $i <= (int) $score; $i++) {
          $row = (int) $rankArr[$i];
          $acc += $row;
        }
    
        $ranking = $participants - $acc + 1;
      }
    }
  
    // handle description
    $description = "{$username} 剛剛測驗了自己的毛寵達人級數，答對{$score}題，答錯{$wrongScore}題";
  
    if (isset($level)) {
      $levelName = "";
      if ($level == "1") $levelName = "毛寵新鮮人";
      if ($level == "2") $levelName = "毛寵素人";
      if ($level == "3") $levelName = "毛寵達人";
      if ($level == "4") $levelName = "皇家級毛寵達人";
  
      $description = $description . "，等級為{$levelName}";
    }
  
    if (isset($ranking)) {
      $description = $description . "，排名為{$ranking}";
    }
  }
} catch (Exception $e) {
  // do nothing
}

$title = "法國皇家寵物健康專家";
$redirectUrl = "'https://event.udn.com/royalcanin2022/'";

echo "<!DOCTYPE html>";
echo "<html lang=\"zh-HANT-TW\">";
echo "<head>";
echo "<meta charset=\"utf-8\">";
echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
echo "<meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0\">";
echo "<meta property=\"og:title\" content=\"{$title}\" />";
echo "<meta property=\"og:url\" content=\"{$redirectUrl}\" />";
echo "<meta property=\"og:image\" content=\"https://event.udn.com/royalcanin2022/meta.jpg\" />";
echo "<meta property=\"og:image:width\" content=\"1200\">";
echo "<meta property=\"og:image:height\" content=\"630\">";
echo "<meta property=\"og:description\" content=\"{$description}\" />";
echo "<link rel=\"icon\" href=\"https://event.udn.com/royalcanin2022/favicon.ico\">";
echo "<title>{$title}</title>";
echo "</head>";
echo "<body>";
echo "</body>";
echo "<script>";
echo "(function() { setTimeout(function() { window.location.replace({$redirectUrl}); }, 1000); })();";
echo "</script>";
echo "</html>";
