<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<li><?=
    /*
     * Bouton InitAuto de la fenêtre
     * frmTabEntGeoCand
     * Circ. electorales de Candidature
     */
    /*
      [
      'controller' => 'Egcanselautovilles',
      'action' => 'pretraitement',
      1,
      2
      ],
     *  */
    $this->Html->link(__('Sél. Autom.'),
            [
        'controller' => 'Egcanselautovilles',
        'action' => 'index',
            ],
            [
        'title' => __('Selection Automatique des Villes {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-arrow-right',
        /* 'class' => 'btn btn-default', */
        /* 'onclick' => "dggApply()" */
        'confirm' => __('Attention ! Voulez-vous continuer ?'),
            /* 'onclick' => "javascript:alert('select Auto villes  Ent. Géo. Candidature')", */
            /* 'onclick' => "dgAddRound()", */
            ]
    );
    ?></li>