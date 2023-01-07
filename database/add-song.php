<?php
include_once 'connection.php';



if (isset($_POST['add-song'])) {
  $db = connect();
  $name = $_POST['song-name'];
  $spotify = $_POST['spotify'];
  $apple = $_POST['apple'];


  $targetDir = "../media/song_covers/";
  $fileName = basename($_FILES["song-image"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


  if (!empty($_FILES["song-image"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowTypes)) {
      // Upload to server
      if (move_uploaded_file($_FILES["song-image"]["tmp_name"], $targetFilePath)) {
        $query = $db->prepare('INSERT INTO discography (name, spotify, apple, image) VALUES (:name, :spotify, :apple, :image)');
        $query->execute(['name' => $name, 'spotify' => $spotify, 'apple' => $apple, 'image' => $fileName]);
        if ($query->rowCount()) {
          // A row was inserted, let's set a success message
          $_SESSION['uploadStatus'] = "Uploaded";
          // $uploadStatusMsg = "Uploaded";
          header("Location: ../dashboard.php");
          exit;
        } else {
          // No row was inserted, let's set an error message
          $_SESSION['uploadStatus'] = "Failed to upload";
        }
      }
    }
  }
  $db = null;
}

?>
