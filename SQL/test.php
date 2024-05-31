<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    class Database {
        private $host = "localhost";
        private $user = "SAMIR";
        private $pass ="samir123";
        private $dbname = "login";
        private $tbname ="myadmin";
        private $con;
        
        public function filter($data){
            $data= trim($data);
            $data= stripslashes($data);
            $data= htmlspecialchars($data);
            return $data;
        }
       

      
        public function __construct(){
             
             try{
                $this->con=new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);

                $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                 
             }catch(PDOException $e){echo "not cennect".$e->getMessage();}
        
      }
      public function select(){
        try {
            $select = $this->con->prepare("SELECT * FROM {$this->tbname}");
            $select->execute();
         
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
      }

    }
     
$server =new Database;
$server->select();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
#log{
    width:100%;
    height: 80vh;
   display: flex;
   justify-content: center;
   align-items: center;
}
form{
    border: 1px solid black;
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 40px;
    gap: 20px;

}
input{
    width: 300px;
    height: 30px;
}
    </style>
</head>
<body>
    <div id="log">
    <form action="" method="post">
       
            <input type="text" id="username" name="username" placeholder="username">
            <input type="text" id="email" name="email" placeholder="email">
            <input type="text" id="password" name="password" placeholder="password">
            <input type="submit" id="submit" name="submit">

       
    </form></div>
</body>
</html>