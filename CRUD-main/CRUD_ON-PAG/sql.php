
<!--                                                                                 -->

<?php
include "all.php";
try{
    $search="";
if(isset($_POST["search"])){
    $search = $_POST['search'];
}
$con =new PDO("$sql",$user,$pass);
$select = $con->prepare("SELECT * from $tbname  WHERE tour_id LIKE '$search%' OR tour_name LIKE '$search%' OR tour_description LIKE '$search%' ");
$select->execute();

 $fetchAll = $select->fetchAll();

}catch(PDOException $e){
    echo "Error 404";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            flex-direction:column;
            align-items: center;
        }
        tr{
            border: 2px solid black;
        }
        th , td{
            border: 2px solid black;
            text-align: center;
        }
        input{
            text-align: center;
        }
        p{
            color: red;
            text-shadow:  0 0 12px red;
        }
    </style>
</head>
<body>
   
    <form action="" method='POST'>
         <input type="text" name="search" >
         <input type="submit" name="submit" value='serch'>
    </form>
    <table>
        <tr>

            <th>TOUR_ID</th><th id='tourName' >tour_name</th><th id="tourPrice" >tour_Price</th><th id="tourDescription" >tour_description</th><th id="tourPathimag" >tour_pathimg</th><th id="edit" >EDIT</th><th id="delete" >DELETE</th><th id="add"><a href="add.html">ADD</a></th>
        </tr>
        <?php 
            
        
        foreach($fetchAll as $v){
        ?>
     
        <tr>
            <form action="" method="post">
                
            <td><input type="text" name="id" value=" <?php echo $v["tour_id"]; ?>"></td>
            <td><input type="text"  name="tourName" value="<?php echo $v["tour_name"]; ?>"> </td>
            <td><input type="text"  name="tourPrice" value="<?php echo $v["tour_price"]; ?>"> </td>
            <td><input type="text"  name="tourDescription" value=" <?php echo $v["tour_description"]; ?>"></td>
            <td><input type="text"  name="tourPathimag" value=" <?php echo $v["tour_pathimag"]; ?>"></td>
            <td><input type="submit" name="edit" id="editsubmit" value='edit'></td>
            <td><input type="submit" name="delete<?php echo $v["tour_id"]; ?>" id="deletesubmit" value='delete'></td>
            </form>
        </tr>

        <?php 
        
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["tourName"])){
       $tourName =filter($_POST["tourName"]);

         if(!empty($_POST["tourPrice"])){
            $tourPrice =filter($_POST["tourPrice"]);

            if(!empty($_POST["tourDescription"])){
               $tourDescription =filter($_POST["tourDescription"]); 
            if(!empty($_POST["tourPathimag"])){
                $tourPathimag = filter($_POST["tourPathimag"]);
                try{
                    $connect =new PDO("$sql",$user,$pass);
                    $connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            
                    $selected = $connect->prepare("SELECT tour_price FROM $tbname WHERE tour_price='$tourPrice'");
                    $selected->execute();
                    $slt = $selected->fetch();


                        echo "<script>document.getElementById('edit').style.background='green'</script>";
                                /////////////////////////////
                                if(isset($_POST["edit"])){
                                    $id =filter($_POST["id"]);
                                    
                                    echo "<script>document.getElementById('edit').style.background='green'</script>";
                                    $update = $con->prepare("UPDATE $tbname SET tour_name = :tourName, tour_price=:tourPrice, tour_description=:tourDescription tour_pathimag = :tourPathimag WHERE tour_id=:id");
                                    $update->bindParam(":id", $id);
                                    $update->bindParam(":tourName", $tourName);
                                    $update->bindParam(":tourPrice", $tourPrice);
                                    $update->bindParam(":tourDescription", $tourDescription);
                                    $update->bindParam(":tourPathimag", $tourPathimag);
                                    $update->execute();
                                    echo "<script>document.getElementById('edit').style.background='green'</script>";
                                    header("Location: ".$_SERVER['PHP_SELF']);
                                   
                                }else{echo "<script>document.getElementById('edit').style.background='#FF9393'</script> ";}
                                $id = $v["tour_id"];
                                if(isset($_POST["delete$id"])){
                                    
                                    $delete = $con->prepare("DELETE  FROM $tbname WHERE tour_id='$id' ");
                                    $delete->execute();
                                    header("Location:".$_SERVER['PHP_SELF']);
                                
                                
                               /////////////////////////////
                            
                        }else{echo "<script>document.getElementById('delete').style.background='#FF9393'</script> ";}
                    
            
                }catch(Exception $e){echo "<p>*</p>".$e->getMessage();}
            }else{echo "<script>document.getElementById('tourPathimag').style.background='#FF9393'</script> ";}
            }else{echo "<script>document.getElementById('tourDescription').style.background='#FF9393'</script> ";}
         }else{echo "<script>document.getElementById('tourPrice').style.background='#FF9393'</script> ";}
    }else{echo "<script>document.getElementById('tourName').style.background='#FF9393'</script> ";}
   
   
}
}
?>
    </table>
</body>
</html>