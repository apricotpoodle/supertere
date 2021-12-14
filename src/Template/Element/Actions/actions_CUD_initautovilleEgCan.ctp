<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$pActio = 'Actions' . DS;
//echo $this->element($pActio . 'actions_CUD');
$this->append('tb_actions');
//echo $this->element($pActio . 'action_initAutoEgCan');
echo $this->element($pActio . 'action_initAutoVille');
echo $this->element($pActio . 'action_retourEgcan');
/*
 */
$this->end();
