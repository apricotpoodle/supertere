<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$ref = "#"; /* Paramètre à passer lors de l'appel ? */
?>
<li><?=
    // Command Delete an item
    $this->Form->postLink('', '#',
            [
        'title' => __('Delete'),
        'class' => 'btn btn-default glyphicon glyphicon-trash',
        //'confirm' => __('Are you sure you want to delete # {0}?', $ref),
        'onClick' => 'dgDelete()',
    ])
    ?>
</li>
