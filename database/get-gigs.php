<?php
include_once 'connection.php';

function getGigs() {
  try {
    $db = connect();

    $query = $db->query('SELECT * FROM gigs');
    return $query->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo $e->getMessage();
    $db = null;
  }
}
