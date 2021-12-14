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
    <?= $this->element($pathCb . 'cb_vent'); ?>
    <?= $this->Form->end(); ?>
</div>

