<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

$this->assign('tb_sidebar',
        '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>');
