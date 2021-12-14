<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$ref = "#";
?>
<li><?=
    // Command Create an item
    $this->Html->link('',
            '#'
            //[
            //'action' => 'edit', 'dgEdit()'//"javascript:void(0)" //'action' => 'edit', $ref
            //]
            ,
            [
        'title' => __('Edit {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-edit',
        //'onclick' => "javascript:alert('add')",
        'onclick' => "dgEdit()",
    ]);
    ?></li>
