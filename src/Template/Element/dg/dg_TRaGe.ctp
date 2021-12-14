<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathDg = 'dg' . DS;
/**
 * Choix d'une datagrid avc ou sans toolbar
 */
//$typeDg = 'dg_std_debut_sans_toolbar';
$typeDg = 'dg_std_debut';

/**
 * Liste des noms de champs et colonne de la datgrid
 */
$arrCol = [
    "INDI_CLE" => "Type C.E. de",
    "ENTG_CLE" => "Désignation de",
    "EG__INDI_CLE" => "Type C.E. vers",
    "EG__ENTG_CLE" => "Désignation vers",
];
/**
 * Nom du modèle de colonne
 */
$dgCol = 'dgColonne'; // sortable

/**
 * Tableau des variables à fournir à l'élément dg.ctp
 */
$arrDg = [
    "dgCol" => $dgCol,
    "pathDg" => $pathDg,
    "typeDg" => $typeDg,
    "arrCol" => $arrCol
        ]
;
?>
<?= $this->element($pathDg . "dg", $arrDg); ?>