<?php
include("connexionDB.php");
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $getid = $_GET['ID'];

    $recupdonnées = $bdd->prepare('SELECT * FROM demandeeffectuer WHERE id = ? ');
    $recupdonnées->execute(array($getid));
    if ($recupdonnées->rowCount()>0) {
        $recupinfos = $recupdonnées->fetch();
        $etat = $recupinfos['etat'];
        
        if (isset($_POST['valider'])) {
            $etat = htmlspecialchars($_POST['etat']);
    
            $updatefichier = $bdd->prepare('UPDATE demandeeffectuer SET etat = ? WHERE id = ?');
            $updatefichier->execute(array($etat,$getid));
    
            header('Location: /AP1/PHP/AfficherTechnicien.php');
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
 </head>

<body>
   <form  method="POST" action="">
   <input type="text" name="etat" value="<?= $etat ?>">modifier l'etat de la demande
   <br>
   <input type="submit" name="valider">
</form>
</body>

</html>