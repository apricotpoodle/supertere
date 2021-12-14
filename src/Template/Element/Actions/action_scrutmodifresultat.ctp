<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
// Lance écran de modification des résultats
    $this->Html->link(
        'OK',
        '#',
        [
        'title' => __('Modification des Résultats. TOTOfrmResultatScrutin'),
        'class' => 'btn btn-default glyphicon glyphicon-screenshot',
        // 'confirm' => __('Êtes-vous sûr de vouloir faire cela ?'),
        // 'onclick' => "javascript:alert('addRound')",
        'onclick' => "dgModifResultats()",
    ]);
    ?></li>