<?php

function filter($data){
    $data = htmlspecialchars($data);
    $data =trim($data);
    $data= stripslashes($data);
    return $data ;
}
$host = "localhost";
$username = "SAMIR";
$dbname="login";
$pass="samir123";
$tbname="admin";
