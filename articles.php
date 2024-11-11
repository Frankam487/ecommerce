<?php

require_once"connexion.php";

$message="";

if(isset($_POST["create"])){

  $nom=htmlspecialchars($_POST['nom']);
  $mail=htmlspecialchars($_POST['mail']);
  $mailconfirm=htmlspecialchars($_POST['mailconfirm']);
  $mdp =$_POST['mdp'];
  $mdpconfirm =$_POST['mdpconfirm'];

  function Inscription($nom,$mail,$mailconfirm,$mdp,$mdpconfirm){
    global $cnx;
    
    $requet=$cnx->prepare("SELECT * FROM connecte where email=?");
    $requet->execute([$mail]);
    $donnees=$requet->fetch();

    if(empty($nom)||empty($mail)||empty($mailconfirm)||empty($mdp)||empty($mdpconfirm)){
      return "les mots de passes ne correspondent pas";
    }
    if($mdp!=$mdpconfirm){
      return "les mots de passes ne correspondent pas";

    }
    if($mail!=$mailconfirm){
      return "l'email ne correspond pas";
    }
    if(!empty($donnees['email'])){
      return "l'adresse email est deja utilisee";

    }
    $mdphash=password_hash($mdp,PASSWORD_DEFAULT);
    $req=$cnx->prepare("INSERT INTO connecte(nom,email,pass) value(?,?,?)");
    $req->execute([$nom,$mail,$mdphash]);
    header("location:connection.php");


  }
  $message=Inscription($nom,$mail,$mailconfirm,$mdp,$mdpconfirm);
}


//   if(!empty($_POST['nom'])|| !empty($_POST['mail'])|| !empty($_POST['mail2'])|| !empty($_POST['mdp']) || !empty($_POST['$mdp2'])){

//              if($mail==$mail2){

//              if($mdp==$mdp2){

//               if(empty($donnees['email'])){
            
//               $mdphash=password_hash($mdp,PASSWORD_DEFAULT);
//              $sql= "INSERT INTO connecte(nom,email,pass) VALUES(?,?,?)";
//              $req=$cnx->prepare($sql);
//              $req->execute([$nom,$mail,$mdphash]);
//               $message = " inscription reussi!";
//               header("location:connection.php");
//               }else{
//                 $message="adresse deja utilise";
//               }
//              }else{
//               $message="mot de passe non identique";
//              }

//              }else{
//               $message="vos addresse ne corresponde par";
//              }
//   }
//   else{
//     $message="Veuillez remplir tout les champs";
//   }

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>
<body>
  <div class="articles">

    <div class="container-form">
      <form action="" method="post">
        <div class="name">
          <label for="Nom">Nom:</label>
          <input type="text" name="nom" placeholder="entrer votre nom">
    </div>
    <div class="email">
      <label for="email">Email*</label>
      <input type="text" id="email" name="mail" placeholder="entrer votre nom">
    </div>
    <div class="mail-confirm">
      <label for="mail-confirm">confirmation du mail</label>
      <input type="email" placeholder="confirmation du mail" name="mailconfirm" id="mail-confirm">
    </div>
    <div class="mdp">
      <label for="password">Mot de passe:</label>
      <input type="password" placeholder="entrer votre nom" name="mdp">
    </div>
    <div class="confirm">
      <label for="confirm">Confirmer mot de passe:</label>
      <input type="password" placeholder="confirmer le mot de passe"name="mdpconfirm">
    </div>
    
    <div class="btnValided">
       <input type="submit" name="create"> 
       <h3><?=$message?></h3>
      <a href="./index.php">Annuler</a>
    </div>
  </form>
</div>
 </div>
</body>
</html>