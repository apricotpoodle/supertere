<?php

/* @var $this \Cake\View\View */
//$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->extend('../Layout/TwitterBootstrap/g2terelayout');
$titre = "Gestion des Résultats Scrutins à LISTE";
/**
 *  Chemins
 */
$pDg = 'dg' . DS;
$pTb = 'tb' . DS;
$pActio = 'Actions' . DS;
/**
 * boutons et sidebar
 */
//$btns = 'actions_CUD';
//$btns = 'actions_CUD_AddRound';
//$btns = "actions_CUD_ScrutController";
$btns = "actions_choix_retour_ScrutModifResultatsLst";
$sb = 'assign_tb_sidebar';
/**
 * Objets easyUI
 */
$dg1TB = 'dgAvecToolBar';
$dg0TB = 'dgSansToolBar';
$dg = 'dg_' . $this->name;
$dgScSelected = 'dgScrutinselected';
$dgEgSelected = 'dgEngeoSelected';
$dgRsScEgSelected = 'dgResultatScrutinEnGeoSelected';
$dgCanScEgSelected = 'dgCandidatScrutinEnGeoSelected';

$tb = 'tb_' . $this->name;
/**
 * Nom d'élément de code
 */
$etb = 'eltToolBar';
$edg = 'eltDataGrid';
$ett = 'titre';
/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
$this->append('script', $this->Html->script(['funct_' . $this->name]));
/**
 * Tableau des variables à fournir à l'élément dg1TB
 */
$arrdg1TB = [
$etb => $pTb . $tb,
 $edg => $pDg . $dg,
 $ett => $titre,
];
$arrdgScSelected = [
//$etb => $pTb . $tbScSelected,
$edg => $pDg . $dgScSelected,
 $ett => "Scrutin Courant",
];
$arrdgEgSelected = [
//$etb => $pTb . $tbScSelected,
$edg => $pDg . $dgEgSelected,
 $ett => "Circonscription Courante",
];
$arrdgResScEgSelected = [
//$etb => $pTb . $tbScSelected,
$edg => $pDg . $dgRsScEgSelected,
 $ett => "Résultats Circonscription Courante",
];
$arrdgCanScEgSelected = [
//$etb => $pTb . $tbScSelected,
$edg => $pDg . $dgCanScEgSelected,
 $ett => "Candidats Circonscription Courante",
];
?>
<?php

/** Affichage des éléments préconstruits
 *
 */
echo $this->element($pActio . $btns); // Boutons d'action dans la section ouest
echo $this->element($pActio . $sb); // Side bar
/** Affichage des éléments de datagrid
 *
 */
/** Affichage d'éléments de datagrid 0
 *
 */
echo $this->element($pDg . $dg0TB, $arrdgScSelected);
echo $this->element($pDg . $dg0TB, $arrdgEgSelected);
echo $this->element($pDg . $dg0TB, $arrdgResScEgSelected);
echo $this->element($pDg . $dg0TB, $arrdgCanScEgSelected);
/** Affichage d'éléments de datagrid 1
 *
 */
// echo $this->element($pDg . $dg1TB, $arrdg1TB)
?>
