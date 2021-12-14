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
$typeDg = 'dg_std_debut_sans_toolbar';
//$typeDg = 'dg_std_debut';

/**
 * Liste des noms de champs et colonne de la datgrid
 */
$arrCol = [
    "TYSC_CODE" => "Scrutin",
    "TYEN_CODE" => "Entité",
    "TYEG_CODE" => "Circ. Él.",
    "TYEL_CODE" => "Élection",
    "TYFO_CODE" => "Fonction",
    "TYCO_CODE" => "Circ. Conseil",
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