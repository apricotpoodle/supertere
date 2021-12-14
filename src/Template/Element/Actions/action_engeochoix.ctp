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
        'title' => __('Choix de circonscription {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-screenshot',
        //'confirm' => __('Are you sure you want to add a new scrutin ?'),
        //'onclick' => "javascript:alert('addRound')",
        'onclick' => "dgChoixUneEngeo()",
    ]);
    ?></li>