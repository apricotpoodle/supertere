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
    "TYCL_CODE" => "Clef",
    "TYCL_LIBE" => "Libellé",
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