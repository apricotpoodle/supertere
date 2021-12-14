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
            'title' => __('gestion des résultats {0}', $this->name),
            'class' => 'btn btn-default glyphicon glyphicon-stats',
            //'confirm' => __('sûr et certain ?'),
            //'onclick' => "javascript:alert('Gestion des résultats')",
            'onclick' => "dgGestionResultats()",
    ]);
    ?></li>