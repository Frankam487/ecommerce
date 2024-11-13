<?php
// require_once "connection.php";
    $dsn ="mysql:host=127.0.0.1;dbname=e_commerce;charset=utf8";
$user="root";
$pass = "";

try{
    $cnx=new PDO($dsn,$user,$pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);
}catch(PDOException $error){
    echo"connexion echouer:" .$error->getMessage();
}

$message = "";

if(isset($_POST['create'])){


    $nom = htmlspecialchars($_POST['nom']);
    $produit = htmlspecialchars($_POST['produit']);
    $quantite = htmlspecialchars($_POST['quantite']);
    $p = htmlspecialchars($_POST['date']);
    $telephone= htmlspecialchars($_POST['telephone']);

    

if( !empty($nom) || !empty($produit) ||!empty($quantite)|| !empty($p) || !empty($telephone)  ){

    $sq = "INSERT INTO commander(nom,produit,quantite,date,telephone) VALUES (?,?,?,?,?)";
    $req = $cnx->prepare($sq);
    $req->execute([$nom,$produit,$quantite,$p, $telephone]);

    $message = "vous serrez conctaté ultérieurement.....";
   header("location:listArticles.php?id=".$donnees['id']);

}else{
    $message = "Veuillez remplir tous les champs";
}
  




}







?>




<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Commande</title>
  <link rel="stylesheet" href="./formCommande.css">
</head>
<body>

  <div class="form-container">
    <h1>Enregistrer une Commande</h1>
    <form action="" method="POST">
        <?=$message?>
      <label for="nom">Nom du Client :</label>
      <input type="text" id="nom" name="nom" placeholder="Entrez votre nom">

      <!-- <label for="email">Email :</label>
      <input type="email" id="email" name="email" placeholder="Entrez votre email" required> -->

      <label for="produit">Produit (s) :</label>
      <input type="text" id="produit" name="produit" placeholder="Nom du produit">

      <label for="quantite">Quantité :</label>
      <input type="number" id="quantite" name="quantite" placeholder="Quantité" min="1">

      <label for="date-livraison">Date de Livraison :</label>
      <input type="date" id="date-livraison" name="date">
      <label for="telephone">telephone :</label>
      <input type="text" id="telephone" name="telephone">
      <button type="submit" name="create">Passer la Commande</button>
    </form>
  </div>

</body>
</html>
