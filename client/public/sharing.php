<?php
$description = "<%= htmlWebpackPlugin.options.description %>";

// sharing.php
$currentPage = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

if ($currentPage == "sharing.php") {
  $username = isset($_GET["n"]) ? $_GET["n"] : null;
  $category = isset($_GET["c"]) ? $_GET["c"] : null;
  $score = isset($_GET["sc"]) ? $_GET["sc"] : 0;
  $wrongScore = isset($score) ? 0 : 7 - (int) $score;
  $level = isset($_GET["lv"]) ? $_GET["lv"] : null;
  $hash = time();

  // TODO: get ranking
  $ranking = null;

  $description = "{$username} 剛剛測驗了自己的毛寵達人級數，答對{$score}，答錯{$wrongScore}";

  if (isset($level)) {
    $levelName = "";
    if ($level == "1") $levelName = "毛寵新鮮人";
    if ($level == "2") $levelName = "毛寵素人";
    if ($level == "3") $levelName = "毛寵達人";
    if ($level == "4") $levelName = "皇家級毛寵達人";

    $description = $description . "，等級為{$levelName}";
  }

  if ($ranking) {
    $description = $description . "，排名為{$ranking}";
  }
}
?>

<!DOCTYPE html>
<html lang="zh-HANT-TW">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <meta property="og:title" content="<%= htmlWebpackPlugin.options.metaTitle %>" />
  <meta property="og:url" content="<%= BASE_URL %>" />
  <meta property="og:image" content="<%= BASE_URL %>meta.jpg" />
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:description" content="<?= $description ?>" />
  <link rel="icon" href="<%= BASE_URL %>favicon.ico">

  <title><%= htmlWebpackPlugin.options.title %></title>
</head>

<body>
  <noscript>
    <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
  </noscript>
  <div id="app"></div>
  <!-- built files will be auto injected -->
</body>

</html>