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
    <!-- year picker input form control -->
    <a href="#" title="Quelle année ?" class="easyui-tooltip">
        <?=
        $this->Form->control("YEARPICKER",
                [
            // dev'u uz'i cakephp fleks'o "yearpicker"
            'class' => 'datepicker',
            'type' => "text",
            'placeholder' => __("Choisir une date de l'année cible !"),
            'label' => __("une date dans l'année Cible : "),
            'value' => $this->request->getData("YEARPICKER"),
                ]
        );
        ?>
    </a>

    <?= $this->Form->end(); ?>
</div>

