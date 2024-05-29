<?php 

function filter($data){
    $data = htmlspecialchars($data);
    $data =trim($data);
    $data= stripslashes($data);
    return $data ;
}
$host ="localhost";
$user="root";
$pass = "";
$dbname="book";
$tbname="tour";
$sql = "mysql:host=$host;dbname=$dbname";
