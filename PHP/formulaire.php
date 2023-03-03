<?php
session_start();
if(!$_SESSION['email']){
   header('Location: /AP1/PHP/connexion.php');
}
$bdd = new PDO('mysql:host=localhost;dbname=gestiontravaux;charset=utf8;','root','root');

$selectchamps = $bdd ->prepare ('SELECT * FROM indicepriorité');
$selectchamps->execute();
$champs = $selectchamps->fetchall();

if(isset($_POST['envoi'])){
    print_r($_POST);
$IDusers = ($_POST['IDusers']);
$Objetdemande = ($_POST['objetdemande']);
$detailsdemande = ($_POST['detailsdemande']);
$secteur = ($_POST['secteur']);
$value = ($_POST['intitule']);


print_r("eeee".$value);
 $Insertinput = $bdd->prepare ('INSERT INTO demandeeffectuer (IDusers, objetdemande, detailsdemande, secteur, intitule)
VALUES(?,?,?,?,?)');
$Insertinput->execute(array($IDusers, $Objetdemande, $detailsdemande, $secteur, $value));

header('Location: /AP1/PHP/Afficher.php');
            exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AP1/css/formulaire.css" media="screen" type="text/css" />
    <title>Nouvelle Demande</title>
</head>
<body>
    <form action="/AP1/PHP/formulaire.php" method="post">
    <h1 id=form>Formulaire</h1>

    <h4>Prénom :</h4>
   <input type="text"name="Prenom" value="<?= $_SESSION['Prenom']?>">
   <br>

   <h4>Nom :</h4>
   <input type="text" name="Nom"  value="<?= $_SESSION['Nom']?>">
   <input type="hidden"name="IDusers"  value="<?= $_SESSION['IDusers']?>">
   <br>

   <h4>Objet de votre demande :</h4>
   <input type="text"name="objetdemande"  value="">
   
   <h4>Priorité d'intervention :</h4>

   <select name="intitule">
<option value="faible">faible</option>
<option value="moyen">moyen</option>
<option value="urgent">urgent</option>
</select>

   <br>
   <h4>Details de votre demande</h4>
   <input type="text"name="detailsdemande"  value="">
   <br>
   <h4>Lieu de votre demande</h4>
   <input type="text"name="secteur"  value="">
   <br>
   <input type="submit" name="envoi">
   </form>
</body>
</html>