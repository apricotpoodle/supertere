<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$pActio = 'Actions' . DS;
$this->append('tb_actions');
echo $this->element($pActio . 'action_addEgcan');
echo $this->element($pActio . 'action_retourEgcan');
//echo $this->element($pActio . 'action_initAutoVilleEgCan');
//echo $this->element($pActio . 'action_selectAutoVilleEgCan');
//echo $this->element($pActio . 'action_selectAutoVilleEgCan');

$this->end();
