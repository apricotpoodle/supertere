<?php
/* @var $this \Cake\View\View */
//$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->extend('../Layout/TwitterBootstrap/g2terelayout');
$titre = "Gestion des scrutins";
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
//$btns = "actions_choix_retour_ScrutModifResultats";
$btns = "actions_choix_retour_ScrutModifCandidatures";
$sb = 'assign_tb_sidebar';
/**
 * Objets easyUI
 */
$dg1TB = 'dgAvecToolBar';
$dg0TB = 'dgSansToolBar';
$dg = 'dg_' . $this->name;
$dgScSelected = 'dgScrutinselected';
$dgEgSelected = 'dgEngeoSelected';
$dgRsScEgSelected = 'dgCand1EnGeo1Scrutin';

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
$this->append('script',
        $this->Html->script(
                ['funct_' . pathinfo(__FILE__)["filename"]]
        )
);
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
$arrdgCan1Eg1Sc = [
//$etb => $pTb . $tbScSelected,
$edg => $pDg . $dgRsScEgSelected,
 $ett => "Candidature Circonscription Courante",
];
?>
<?= $this->element($pActio . $btns); ?>
<?= $this->element($pActio . $sb); ?>
<div class="row">
    <div class="col-sm-6" >
        <?= $this->element($pDg . $dg0TB, $arrdgScSelected); ?>
    </div>
    <div class="col-sm-6" >
        <?= $this->element($pDg . $dg0TB, $arrdgEgSelected); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3" >
        <!--?= $this->element($pDg . $dg0TB, $arrdgCan1Eg1Sc); ?-->
    </div>
    <div class="col-sm-6" >
        <div name="Handsontable" class="pad">
            <div id="hot1"></div>

        </div>
    </div>
    <div class="col-sm-3" >
        <div id = "pbid"></div>
    </div>
</div>
