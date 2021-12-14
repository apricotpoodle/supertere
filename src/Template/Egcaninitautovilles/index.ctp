<?php

/* SELECT AUTO VILLES */
/* @var $this \Cake\View\View */
//$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->extend('../Layout/TwitterBootstrap/g2terelayout');
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
$btns = 'actions_CUD_initautovilleEgCan'; //'actions_CUD_EgCan';
$sb = 'assign_tb_sidebar';
/**
 * Objets easyUI
 */
$dg1TB = '2dg2tb'; //'dgAvecToolBar';
//$dg1TB = 'dgSansToolBar';
$dg = 'dg_' . $this->name;
$dgg = $dg . "Gauche";

//$tb = 'tb_' . $this->name;
//$tb = 'tb_' . 'tour_tyel_tysc';
$tb = 'tb_' . 'yearpicker';
$tbg = 'tbg_' . 'indicle_tyeg_select';
/**
 * Nom d'élément de code
 */
$etb = 'eltToolBar';
$etbg = $etb . 'Gauche';

$edg = 'eltDataGrid';
$edgg = $edg . "Gauche";

/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
$this->append('script', $this->Html->script(['funct_' . $this->name]));
?>
<?= $this->element($pActio . $btns); ?>
<?= $this->element($pActio . $sb); ?>
<?=

$this->element($pDg . $dg1TB,
        [
    $etbg => $pTb . $tbg, $etb => $pTb . $tb,
    $edgg => $pDg . $dgg, $edg => $pDg . $dg,
        ]
)
?>
