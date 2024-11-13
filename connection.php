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
    <link rel="stylesheet" href="style.css">
    <title>La Minute de code</title>
</head>
<body>

    <div class="container">
        <h2>Login</h2>
        <h3><?=$erreur?></h3>

        <form action="#" method="post">
            <div class="box email">
                <div class="input-area">
                    <input type="email" id="email" placeholder="E-mail" name="mail">
                    <ion-icon  class="key" name="mail-open-outline"></ion-icon>
                    <ion-icon class="error" name="alert-outline"></ion-icon>
                </div>
                <div class="error-txt">Indiquez une adresse e-mail </div>
                <div class="valid-txt-email">E-mail valide</div>
            </div>
            <div class="box password">
                <div class="input-area">
                    <input type="password" id="password" placeholder="Mot de passe" name="mdp">
                    <ion-icon class="key key-pass" name="eye-off-outline"></ion-icon>
                    <ion-icon class="error" name="alert-outline"></ion-icon>
                </div>
                <div class="error-txt">Indiquez votre mot de passe</div>
                <div class="valid-txt-password">Format valide</div>
                <div class="password-link"><a href="#">Mot de passe oublié ?</a></div>
            </div>
            <input type="submit" name="connecter" value="Se connecter">
            <div class="signup">Pas encore membre ? <a href="articles.php">Créer un compte dès maintenant !</a></div>

        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="app.js"></script>
</body>
</html>