<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
/**
 * Élement affichant le contenu HTML d'un sous menu easyui-menu
 *
 * usage : $this-element("menu" . DS . "ssmenu2",[tableau de parametres]);
 * ["ssmenu" => $ssmenu1, "sstitre" => "Paramètres - BlaBla…"]
 */
?>
<div>
    <span><?= $sstitre ?></span>
    <div>
        <?php
        foreach ($ssmenu as $key => $value) {
            echo '<div onclick="' . $key . '">' . PHP_EOL;
            echo $value . PHP_EOL;
            echo "</div>" . PHP_EOL;
        }
        ?>
    </div>
</div>

