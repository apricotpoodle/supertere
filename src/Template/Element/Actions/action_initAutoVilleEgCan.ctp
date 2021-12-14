<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
// Bouton InitAuto de la fenêtre
// frmTabEntGeoCand
// Circ. electorales de Candidature
    $this->Html->link(__('Init. Autom.'),
            [
        'controller' => 'Egcaninitautovilles',
        'action' => 'index',
            ],
            [
        'title' => __('Initiation automatique des villes {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-flash',
        'confirm' => __('Voulez-vous initialiser les villes ?'),
            /* 'onclick' => "javascript:alert('initAuto  Ent. Géo. Candidature')", */
            /* 'onclick' => "dgAddRound()", */
    ]);
    ?></li>