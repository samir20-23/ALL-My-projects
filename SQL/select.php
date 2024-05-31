
<?php
class Database{
private $host="localhost";
private $user = "SAMIR";
private $pass = "samir123";
private $dbname="test";
private $tbname1="data6";
private $tbname2="testtb";
private $con;
private $select;
private $fetch;
public function connect(){
    try{
        $this->con=new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       $backupFile = 'backup.sql';
            $command = "mysqldump -u {$this->user} -p{$this->pass} {$this->dbname} > $backupFile"; 
exec($command);
        

    }catch(PDOException $e){ echo "notconect".$e->getMessage();}
}
public function select(){
    try{
        $this->select =$this->con->prepare("SELECT * FROM $this->tbname1  RIGHT JOIN $this->tbname2 ON  $this->tbname1.username=$this->tbname2.username ");
        $this->select->execute();
        $this->fetch =$this->select->fetchAll();
    }catch(PDOException $e){ echo "notconect".$e->getMessage();}
}
public function getfetch(){
    return $this->fetch;
}
}

$server = new Database;
$server->connect();
$server->select();
$fetch =$server->getfetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,th,tr,table{border: 2px solid black;}
    </style>
</head>
<body>
    <table>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>email</th>
            <th>password</th>
        </tr>
        <?php 
        foreach($fetch as $v){?>
        <tr>
            <td><?php echo $v["id"] ?></td>
            <td><?php echo $v["username"] ?></td>
            <td><?php echo $v["email"] ?></td>
            <td><?php echo $v["password"] ?></td>
        </tr>
            <?php } ?>
    </table>
</body>
</html>