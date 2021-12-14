<?php
/** Titre de la zone Centrale définie dans g2terelayout
 * /!\ Pas de Quote simple dans le texte de $centerTitle
 */
$centerTitle = "Ajout d’un deuxième tour";
$this->set("centerTitle", $centerTitle);


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
$btns = "actions_choix_retour_ScrutAddTour2";
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
    $ett => "Résultat Circonscription Courante",
];
$arrdgCanScEgSelected = [
    //$etb => $pTb . $tbScSelected,
    $edg => $pDg . $dgCanScEgSelected,
    $ett => "Résultat Circonscription Courante",
];
?>
<input id="csrf" name = "csrf"  value="<?= $this->getRequest()->getParam('_csrfToken') ?>" hidden>
<div title="saisie de la date du second tour" style="width:75%">
    <?=
    $this->Form->control("SCRU_DATE",
            [
        // dev'u uz'i cakephp fleks'o "scru-date"
        // 'id' => "SCRU_DATE", utilisons l'inflexion par défaut scrut-date.
        'class' => 'datepicker',
        "style" => "width:75%;margin:10%",
        "placeHolder" => "Date du second tour",
        'type' => "text",
        'label' => "Date Scrutin : ",
        'value' => $this->request->getData("SCRU_DATE"),
            ]
    );
    ?>
</div>
<?= $this->element($pActio . $btns); ?>
<?= $this->element($pActio . $sb); ?>
<!-- ?= $this->element($pDg . $dg0TB, $arrdgScSelected); ?-->
<!-- ?= $this->element($pDg . $dg0TB, $arrdgEgSelected); ?-->
<!-- ?= $this->element($pDg . $dg0TB, $arrdgResScEgSelected); ?-->
<!-- ?= $this->element($pDg . $dg0TB, $arrdgCanScEgSelected); ?-->
<!--


< ?= $this->element($pDg . $dg1TB, $arrdg1TB) ?>
-->