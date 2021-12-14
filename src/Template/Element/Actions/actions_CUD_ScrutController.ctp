<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$pActio = 'Actions' . DS;
echo $this->element($pActio . 'actions_CUD');
$this->append('tb_actions');
/*
 * Ajoute un second tour de scrutin
 */
echo $this->element($pActio . 'action_addRound');
/*
 * Choix de circonscription
 */
echo $this->element($pActio . 'action_scrutChoixCirc');
/*
 * Édition de résultat
 */
echo $this->element($pActio . 'action_scrutResultats');
/*
 * Édition de candidature
 */
echo $this->element($pActio . 'action_scrutCandidatures');
$this->end();
