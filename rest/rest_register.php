<?php
require("../inc/header.php");

//Rekisteröinnissä startataan sessio.
session_start();
require("./db_user_controller.php");
//rekisteröinnissa otetaan vastaan json tiedon
$body =file_get_contents("php://input");
$user=json_decode($body);

//Onko syötteitä asetettu
if(!isset($user ->uname) || !isset($user ->pw)){
    http_response_code("400");
    echo "User not defined. Give valid username and password rest_register";
    return;
}

//tutkitaan onko käyttäjätunnus järkevä
if(preg_match('/^[a-zA-Z0-9]+$/', $user->uname)== 0){
    echo "Käyttäjätunnus ei kelpaa.";
    return;
} 

//tutkitaan onko salasanassa riittävästi merkkejä

if(strlen($user->pw)<= 5) {
    echo "Salasanan tulee sisältää vähintään 5 merkkiä.";
    return;
} 

$uname= strip_tags($user->uname);
$pw= strip_tags($user->pw);

registerUser($uname, $pw);

$_SESSION['username']=$uname;

http_response_code('200');
echo "User $user->uname registered";
