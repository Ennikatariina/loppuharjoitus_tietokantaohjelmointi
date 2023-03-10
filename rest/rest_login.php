<?php
require("../inc/header.php");

//Kirjautuessa startataan sessio.
session_start();
require("./db_user_controller.php");

//kun käyttäjä yrittää kirjautua, niin katsotaan onko sessio jo käynnissä eli käyttäjä kirjautuneena
if(isset($_SESSION['username'])){
    http_response_code(200);
    echo $_SESSION['username'];
    return;
}

//Onko asetettu post-parametria: onko määritelty uname parametria ja pw parametria
if(!isset($_POST['uname']) || !isset($_POST['pw'])){
    http_response_code("401");
    echo "User not defined. Give valid username and password rest_login";
    return;
}

$uname= $_POST['uname'];
$pw= $_POST['pw'];

$verified_uname= checkUser($uname, $pw);
if($verified_uname){
    $_SESSION["username"]=$verified_uname;
    http_response_code(200);
    echo $verified_uname;
}else{
    http_response_code(401);
    echo"Wrong username or password.";
}