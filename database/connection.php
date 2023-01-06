<?php
// define('DB_HOST', 'db5011443853.hosting-data.io');
// define('DB_NAME', 'dbs9655278');

// define('DB_HOST', 'db5011438015.hosting-data.io');
// define('DB_USER', 'dbu2969000');
// define('DB_PASSWORD', 'iif2W3pkZ93wJjz');
// define('DB_NAME', 'dbs9650697');

// dbu2259319
// 4842Aezakmi920808

define('DB_HOST', 'localhost');
// define('DB_USER', 'roman');
// define('DB_PASSWORD', '12345');
define('DB_NAME', 'minor_thoughts');

$username = $password = '';
$connectionErr = false;
echo var_dump($connectionErr);
$connectionErrMessage = 'Wrong email or password';
$connection;

if (isset($_POST['login'])) {

  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  try {
    $connection = new mysqli(DB_HOST, $username, $password, DB_NAME);
  } catch (\Throwable $th) {
    $connectionErr = true;
    echo 'error';
    header("Location: ../login.php");
  }
}
