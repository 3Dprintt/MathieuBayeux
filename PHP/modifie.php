<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestiontravaux;', 'root', 'root');
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $getid = $_GET['ID'];

    $recupdonnées = $bdd->prepare('SELECT * FROM demandeeffectuer WHERE id = ? ');
    $recupdonnées->execute(array($getid));
    if ($recupdonnées->rowCount()>0) {
        $recupinfos = $recupdonnées->fetch();
        $etat = $recupinfos['etat'];
        $priorite = $recupinfos['intitule'];
        $technicien = $recupinfos['technicien'];
        //echo $priorite;
        
        if (isset($_POST['valider'])) {
            $etat = htmlspecialchars($_POST['etat']);
            $priorite = htmlspecialchars($_POST['intitule']);
            $technicien = htmlspecialchars($_POST['technicien']);
    
            $updatefichier = $bdd->prepare('UPDATE demandeeffectuer SET etat = ?, intitule = ?, technicien= ? WHERE id = ?');
            $updatefichier->execute(array($etat,$priorite,$technicien,$getid));

            header('Location: /AP1/PHP/AfficherAdmin.php');
            exit();
        }
        
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Modifier mes données</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/AP1/css/formulaire.css" media="screen" type="text/css" />
    <h1>Modifier vos données</h1>
    <a href="/AP1/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
 </head>

<body>
   <form  method="POST" action="">
   <br><br>
   <label for="etats">Modifié l'etat de la demande : </label>
   <select name="etat" id="etats">
<option value="<?=$etat ?>"><?=$etat ?></option>
<option value="Demande complété">Demande complété</option>
<option value="En cours de traitement">En cours de traitement</option>
<option value="Non-ouverte">Non-ouverte</option>
</select>
<br>
<label for="Intitulé">Modifié la priorité de la demande : </label>
<select name="intitule" id="Intitulé">
<option value="<?=$priorite ?>"><?=$priorite ?></option>
<option value="faible">faible</option>
<option value="moyen">moyen</option>
<option value="urgent">urgent</option>
</select>
<br>
<label for="Intitulé">Modifié le technicien assigner assigner : </label>
<select name="technicien">
<option value="<?=$technicien ?>"><?=$technicien ?></option>
<option value="Pascaline">Pascaline</option>
<option value="Henru">Henru</option>
<option value="Samuel">Samuel</option>
</select>
<br>
   <input type="submit" name="valider">
</form>
</body>

</html>