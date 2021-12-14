<?php

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
$btns = 'actions_CUD';
$sb = 'assign_tb_sidebar';
/**
 * Objets easyUI
 */
$dg1TB = 'dgAvecToolBar';
$dg = 'dg_' . $this->name;
//$tb = 'tb_' . $this->name;
$tb = 'tb_' . 'vent';
/**
 * Nom d'élément de code
 */
$etb = 'eltToolBar';
$edg = 'eltDataGrid';
/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
$this->append('script', $this->Html->script(['funct_' . $this->name]));
?>
<?= $this->element($pActio . $btns); ?>
<?= $this->element($pActio . $sb); ?>
<?= $this->element($pDg . $dg1TB, [$etb => $pTb . $tb, $edg => $pDg . $dg,]) ?>
