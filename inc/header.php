<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, put, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Headers:Accept, Content-Type', 'Access-Control-Allow-Header');
header('Access-Control-Max-Age:3600');

//jos selain tekee esikyselyn eli lähettää http metodille options esikyselyn
//Prelight-kyselyjen käsityely tulee tehdä näin, koska muuten mahdollisia virheilmoituksia ei palauteta välttämättä frontendiin.
if($_SERVER['REQUEST_METHOD']==='OPTIONS'){
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_RESQUEST_HEADERS']}");
exit(0);
}