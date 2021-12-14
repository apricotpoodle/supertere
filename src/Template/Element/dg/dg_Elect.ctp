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
    "ELEC_CLE" => "Clef",
    "INDI_CLE" => "Indice",
    "TYSC_CODE" => "Type Scr.",
    "TYEN_CODE" => "Entité",
    "TYEG_CODE" => "Ent. Géogr.",
    "TYEL_CODE" => "Type Élect.",
    "TYRT_CODE" => "Type RT.",
    "ELEC_LIB" => "Libellé",
    "REGL_CODE" => "REGL_CODE",
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