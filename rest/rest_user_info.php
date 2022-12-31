<?php
require("../inc/header.php");
session_start();
require("./db_user_controller.php");

if(!isset($_SESSION['username'])){
    http_response_code(403);
    echo "No access for user data";
    return;
}

$messages = getUserMesssages($_SESSION['username']);
$json= json_encode($messages);
echo $json;