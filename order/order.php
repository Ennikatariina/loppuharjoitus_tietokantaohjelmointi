<?php
require("../inc/header.php");
require ("../inc/functions.php");
require ("../dbconnection.php");

//Oletan tässä, että frontista tulee json dataa, joka sisältää seuraavat tiedot: tilaajan (user), tilatut tuotteet (nimen ja tuote numeron) ja niiden määrän.
$body = file_get_contents("php://input");
$dataObject =json_decode($body);


function sqlQuery($db, $sql){
    $statement =$db->prepare($sql);
    return $statement->execute();
}


$db =createDbConnection('../loppuharjoitus_database.db');
//En saanut auto_incrementtiiä toimimaan sqlitessä, niin siksi tein nämä
$sqlMax= "SELECT MAX(ordernumber) FROM order1";
$sqlorderitemMax= "SELECT MAX(id_orderitem) FROM orderitem";
$lastOrderNumber = sqlQuery($db, $sqlMax);
$lastOrderItemNumber = sqlQuery($db, $sqlorderitemMax);

$date=date("Y/m/d");
$username=$dataObject->username;
$id_orderitem=$lastOrderItemNumber +1;
$orderNumber=$lastOrderNumber +1;
$id=$dataObject->product_id; //tämä on tuotteen id. Huomasin tämän sarakkeen huonon nimen vasta jälkikäteen, enkä viitsi nyt alkaa sitä muuttamaan. 
$amount=$dataObject->amount;

$sqlOrder= "INSERT INTO order1 ('ordernumber', 'username', 'ordate') VALUES (?,?,?)";
$sqlOrterItem ="INSERT INTO orderitem (id_orderitem, ordernumber, id, amount) VALUES (?,?,?,?)"; //id on tuotteen id.

$statement =$db->prepare($sqlOrder);
$statement->execute(array($orderNumber,$username,$date));
//bindParam? 



//if(executeInsert($db, $sql)){
    //Success
//}else{
  //  returnError($pdoex);
//}