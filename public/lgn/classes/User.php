<?php


class User 
{
   private $login;
   private $password;
   private $is_admin;
   private $status;
   private static $conn;
   private $session_name = 'authadmin';

function __construct($db)
{
    if (!self::$conn) {
        $this->conn = $db;
    }
  
    
}


    
function create() {
    
}

function update()  {
    
}

function delete() {

}

function cleanData($data)  {
    $check_data = trim(strip_tags($data));
    $check_data =  htmlspecialchars($check_data, ENT_QUOTES, 'UTF-8');
    return $check_data;
}




function setCurrentSession() {
    session_start();
    $_SESSION['admin'] = $this->session_name;

}


function userLogin($login,$password) {
  $login = $this->cleanData($login);
  $password = md5($this->cleanData($password));
  $sql = "SELECT `login`,`password` FROM `users` WHERE `login`='$login' AND `password`='$password' AND `status`=1";
  $result = $this->conn->query($sql);
  
  if ($result->num_rows > 0) {
        $auth = $this->setCurrentSession();
          header("Location: /lgn/crud-posts.php");
          exit; 
        
    } 
  else {
    // print_r($_SESSION);
    header("Location: /lgn/");    
    exit; 
  }
}


function checkAuth() {
    session_start();
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != $this->session_name) {
        header("Location: /lgn/");    
        exit; 
    }
}









}
