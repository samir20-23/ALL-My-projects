<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "all.php";

    if (!empty($_POST['username'])) {
        $username = filter($_POST['username']);

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = filter($_POST['email']);

            if (!empty($_POST['password'])) {
                $password = filter($_POST['password']);

                if ($_POST['password'] === $_POST['cpassword']) {

                    try {
                        $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
                        

                        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $insert = $connect->prepare("INSERT INTO $tbname(username,email,password) VALUE(:username, :email,:password)");
                        
                        $insert->bindParam(":username",$username);
                        $insert->bindParam(":email",$email);
                        $insert->bindParam(":password",$password);

                        $insert->execute();
                        
                        $select = $connect->query("SELECT username , email FROM $tbname WHERE email='$email'");
                        $slt = $select->fetch();
                        if ($slt && $select == $slt['username']) {
                            echo "hello";
                        }


                    } catch (PDOException $e) {
                        echo "note connect" . $e->getMessage();
                    }
                } else {
                    echo "notmatch";
                }
            } else {
                echo "passwordempty";
            }
        } else {
            echo "emailempty";
        }
    } else {
        echo "userempty";
    }
}
