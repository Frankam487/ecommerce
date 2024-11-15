<?php

require_once "connexion.php";

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
    header("Location:connection.php");
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

<?php

require_once"connexion.php";

$erreur="";

if(isset($_POST["connecter"])){

    $mail= htmlspecialchars($_POST["mail"]);
    $mdp= $_POST["mdp"];


    function Connexion($mail,$mdp){
        global $cnx;

        $req=$cnx->prepare("SELECT * FROM connecte where email=?");
        $req->execute([$mail]);
        $donnees=$req->fetch();
        if(empty($_POST["mail"]) || empty($_POST["mdp"])){
            return "veuillez remplir tous les champs";
        }
        if(empty($donnees['email'])){
            return "Email invalide";
        }
        if(!password_verify($mdp,$donnees['pass'])){
            return "le mot de passe est incorrect";
        }
        header("location:listArticles.php?id=".$donnees['id']);

    }
    $erreur=Connexion($mail,$mdp);
  
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="articles.css">
  <title>Inscriptions</title>
</head>
<body>


  <div class="wrap">
    <div class="titres">
      <div class="titreCo" type="button"><p>Connexion</p></div>
      <div class="titreSi" type="button">
        <p>Inscription</p>
        <h3><?=$erreur?></h3>
      </div>
      </div>
      <div class="form-contenu">
        <div class="slide-controls">
          <input type="radio" name="slider" id="login" checked>
          <input type="radio" name="slider" id="signup">
          <label for="login" class="slide login">Connexion</label>
          <label for="signup" class="slide signup">Inscription</label>
          <div class="slide-tab"></div>
        </div>
        <div class="form-card">
          <form class="Fconnexion" method="post">
            <div class="form-div">
              <input type="text" placeholder="E-mail" name="mail" requiried>
              <input type="password" placeholder="Mot de passe" name="pwd" required>
            </div>
            <a class="mdp" href="#">Mot de passe oublié ?</a>
            <input type="submit" id="connexion" class="connecter" value="Connexion"></input>
            <div class="compte">Vous êtez pas membre ? <a class="create" href="#connexion">Créer un compte</a></div>
          </form>


          <form  method="post">
            <div class="form-div">
              <input type="text" placeholder="Nom" class="nom">
              <input type="email" class="mail" placeholder="E-mail">
              <input type="email" placeholder="E-mail_confirm" class="mailconfirm">
              <input type="password" placeholder="Mot de passe" class="mdp" required>
              <input type="password" placeholder="Confirmer le mot de passe" required class="mdpconfirm">
            </div>
            <input type="submit" class="create" value="Créer un compte"></input>  
          </form>


        </div>
      </div>
    </div>





  <script src="app.js"></script>
</body>
</html>