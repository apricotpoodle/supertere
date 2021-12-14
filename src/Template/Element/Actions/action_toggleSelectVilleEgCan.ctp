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
    /*
      $this->Html->link(__('Bascule Sél.'),
      [
      'controller' => 'Egcan',
      'action' => 'toggleSelect',
      //dg_getSelectionsToString()
      ],
      [
      'title' => __('Bascule de la Sélection des Villes {0}', $this->name),
      'class' => 'btn btn-default glyphicon glyphicon-refresh',
      /* 'class' => 'btn btn-default', */
    /* 'onclick' => "dggApply()" 

      'confirm' => __('Attention ! Voulez-vous continuer ?'),
      /* 'onclick' => "javascript:alert('select Auto villes  Ent. Géo. Candidature')", */
    /* 'onclick' => "dgAddRound()", 

      ]
      );
     */
    $this->Html->link('Basc. Sél.', '#',
            [
        'title' => __('Bascule Select Villes {0}', $this->name),
        'class' => 'btn btn-default glyphicon glyphicon-refresh',
        'onclick' => "dg_toggleSelect()"
            ]
    );
    ?></li>