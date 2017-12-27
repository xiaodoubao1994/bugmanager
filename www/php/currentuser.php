<?php 
@header('content-type:text/html;charset=utf8');
@header('Access-Control-Allow-Origin:*');

session_start();

$userid = $_SESSION['userid'];
$username = $_SESSION['username']; 
$usertype = $_SESSION['usertype']; 

$user = array();
$user["id"] = $userid;
$user["username"] = $username;
$user["type"] = $usertype;

echo json_encode($user);


 ?>
