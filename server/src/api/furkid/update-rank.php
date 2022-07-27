<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
 *  Google recaptcha
 *  @return bool 
 */
function recaptchaCheck()
{
  return true;

  // TODO: implement recaptcha

  // Google reCAPTCHA private key
  $data['secret'] = '6Ld7IxohAAAAAOrBVJ39N8mZW6K_VEZb1kxV7PmR';
  $data['response'] = $_POST['g-recaptcha-response'];
  $ch = curl_init();

  // verify
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  $result = curl_exec($ch);
  curl_close($ch);

  // decode
  $result = json_decode($result, true);

  # Verify captcha
  // $post_data = http_build_query(
  //   array(
  //     'secret' => '6Ld7IxohAAAAAOrBVJ39N8mZW6K_VEZb1kxV7PmR',
  //     'response' => $_POST['g-recaptcha-response'],
  //     'remoteip' => $_SERVER['REMOTE_ADDR']
  //   )
  // );
  // $opts = array(
  //   'http' =>
  //   array(
  //     'method'  => 'POST',
  //     'header'  => 'Content-type: application/x-www-form-urlencoded',
  //     'content' => $post_data
  //   )
  // );
  // $context  = stream_context_create($opts);
  // $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
  // $result = json_decode($response);

  // check
  if (!isset($result['success']) || !$result['success']) {
    return false;
  } else {
    return true;
  }
}

if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
  http_response_code(400);
  echo "Only POST method is allowed";
} else {
  $recaptcha = recaptchaCheck();

  if ($recaptcha) {
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
  } else {
    echo json_encode("Recaptcha failed");
  }
}
