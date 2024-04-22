<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "all.php";

    if(!empty($_POST["username"])){
        // if(strlen($_POST["username"])>=3){
            $username= filter($_POST["username"]);
            if(!empty($_POST["email"])){
                if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) && strlen($_POST["email"]) >= 13){
                    $email = filter($_POST["email"]);
                    if(!empty($_POST["password"])){
                    if (strlen($_POST['password']) >= 5) {
                          $password =filter($_POST["password"]);
                          try{
                            $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
                            $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                            $slect = $con->query("SELECT username ,email FROM $tbname WHERE username='$username' OR email='$email' ");
                            $fetch = $slect->fetch();
                           
                             if($fetch && $fetch["email"]== $email){
                                echo "emaildb";
                            }else{
                                //Cpassword
                                if($_POST["cpassword"] == $password){
                                    $cpassword =filter($_POST["cpassword"]);

                                    $insert = $con->prepare("INSERT INTO $tbname(username,email,password) VALUES(:username,:email, :password)");
                                    $insert->bindParam(":username",$username);
                                    $insert->bindParam(":email",$email);
                                    $insert->bindParam(":password",$password);
                                    $insert->execute();
                                    echo "verified";

                                }else{
                                    echo "notmatch";
                                }
                            }
                           


                          }catch(PDOException $e ){echo "notverified".$e->getMessage();}
                        }else{echo "paasswordlenght";}
                    }else{echo "passwordempty";}

                }else{echo "emailbad";}
            }else{echo "emailempty";}

        // }else{echo "lenghtusername";}

    }else{echo "userempty";}
}
?>
