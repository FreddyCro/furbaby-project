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
  // TODO: implement recaptcha
  return true;

  // Google reCAPTCHA private key
  $data['secret'] = '';
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

  // check
  if (!isset($result['success']) || !$result['success']) {
    // failed
    return false;
  } else {
    // success
    return true;
  }
}

if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
  http_response_code(400);
  echo "Only POST method is allowed";
} else {
  if (recaptchaCheck()) {
    include_once '../../config/database.php';
    include_once '../../class/quiz.php';

    $database = new Database();
    $table = isset($_GET['table']) ? $_GET['table'] : die();
    if ($table == 'dog') $tableName = $database->dog_quiz_table_name;
    if ($table == 'cat') $tableName = $database->cat_quiz_table_name;
    $db = $database->getConnection();

    $item = new Question($db);

    $id = isset($_GET['id']) ? $_GET['id'] : die();
    $correct = isset($_GET['correct']) ? $_GET['correct'] : die();

    if ($item->updateQuestion($tableName, $id, $correct)) {
      echo json_encode("Quiz data updated.");
    } else {
      echo json_encode("Data could not be updated");
    }
  } else {
    echo json_encode("Recaptcha failed");
  }
}
