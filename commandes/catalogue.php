<?php

require_once"../connexion.php";

$message="";

if(isset($_POST["Envoyer"])){

  $nom=htmlspecialchars($_POST['nom']);
  $pays=htmlspecialchars($_POST['pays']);
  $ville =htmlspecialchars($_POST['ville']);
  $qaurtier =htmlspecialchars($_POST['quartier']);
  $phone =intval($_POST['phone']);

  if(!empty($_POST['nom']) || !empty($_POST['pays'])|| !empty($_POST['ville']) || !empty($_POST['quartier'] )
  ||!empty($_POST['phone'])){
     
     
     $sql ="INSERT INTO commander(nom,pays,ville,quartier,telephone) VALUES(?,?,?,?,?)";
     $req = $cnx->prepare($sql);
     $req->execute([$nom,$pays,$ville,$qaurtier,$phone]);

     $message="requet en cours de traitement";

   
}else{
  $message="veuilez remplir tout les gens";
}

}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Commande</title>
</head>
<body>
  <div class="catalogue">
    <div class="form-catalogue">
      <form action="" method="post">
        <div class="name">
          <label for="Nom">Nom</label>
          <input type="text" id="name" name="nom">
        </div>
        <div class="country">
          <label for="pays">Pays</label>
          <input type="text" id="country" name="pays">
        </div>
        <div class="city">
          <label for="name">Ville:</label>
          <input type="text" id="city" name="ville">
        </div>
        <div class="quartier">
          <label for="name">Quartier:</label>
          <input type="text" id="quartier" name="quartier">
        </div>
        <div class="phone">
          <label for="phone">Tel:</label>
          <input type="text" id="phone" name="phone">
        </div>

        <input type="submit" name="Envoyer">

        <?=$message?>
        
      </form>
    </div>
  </div>
</body>
</html>