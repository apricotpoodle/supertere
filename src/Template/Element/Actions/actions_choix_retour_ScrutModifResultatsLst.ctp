<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$pActio = 'Actions' . DS;
$this->start('tb_actions');

echo $this->element($pActio . 'action_scrutmodifresultatLst');
echo $this->element($pActio . 'action_scrutretour');
//echo $this->element($pActio . 'action_D');
$this->end();
