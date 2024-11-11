<?php

    $dsn ="mysql:host=127.0.0.1;dbname=e_commerce;charset=utf8";
$user="root";
$pass = "";

try{
    $cnx=new PDO($dsn,$user,$pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);
}catch(PDOException $error){
    echo"connexion echouer:" .$error->getMessage();
}

// C:\xampp\htdocs\ecommerce\connexion.php

$sql = "SELECT * FROM commander ORDER BY id ASC";
$req = $cnx->prepare($sql);
$req->execute();
$donnees = $req->fetchAll();




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="shortcut icon" href="."> -->
</head>

<body>

    <div class="container-table">
        <table class="styled-table" border="1">
            <thead>
                <th>id</th>
                <th>Nom</th>
                <th>Produit</th>
                <th>Quantite</th>
                <th>Date de livraison</th>
                <th>Télephone</th>
            </thead>
            <tbody>

            <?php foreach ( $donnees as $donnee): ?>
                <tr>
                    <td><?=$donnee['id']?></td>
                    <td><?=$donnee['nom']?></td>
                    <td><?=$donnee['produit']?></td>
                    <td><?=$donnee['quantite']?></td>
                    <td><?=$donnee['date']?></td>
                    <td><?=$donnee['telephone']?></td>
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>