<?php

use Dompdf\Dompdf;

include("connexionDB.php");
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

ob_start();
require_once 'test.php';
$html= ob_get_contents();
ob_end_clean();

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->loadhtml($html);
$dompdf->setPaper('A4' , 'landscape');

$dompdf->render();

$dompdf->stream();



?>
