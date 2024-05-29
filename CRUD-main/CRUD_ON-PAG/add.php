<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "all.php";

    if (!empty($_POST["pathimg"])) {
        $pathimg = filter($_POST["pathimg"]);

        if (!empty($_POST["tourName"])) {
            $tourName = filter($_POST["tourName"]);
            $tourPrice = filter($_POST["tourPrice"]);
            $tourDescription = filter($_POST["tourDescription"]);
            try {
                $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $select = $con->prepare("SELECT tour_name, tour_price FROM $tbname WHERE tour_name = :tourName OR tour_price = :tourPrice");
                $select->bindParam(":tourName", $tourName);
                $select->bindParam(":tourPrice", $tourPrice);
                $select->execute();
                $fetch = $select->fetch();

                    $insert = $con->prepare("INSERT INTO $tbname (tour_name, tour_price, tour_description, tour_pathimag) VALUES (:tourName, :tourPrice, :tourDescription, :pathimg)");
                    $insert->bindParam(":tourName", $tourName);
                    $insert->bindParam(":tourPrice", $tourPrice);
                    $insert->bindParam(":tourDescription", $tourDescription);
                    $insert->bindParam(":pathimg", $pathimg);
                    $insert->execute();
                    echo "verified";
               
            } catch (PDOException $e) {
                echo "notverified: " . $e->getMessage();
            }
        } else {
            echo "tourNameempty";
        }
    } else {
        echo "imgempty";
    }
}
?>
