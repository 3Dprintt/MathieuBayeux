<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestiontravaux;', 'root', 'root');
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
    $getid = $_GET['ID'];

    $recupdonnées = $bdd->prepare('SELECT * FROM demandeeffectuer WHERE id = ? ');
    $recupdonnées->execute(array($getid));
    if ($recupdonnées->rowCount()>0) {
        $recupinfos = $recupdonnées->fetch();
        $MEA = $recupinfos['RaisonMEA'];
        
        if (isset($_POST['valider'])) {
            $MEA = htmlspecialchars($_POST['RaisonMEA']);
    
            $updatefichier = $bdd->prepare('UPDATE demandeeffectuer SET RaisonMEA = ? WHERE id = ?');
            $updatefichier->execute(array($MEA,$getid));
    
            header('Location: AfficherTechnicien.php');
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
   <input type="text" name="RaisonMEA" value="<?= $MEA ?>">Raison de la mise en attente ?
   <br>
   <input type="submit" name="valider">
</form>
</body>

</html>