<?php

session_start();
if(!$_SESSION['email']){
    header('Location: /AP1/PHP/connexion.php');
}
?>

<!doctype html>
<html>
    <head>
    <title>Acceuil Utilisateur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP1/css/index2.css" media="screen" type="text/css" />
    </head>
<body>
<div>
    <h1>Bienvenue sur votre espace <?php echo $_SESSION['Prenom'] ?> <br> Vous etes : <?php echo $_SESSION['fonction'] ?> </h1>
    <a href="/AP1/PHP/formulaire.php"><button id=bouton1>Créer une nouvelle demande</button></a>
    <a href="/AP1/PHP/Afficher.php"><button id=bouton2>Afficher mes demandes effectuées</button></a>
    <a href="/AP1/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </div>
</body>
</html>