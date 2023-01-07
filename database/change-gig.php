<?php
include_once 'connection.php';

if (isset($_POST['change-gig'])) {
  $db = connect();
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $venue = filter_input(INPUT_POST, 'change-venue', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $date = filter_input(INPUT_POST, 'change-date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $time = filter_input(INPUT_POST, 'change-time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $upcoming = filter_input(INPUT_POST, 'change-upcoming', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if ($upcoming !== NULL) {
    $upcoming = true;
  } else {
    $upcoming = false;
  }

  try {
    $query = $db->prepare('UPDATE gigs SET venue = :venue, date = :date, time = :time, upcoming = :upcoming WHERE id = :id');
    $query->execute(['venue' => $venue, 'date' => $date, 'time' => $time, 'upcoming' => $upcoming, 'id' => $id]);

    if ($query->rowCount()) {
      // Row was updated, let's set a success message
      $_SESSION['gigChangeStatus'] = "Gig updated";
      header("Location: ../dashboard.php");
      exit;
    } else {
      // No row was updated, let's set an error message
      $_SESSION['gigChangeStatus'] = "Failed to update gig";
      header("Location: ../dashboard.php");
      exit;
    }
  } catch (Exception $e) {
    // An exception was thrown, let's set the exception's message
    $_SESSION['gigChangeStatus'] = 'Error: ' . $e->getMessage();;
  }
}

if (isset($_POST['delete-gig'])) {
  $db = connect();
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  try {
    $query = $db->prepare('DELETE FROM gigs WHERE id = :id');
    $query->execute(['id' => $id]);

    if ($query->rowCount()) {
      // Row was updated, let's set a success message
      $_SESSION['gigChangeStatus'] = "Gig deleted";
      header("Location: ../dashboard.php");
      exit;
    } else {
      // No row was updated, let's set an error message
      $_SESSION['gigChangeStatus'] = "Failed to delete gig";
    }
  } catch (Exception $e) {
    // An exception was thrown, let's set the exception's message
    $_SESSION['gigChangeStatus'] = 'Error: ' . $e->getMessage();;
  }
}