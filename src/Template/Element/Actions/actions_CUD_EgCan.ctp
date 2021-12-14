<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$pActio = 'Actions' . DS;
echo $this->element($pActio . 'actions_CUD');
$this->append('tb_actions');
echo $this->element($pActio . 'action_toggleSelectVilleEgCan');
echo $this->element($pActio . 'action_initAutoVilleEgCan');
echo $this->element($pActio . 'action_selectAutoVilleEgCan');

$this->end();
