<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathCb = 'combobox' . DS;
?>
<div>
    <?= $this->Form->create(null, ['valueSources' => 'query',]); ?>
    <?= $this->element($pathCb . 'cb_scru_tour'); ?>
    <?= $this->element($pathCb . 'cb_tyel_code'); ?>
    <?= $this->element($pathCb . 'cb_tysc_code'); ?>
    <?= $this->Form->end(); ?>
</div>

