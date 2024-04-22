
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style> 
        body{
            display: flex;
            justify-content: center;
        }
        table{
            border: 2px solid black;
            box-shadow: 0 0 12px black;
            border: 3px solid #6E6E6E;
        }z
        tr{
        box-shadow: 0 0 10px black;
        }
        th{
            border: 2px solid red;
        }
        input{
            border: 2px solid black;
            text-align: center;
            color: black;
            text-shadow: 0 0 0.2px blue;
            font-size: 19px;
        }
        #id{
            border: 2px solid black;
        }
       
    </style>
    
    <body>
    <?php


    try{
        include "all.php";
        $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
        $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
      
        $select =$con->prepare("SELECT * FROM $tbname");
        $select->execute();
        $fetch = $select->fetchAll();
    echo "<table>
        <tr>
          <th>ID</th>
          <th>username</th>
          <th>email</th>
          <th>password</th>
          <th>UPDATE</th>
        </tr>";
        foreach ($fetch as $row) {
            $x1= $row['id'];
            $x2= $row['username'];
            $x3= $row['email'];
            $x4= $row['password'];
            echo "<tr>
        <td id='id' name='$x1' >$x1</td>
            <td><input value='$x2' name='$x2' ></td>
            <td><input value='$x3' name='$x3' ></td>
            <td><input value='$x4' name='$x4' ></td>
            <td>
             <input type='button' value='edit' name='edit' >
             <input type='button' value='delete' name='delete' >
            </td>
            </tr>";
        }
        echo "</table>";
        echo $x1;
        
    }
    catch(PDOException $e){
        echo "connect".$e->getMessage();
    }
    ?>
    </body>
    </html>