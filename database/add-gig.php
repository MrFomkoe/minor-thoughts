<?php
include_once 'connection.php';



if (isset($_POST['add-gig'])) {
  $db = connect();
  $venue = filter_input(INPUT_POST, 'gig-venue', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $date = filter_input(INPUT_POST, 'gig-date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $time = filter_input(INPUT_POST, 'gig-time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $query = $db->prepare('INSERT INTO gigs (venue, date, time, upcoming) VALUES (:venue, :date, :time, :upcoming)');
  $query->execute(['venue' => $venue, 'date' => $date, 'time' => $time, 'upcoming' => true]);
  if ($query->rowCount()) {
    // A row was inserted, let's set a success message
    $_SESSION['gigStatus'] = "Gig added";
    header("Location: ../dashboard.php");
    exit;
  } else {
    // No row was inserted, let's set an error message
    $_SESSION['gigStatus'] = "Gig not added";
  }
  $db = null;
}


?>