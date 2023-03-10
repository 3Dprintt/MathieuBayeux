
<?php
session_start();
include("connexionDB.php");if(isset($_POST['envoi'])){
    if(!empty($_POST['email']) AND !empty($_POST['Password'])){
        $pseudo = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['Password']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $nom = htmlspecialchars($_POST['Nom']);
        $fonction = htmlspecialchars($_POST['fonction']);

        $insertUser = $bdd->prepare('INSERT INTO users(email, Password, Prenom, Nom, fonction)VALUES(?, ?, ?, ?, ?)');
        $insertUser->execute(array($pseudo, $mdp, $prenom, $nom, $fonction));

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE email = ? AND Password = ?');
        $recupUser->execute(array($pseudo , $mdp));
        if($recupUser->rowCount()  > 0){
            $_SESSION['email'] = $pseudo;
            $_SESSION['Password'] = $mdp;
            $_SESSION['IDusers'] = $recupUser->fetch() ['id'];
            header('Location: /AP1/PHP/connexion.php');
        }

        echo $_SESSION['IDusers'];

    }else{
        echo "Veuillez compléter tous les champs";
    }
}
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Ajouter un utilisateur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/AP1/css/connexion.css" media="screen" type="text/css" />
    </head>
    <body>
        <center>
        <form action="" method="POST"  align="center">
            <h1>Ajout d'utilisateur</h1>
            <br>
            <h4>Nom Utilisateur</h2>
            <input type="text" name="email" autocomplete="0ff">
            <h4>Mot de passe</h2>
            <input type="password" name="Password" autocomplete="Off">
            <br>
            <br>
            <input type="submit" name="envoi">
        </form>
        </center>
    </body>
    </html>
