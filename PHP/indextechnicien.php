<?php
session_start();
if(!$_SESSION['email']){
   header('Location: /AP1/PHP/connexion.php');
}
?>


<!doctype html>
<html>
    <head>
    <title>Acceuil Technicien</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP1/css/index2.css" media="screen" type="text/css" />
    </head>
<body>
<div>
    <h1>Bienvenue sur votre espace <?php echo $_SESSION['Prenom'] ?> Vous etes : <?php echo $_SESSION['fonction'] ?> </h1>
    <a href="/AP1/PHP/AfficherTechnicien.php"><button id=bouton1>Afficher mes missions</button></a>
    </div>
</body>
</html>