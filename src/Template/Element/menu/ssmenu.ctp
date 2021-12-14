<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
/**
 * Affiche les options contenu dans tableau $ssmenu
 */
foreach ($ssmenu as $key => $value) {
    echo "<div onclick=" . $key . ">" . PHP_EOL;
    echo $value . PHP_EOL;
    echo "</div>" . PHP_EOL;
}
