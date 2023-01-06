<?php 
session_start();
define('DB_HOST', 'localhost');
define('DB_NAME', 'minor_thoughts');
$username = $password = '';
$connectionErr = false;
$connectionErrMessage = 'Wrong email or password';

if (isset($_POST['login'])) {
  
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  try {
    $connection = new mysqli(DB_HOST, $username, $password, DB_NAME);
    $_SESSION['connection'] = $connection;
    header("Location: ./dashboard.php");
  } catch (\Throwable $th) {
    $connectionErr = true;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/style.css">
  <title>Document</title>
</head>

<body>
  <div class="login">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
      <label for="username">Username</label>
      <input type="text" name="username" required>

      <label for="password">Password</label>
      <input type="text" name="password" required>

      <input class="submit-btn" type="submit" value="Login" name="login">

      <div class="invalid-feedback">
        <?php echo $connectionErr ? $connectionErrMessage : null ?>
      </div>
    </form>

  </div>
</body>

</html>