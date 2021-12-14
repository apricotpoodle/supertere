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
    /*
      [
      'controller' => 'Egcanselautovilles',
      'action' => 'pretraitement',
      1,
      2
      ],
     *  */
    $this->Html->link('Init. autom.', '#',
            [
        'title' => __('Select Auto Villes {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-arrow-right',
        'onclick' => "initAutoVilleApply()"
            ]
    );
    ?></li>