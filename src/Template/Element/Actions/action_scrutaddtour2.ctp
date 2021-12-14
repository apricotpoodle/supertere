<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
// Command ajoute un tour à un scrutin
    $this->Html->link('OK',
            '#',
            //$this->Url->build(['controller' => $this->name, 'action' => 'addTour2','_ext' => '']),
            [
        'title' => __('Ajout deuxième tour.'),
        'class' => 'btn btn-default glyphicon glyphicon-screenshot',
        //'confirm' => __('Are you sure you want to add a new scrutin ?'),
        //'onclick' => "javascript:alert('addRound')",
        'onclick' => "dgAddTour2()",
    ]);
    ?></li>