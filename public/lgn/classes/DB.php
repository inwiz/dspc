<?php

class DB {

public $conn;


function getConnection() {
  $this->conn = null;
  include $_SERVER['DOCUMENT_ROOT']."/config.php";
  $this->conn = new mysqli($host,$user,$pass,$database);
  if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }

  return $this->conn;
}


}