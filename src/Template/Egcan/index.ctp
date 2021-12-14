<?php

/* @var $this \Cake\View\View */
//$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->extend('../Layout/TwitterBootstrap/g2terelayout');
$titre = 'Entités Géogr. Candidates';
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
$btns = 'actions_CUD_EgCan';
$sb = 'assign_tb_sidebar';
/**
 * Objets easyUI
 */
$dg1TB = 'dgAvecToolBar';
//$dg1TB = 'dgSansToolBar';
$dg = 'dg_' . $this->name;
//$tb = 'tb_' . $this->name;
//$tb = 'tb_' . 'tour_tyel_tysc';
//$tb = 'tb_' . 'indicle_tyeg';
$tb = 'tb_' . 'indicle_tyeg_select';
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
?>
<?= $this->element($pActio . $btns); ?>
<?= $this->element($pActio . $sb); ?>
<?= $this->element($pDg . $dg1TB, $arrdg1TB) ?>
