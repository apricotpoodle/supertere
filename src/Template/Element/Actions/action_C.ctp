<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
// Command Create an item
    $this->Html->link('', ['action' => 'add'
            ],
            [
        'title' => __('New {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-plus',
            //'onclick' => "javascript:alert('add')",
            //'onclick' => "dgsearch()",
    ]);
    ?></li>
