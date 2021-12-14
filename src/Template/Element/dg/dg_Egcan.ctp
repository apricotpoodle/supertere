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
//$typeDg = 'dg_std_debut';
$typeDg = 'dg_std_debut_checkboxes';

/**
 * Liste des noms de champs et colonne de la datgrid
 */
$arrCol = [
    "ck" => "",
    "INDI_CLE" => "Indice",
    "ENTG_CLE" => "Clef",
    "ENTG_CODINSEE" => "INSEE",
    "TYEG_CODE" => "Type",
    "ENTG_DESI" => "Désignation",
    "ENTG_LIBELLE" => "Libellé",
    "ENTG_TYPO" => "Typo",
    "ENTG_SELECT" => "Sél.",
    "ENTG_TRI" => "Tri",
    "ENTG_GEOCODE" => "GéoCode",
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
    "arrCol" => $arrCol,
    "pageSize" => 1000, //10,12,15,20,25,30,40,50,1000
        ]
;
?>
<?= $this->element($pathDg . "dg", $arrDg); ?>