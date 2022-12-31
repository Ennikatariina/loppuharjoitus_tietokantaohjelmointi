<?php
require_once "../inc/functions.php";
require_once "../inc/header.php";
require('../dbconnection.php');


$categoryId=$_GET["categoryId"];

try {
    $db =createDbConnection('../loppuharjoitus_database.db');
    $sql = "select * from productcategory where id = $categoryId";
    $query = $db->query($sql);
    $category = $query->fetch(PDO::FETCH_ASSOC);
    
    $sql = "select * from product where category_id = $categoryId";
    $query = $db->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');
    echo json_encode(array(
       "category" => $category['category'],
       "products" => $products 
    ),JSON_PRETTY_PRINT);
}catch (PDOException $pdoex){
    returnError($pdoex);
}

?>

