<?php
function callAPI($method, $url, $data)
{
  $curl = curl_init();
  switch ($method) {
    case "POST":
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      break;
    case "PUT":
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      break;
    default:
      if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
  }
  // OPTIONS:
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'APIKEY: 111111111111111111111',
    'Content-Type: application/json',
  ));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  // EXECUTE:
  $result = curl_exec($curl);
  if (!$result) {
    die("Connection Failure");
  }
  curl_close($curl);
  return $result;
}

$title = "你有自信成為皇家級的飼主嗎?";
$username = isset($_GET["n"]) ? $_GET["n"] : null;
$category = isset($_GET["c"]) ? $_GET["c"] : null;
$level = isset($_GET["lv"]) ? $_GET["lv"] : null;
$score = isset($_GET["sc"]) ? $_GET["sc"] : null;

// get data from another server
// $url = "http://192.168.99.100:8080/api/furkid/get-sharing.php?n={$username}&c={$category}&lv={$level}&sc={$score}";
$ogUrl = "https://event.udn.com/royalcanin2022/sharing.php?n={$username}&c={$category}&lv={$level}&sc={$score}";

$url = "https://event.udn.com/royalcanin2022/api/furkid/get-sharing.php?n={$username}&c={$category}&lv={$level}&sc={$score}";

$get_data = callAPI("GET", $url, false);
$title = json_decode($get_data, true);
$errors = $response["response"]["errors"];
?>


<!DOCTYPE html>
<html lang="zh-HANT-TW">

<head>



  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">



  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta property="og:title" content="<?= $title ?>" />
  <meta property="og:url" content="<?= $ogUrl ?>" />
  <meta property="og:image" content="https://event.udn.com/royalcanin2022/assets/img/meta<?= $category . $level ?>.png" />
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:description" content="參加活動就有機會拿3個月份寵物飼料。你也一起來挑戰看看吧！" />
  <meta property="fb:app_id" content="350231215126101" />
  <link rel="icon" href="https://event.udn.com/royalcanin2022/favicon.ico">
  <title>法國皇家寵物健康專家</title>
</head>

<body>
  <main style="opacity: 0;">
    <h1>毛寵達人大會考</h1>
    <p>開始測驗</p>
    <p>你有自信成為<br>皇家級的飼主嗎？</p>
    <p>軟萌的幼貓、幼犬惹人憐愛，<br>需要特殊營養為體質打底。<br>隨著牠一天天成長，<br>正確的轉糧與飼主照護觀念更為重要。<br><br>《皇家營養學：毛寵達人大會考》比專業知識，<br>也比答題速度，找朋友一起挑戰你的毛寵達人級數吧！</p>
    <button>我是狗主人 GO</button>
    <button>我是貓主人 GO</button>
    <p>好飼主必知守則</p>
    <p>守護愛犬、愛貓的健康成長，<br>除了飼主的細心觀察、照護，<br>遵循獸醫師的專業建議，<br>打造最適合牠們成長的環境。</p>
  </main>

  <script>
    setTimeout(function() {
      window.location.replace('https://event.udn.com/royalcanin2022/');
    }, 1000);
  </script>
</body>

</html>