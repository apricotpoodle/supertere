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
    $this->Html->link('', '#',
            [
        'title' => __('Init Auto {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-flash',
        //'confirm' => __('Are you sure you want to add a new scrutin ?'),
        'onclick' => "javascript:alert('initAuto  Ent. Géo. Candidature')",
            //'onclick' => "dgAddRound()",
    ]);
    ?></li>