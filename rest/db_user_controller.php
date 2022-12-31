<?php
require('../dbconnection.php');

/**
 * Insert a new user in the database
 */

 function registerUser($uname,$pw){
    $db= createDbConnection('../loppuharjoitus_database.db');
    //Tässä vaiheessa pitäisi testata, että käyttäjätunnut ja salasana ovat oikeanlaisia

    $pw=password_hash($pw, PASSWORD_DEFAULT);
    $sql= "INSERT INTO user (username, passwd) VALUES (?,?)";
    $statement =$db->prepare($sql);
    $statement ->execute(array($uname, $pw));
    //Tässä pitäisi olla try cath rakenne, jos jokin menee pieleen. Nyt oletetaan että kaikki menee hyvin. 
 }

 /**
  * Checks the user credentials and returns the username
  */
 function checkUser($uname, $pw){
    $db= createDbConnection('../loppuharjoitus_database.db');
    $sql="SELECT passwd FROM user WHERE username=?";
    $statement =$db -> prepare($sql);
    $statement ->execute(array($uname));
//fetchColumn hakee ensimäisen rivin ensimmäisen sarakkeen
    $hashedpw=$statement->fetchColumn();

//aletaan tutkimaan onko salasana oikea
if(isset($hashedpw)){
    return password_verify($pw, $hashedpw) ? $uname: null;
}
return null;
 }

 /**
  * Getting personal messages for the user
  */
  function getUserMesssages($uname){
    $db=createDbConnection('../loppuharjoitus_database.db');

    $sql="SELECT msg FROM message WHERE username=?";
    $statement =$db->prepare($sql);
    $statement->execute(array($uname));

    return $statement ->fetchAll(PDO::FETCH_COLUMN,0);
  }