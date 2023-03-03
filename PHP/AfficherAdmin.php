<?php
$bdd = new PDO('mysql:host=localhost;dbname=gestiontravaux;charset=utf8;', 'root', 'root');

session_start();
if (!$_SESSION['email']) {
    header('Location: /AP1/PHP/connexion.php');
}

$afficher = $bdd ->prepare('SELECT u.Nom , u.Prenom , u.fonction , d.objetdemande , d.detailsdemande , d.secteur , d.intitule , d.etat , d.ID , d.technicien , d.IDusers , d.RaisonMEA
    FROM users u
    INNER JOIN demandeeffectuer d
    ON u.IDusers = d.IDusers');
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
        <link rel="stylesheet" href="/AP1/CSS/Afficher.css" media="screen" type="text/css" />
        <a href="/AP1/PHP/genpdf.php"><button id="bouton3">télécharger les demandes en cours?</button></a>
        <a href="/AP1/PHP/Deconnexion.php"><button id=boutondeco>Se <br> Deconnecter</button></a>
    </head>
    <body>
        
        <div>
        <table border="2" align="center" width="50%" class="tableau" id="tableau">
        <h1>Voici tout les formulaires <?= $_SESSION['Prenom'];?> :</h1>
            <tr>
            <th><B>Prénom</b></th><th>Nom</th><th>Fonction</th><th>objet de votre demande</th><th>details de votre demande</th><th>secteur</th><th>Priorité</th><th>état</th><th>technicien Assigner</th><th>Raison Mise en Attente</th><th>modification</th>
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
                <td><?php echo $value['RaisonMEA'];?></td>
                <td><a href="/AP1/PHP/modifie.php?ID=<?php echo $value['ID']; ?>"><button id="bouton3" align="center">Modifier la demande/Assigner un technicien</button></a></td>
            
                </tr>
                <?php } ?>
        </table>
        </div>
<input class="zoneSaisie" type="search" placeholder="Recherche par état d'avancement" id="maRecherche" onkeyup="filtrer()">

        <script>
        function filtrer()
        {
            var filtre, tableau, ligne, cellule, i, texte // déclare les variables utilisées

            filtre = document.getElementById("maRecherche").value.toUpperCase(); // on dit a quoi sa correspond
            tableau = document.getElementById("tableau");
            ligne = tableau.getElementsByTagName("tr");
            
            for(i=0; i<ligne.length; i++)
            {
                cellule = ligne[i].getElementsByTagName("td") [7];
                if(cellule)
                {
                    texte = cellule.innerText;
                    if(texte.toUpperCase().indexOf(filtre) > -1)
                    {
                        ligne[i].style.display = "";
                    }
                    else
                    {
                        ligne[i].style.display = "none";
                    }
                }
            }
        }
                    
        </script>
        
        
    </body>
</html>
