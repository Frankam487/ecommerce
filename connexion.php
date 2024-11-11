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
   
