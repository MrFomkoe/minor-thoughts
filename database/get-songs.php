<?php
include_once 'connection.php';

function getSongs() {
  $songArr = [];
  try {
    $db = connect();

    $query = $db->query('SELECT * FROM discography');
    return $query->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $e) {
    echo $e->getMessage();
    $db = null;
  }
}
