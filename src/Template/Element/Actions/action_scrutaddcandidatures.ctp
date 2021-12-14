<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
// Command ajoute un tour à un scrutin
    $this->Html->link('', '#',
            [
        'title' => __('Ajout 1 Candidature.'),
        'class' => 'btn btn-default glyphicon glyphicon-plus',
        //'confirm' => __('Are you sure you want to add a new scrutin ?'),
        //'onclick' => "javascript:alert('addRound')",
        'onclick' => "dgAddCand1Eg1Sc()",
    ]);
    ?></li>
