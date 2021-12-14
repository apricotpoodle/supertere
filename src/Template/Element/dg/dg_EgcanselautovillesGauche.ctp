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
$typeDg .= '_gauche'; // c'est un type gauche /!\
/**
 * Liste des noms de champs et colonne de la datagrid
 */
$arrCol = [
    //"TYCL_CODE" => "Classé par",
    "ck" => "",
    "VACL_VALE" => "Clef",
    "VACL_LIBE" => "Désignation",
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
    "pageSize" => 30, //10,12,15,20,25,30,40,50,
        ]
;
?>
<?= $this->element($pathDg . "dg", $arrDg); ?>