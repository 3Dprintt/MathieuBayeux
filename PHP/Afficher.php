<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestiontravaux;charset=utf8;', 'root', 'root');

session_start();
if (!$_SESSION['email']) {
    header('Location: /AP1/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT u.Nom , u.Prenom , u.fonction , d.objetdemande , d.detailsdemande , d.secteur , d.intitule , d.etat , d.ID , d.technicien , d.IDusers
    FROM users u
    INNER JOIN demandeeffectuer d
    ON u.IDusers = d.IDusers
    WHERE d.IDusers= '.$_SESSION['IDusers']);
    /*INNER JOIN indicepriorité i
    ON u.IDusers = i.intitulé');
    /*INNER JOIN étatdemande
    ON users.IDusers = étatdemande.IDétat'); */
$afficher->execute(array());
$user = $afficher->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Afficher les formulaires</title>
        <link rel="stylesheet" href="/AP1/css/Afficher.css" media="screen" type="text/css" />
        <a href="PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
    <body>
    <h1>Voici vos Formulaires <?= $_SESSION['Prenom'];?></h1>
                <br>
                <br>
                <br>
                                      
        <table border="2" align="center" width="50%">
            <tr>
            <th><B>Prénom</b></th><th>Nom</th><th>Fonction</th><th>objet de votre demande</th><th>details de votre demande</th><th>secteur</th><th>Priorité</th><th>état</th><th>technicien Assigner</th>
            </tr>
                <?php foreach ($user as $cle => $value) { ?>
                <tr>
                <td><?php echo $value['Prenom'];?></td>
                <td><?php echo $value['Nom'];?></td>
                <td><?php echo $value['fonction'];?></td>
                <td><?php echo $value['objetdemande'];?></td>
                <td><?php echo $value['detailsdemande'];?></td>
                <td><?php echo $value['secteur'];?></td>
                <td><?php echo $value['intitule'];?></td>
                <td><?php echo $value['etat'];?></td>
                <td><?php echo $value['technicien'];?></td>
            
                </tr>
                <?php } ?>
        </table>
    </body>
</html>
