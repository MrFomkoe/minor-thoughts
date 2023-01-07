<?php
// session_start();
include './database/connection.php';
$db = connect();
$username = $password = '';
$usernameErr = $passwordErr = $loginErr = "";
$_SESSION["loggedIn"] = false;
$_SESSION["username"] = '';


if (isset($_POST['login'])) {

  // Check if username written
  if (empty($_POST["username"])) {
    $usernameErr = "Please enter username.";
  } else {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Check if password written
  if (empty($_POST["password"])) {
    $passwordErr = "Please enter password.";
  } else {
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    try {
      $query = $db->prepare("SELECT id, username, password FROM user WHERE username = :username");
      $query->execute(['username' => $username]);
      $userdata = $query->fetch(PDO::FETCH_ASSOC);

      // Check if user exists
      if (empty($userdata)) {
        $usernameErr = "No user found.";
      } else {
        // Check password correctness
        $hashedPassword = $userdata['password'];
        if (password_verify($password, $hashedPassword)) {
          // If password is correct, start a new session

          // Store data in session variables
          $_SESSION["loggedIn"] = true;
          $_SESSION["username"] = $username;

          // Redirect user to dashboard
          header("Location: ./dashboard.php");
          exit;
        } else {
          // If password is incorrect - show error
          $passwordErr = 'Wrong password.';
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
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
      <input type="text" name="username">
      <div class="invalid-feedback">
        <?php echo $usernameErr ?>
      </div>

      <label for="password">Password</label>
      <input type="text" name="password">
      <div class="invalid-feedback">
        <?php echo $passwordErr ?>
      </div>

      <input class="submit-btn" type="submit" value="Login" name="login">

    </form>

  </div>
</body>

</html>