<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathCb = 'combobox' . DS;
?>
<div>
    <?= $this->Form->create(null, ['valueSources' => 'query',]); ?>
    <!--?= $this->element($pathCb . 'cb_tycl_cle'); ?-->
    <!-- Switch button Connexion -->
    <a href="#" title="Avec ou sans R.A.Z. ?" class="easyui-tooltip">
        <input id = "sb_raz"
        <?= (true) ? " checked " : ""; ?>
               name = "sb_raz"
               class = "easyui-switchbutton"
               style = "width:125px"

               data-options="
               onText: 'Avec',
               offText: 'Sans',
               handleText: 'RAZ',
               handleWidth: 'width:125px',
               onChange: function (checked) {changeParRaz(checked);},
               ">
    </a>

    <?= $this->Form->end(); ?>
</div>

