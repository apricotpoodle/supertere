<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathCb = 'combobox' . DS;
$pathNb = 'numberbox' . DS;
?>
<div>
    <?= $this->Form->create(null, ['valueSources' => 'query',]); ?>
    <?= $this->element($pathCb . 'cb_indi_cle'); ?>
    <?= $this->element($pathCb . 'cb_tyeg_code'); ?>
    <?= $this->element($pathCb . 'cb_select'); ?>
    <?= $this->Form->end(); ?>
</div>

