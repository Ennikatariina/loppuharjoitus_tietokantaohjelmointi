<?php
require_once "../inc/functions.php";
require_once "../inc/header.php";
require('../dbconnection.php');

try {
    $db =createDbConnection('../loppuharjoitus_database.db');
    selectAsJson($db, 'select * from productcategory');
}catch (PDOException $pdoex){
    returnError($pdoex);
}

?>