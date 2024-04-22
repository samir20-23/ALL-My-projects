<?php 
if($_SERVER["REQUEST_METHOD"]=="GET"){

    include "all.php";

    $id =  $_GET['id'];

 $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
        $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $select = $con->prepare("SELECT * FROM $tbname WHERE id='$id'");
        $select->execute();
         $fetch = $select->fetch();
   }
   $id =  $_GET['id'];
   

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            include "all.php";

            try{
            $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
            $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);   
            //select 
            $select = $con->prepare("SELECT * FROM $tbname WHERE id='$id'");
            $select->execute();
             $fetch = $select->fetch();

            if(!empty($_POST["username"])){
                if( strlen($_POST["username"])>=5){
                $username = filter($_POST["username"]);
                if(!empty($_POST["email"])){
                    $email = filter($_POST["email"]);
                    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                        $password = filter($_POST["password"]);

          $update = $con->prepare("UPDATE $tbname SET username=:username ,email=:email, password=:password WHERE id='$id' ");
          $update->bindParam(":username",$username);
          $update->bindParam(":email",$email);
          $update->bindParam(":password",$password);
          $update->execute();
          header("location:users.php");
        }else{
    echo "bademail";
 }
}else{
    echo "emptyemail";
 }
}else{
   echo "lenghtusername";
}
}else{
    echo "emptyusername";
 }
}catch(PDOException $e){echo "note conecct".$e->getMessage();}

        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="croad.css">
</head>
<body>
    <form action="" method="POST">
    <pre>
    <input type="text" name="username" id="usernameedit"  value="<?php echo $fetch['username']?>" >
    <input type="text" name="email" id="emailedit" value="<?php echo $fetch['email'] ?>"  >
    <input type="text" name="password" id="passwordedit" value="  <?php echo $fetch['password'] ?>"  >
    <a href="users.php" id="linkup"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>UP</a>
    <input type="submit"  name="submit" id="submitedit" value="EDITE" >
     </pre>
    </form>

</body>
</html>