<?php

class DB {
  static function connection(){
    $conn = null;
    try {
      $conn = new PDO('mysql:host=localhost;dbname=expris', 'root', '');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      throw $e;
    }
    return $conn;
  }
}
