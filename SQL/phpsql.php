<?php


     
    $user = "SAMIR";
    $pass = "samir123";
    $dbname = "login";
    $tbname = "myadmin";

    try{
        $con = new PDO("mysql:host=localhost;dbname=$dbname",$user,$pass);
        $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $updat ="UPDATE $tbname SET username='samir'  WHERE id='235' ";
        $con->exec($updat);
        echo "yes";
    }catch(PDOException  $e){echo "not".$e->getMessage();}

?>