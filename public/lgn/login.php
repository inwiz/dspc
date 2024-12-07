<?php

include_once('classes/DB.php');
include_once('classes/User.php');

$database = new DB;
$db = $database->getConnection();
$user = new User($db);


$user->userLogin($_POST['login'],$_POST['password']);




