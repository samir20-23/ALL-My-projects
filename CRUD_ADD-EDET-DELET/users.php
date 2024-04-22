<?php
include "all.php";

$con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$select = $con->prepare("SELECT * FROM $tbname");
$select->execute();

$fetch = $select->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="users.css">
</head>

<body>
    
  
    <table>
        
    <tr>
        <th>id</th>
        <th>username</th>
        <th>email</th>
        <th>password</th>
        <th>edit</th>
        <th>delete</th>

    </tr>
    <?php foreach ($fetch as $v) {
    $y1 = $v["id"];
    $y2 = $v["username"];
    $y3 = $v["email"];
    $y4 = $v["password"];
     ?>
    <tr>
        <td id='id'><?php echo  $y1 ?></td>
        <td><input value='<?php echo   $y2  ?>'></td>
        <td><input value='<?php echo   $y3  ?>'></td>
        <td><input value='<?php echo   $y4  ?>'></td>
        <td><a id='edit' name='edit' href='edit.php?id=<?php echo $y1 ?>'>
        <img src="img/edit.png" id="imgedit"></button></a></td>
        <td><a id='delete' name='delete' href='delete.php?id=<?php echo $y1  ?>'>
        <img src="img/delete.png" id="imgdelete"></a></td>
    </tr>
    <?php  } ?>
    
</table>
 <a href="add.html" id="linkadd" ><button id='btnadd'>ADD</button></a>
</body>

</html>