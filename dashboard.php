<?php
include './database/add-song.php';
include './database/add-gig.php';
include './database/get-songs.php';
include './database/get-gigs.php';

// Checked if logged in, if not - redirect to login page;
if ($_SESSION["loggedIn"] === false) {
  echo 'not in session';
  header("Location: ./login.php");
  exit;
}



if (!empty($_SESSION['uploadStatus'])) {
  $uploadStatusMsg = $_SESSION['uploadStatus'];
} else {
  $uploadStatusMsg = '';
}

if (!empty($_SESSION['gigStatus'])) {
  $gigAddStatusMsg = $_SESSION['gigStatus'];
} else {
  $gigAddStatusMsg = '';
}

try {
  // Get gigs and songs
  $songs = getSongs();
  $gigs = getGigs();
} catch (Exception $e) {
  // If an error is thrown, echo the message
  echo $e->getMessage();
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
  <main class="dashboard">
    <section>
      <h2> Add song</h2>
      <div class="invalid-feedback">
        <?php echo $uploadStatusMsg; ?>
      </div>
      <form action="./database/add-song.php" method="POST" enctype="multipart/form-data">
        <label for="song-name">Song name</label>
        <input type="text" name="song-name" required>

        <label for="spotify">Spotify link</label>
        <input type="text" name="spotify" required>

        <label for="apple">Apple link</label>
        <input type="text" name="apple" required>

        <label for="song-image">Image</label>
        <input class="file-upload" type="file" name="song-image" required>

        <input class="submit-btn" type="submit" value="UPLOAD" name="add-song">
      </form>
    </section>

    <section>
      <h2> Add gig</h2>
      <div class="invalid-feedback">
        <?php echo $gigAddStatusMsg ?>
      </div>
      <form action="./database/add-gig.php" method="POST">
        <label for="song-name">Where</label>
        <input type="text" name="gig-venue" required>

        <label for="spotify">When</label>
        <input type="text" name="gig-date" required>

        <label for="apple">Time</label>
        <input type="text" name="gig-time" required>


        <input class="submit-btn" type="submit" value="UPLOAD" name="add-gig">
      </form>

    </section>

  </main>
</body>

</html>