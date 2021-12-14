<?php

use App\View\AppView;
use Cake\I18n\Date;

/**
 * @var AppView $this
 * @var \App\Model\Entity\IndiceCandidature $indiceCandidature
 */
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('List Indice Candidature'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Html->link(__('List Indice Candidature'), ['action' => 'index'])
        ?></li>
</ul>
<?php
$this->end();
$date_ouv = 'INDI_DATE_OUV';
$date_fer = 'INDI_DATE_FER';
$ind_cle = 'INDI_CLE';
$ind_lib = 'INDI_LIBELLE';
$msgTitre = __('Add {0}', ['Indice Candidature']);
/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
/*
 *  si pas extend de g2terelayout
 */
$this->prepend('script', $this->Html->script(['funct_' . 'gene']));
/*
 * tjs nécessaire 'funct_' . $this->name
 */
$this->prepend('script', $this->Html->script(['funct_' . $this->name]));
?>
<?= $this->Form->create($entity); ?>
<fieldset>
    <legend><?= $msgTitre ?></legend>
    <?=
    $this->Form->control($date_ouv);
    /* ,
      [
      'type' => "text",
      'label' => "Date Ouverture : ",
      'value' => Date::now()->format("Y/m/d"),
      ]
      ); */
    ?>
    <?=
    $this->Form->control($date_fer); /* ,
      [
      'type' => "text",
      'label' => "Date Fermeture : ",
      'value' => Date::now()->format("Y/m/d"),
      ]
      ); */
    ?>
    <?=
    $this->Form->control($ind_lib,
            [
        'type' => "text",
        'label' => "Libellé : ",
            ]
    );
    ?>
    <?=
    $this->Form->control($ind_cle,
            [
        'type' => "text",
        'label' => "Indice de Candidature : ",
            ]
    );
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
