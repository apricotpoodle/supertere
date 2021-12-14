<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Election $election
 */
/*
 * extend ou pas extend ?
 * ajout de tout un tas de UI
 */
//$this->extend('../Layout/TwitterBootstrap/g2terelayout');
/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
/*
 *  si pas extend de g2terelayout
 */
$this->prepend('script', $this->Html->script(['funct_' . 'gene']));
/*
 * tjs nécessaire 'funct_' . $this->name
 */
$this->prepend('script', $this->Html->script(['funct_' . $this->name]));
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Election'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="election form large-9 medium-8 columns content">
    <?= $this->Form->create($election); ?>
    <fieldset>
        <legend><?= __('Add Election') ?></legend>
        <?php
        echo $this->Form->control('INDI_CLE',
                [
            'default' => $defaultIncan,
            'options' => $selIncan, 'label' => 'Indice Candidature',
                ]
        );
        echo $this->Form->control('TYSC_CODE',
                ['options' => $selTscru, 'label' => 'Type de Scrutin',]);
        echo $this->Form->control('TYEN_CODE',
                ['options' => $selTenti, 'label' => "Type d'entité candidate",]);
        echo $this->Form->control('TYEG_CODE',
                ['options' => $selTenge, 'label' => "Type d'entité géogr.",]);
        echo $this->Form->control('TYEL_CODE',
                ['options' => $selTelec, 'label' => "Type d'élection",]);
        echo $this->Form->control('TYRT_CODE',
                [
            'default' => $defaultTratt,
            'options' => $selTratt, 'label' => "Type de rattach.",
                ]
        );
        echo $this->Form->control('ELEC_LIB');
        echo $this->Form->control('REGL_CODE');
        //echo $this->Form->control('scruDate', ["type" => "text"]);
        //, parser:parserEasyUIDate
        // data-options="formatter:formatterEasyUIDate"

        echo $this->Form->control("SCRU_DATE",
                [
            // dev'u uz'i cakephp fleks'o "scru-date"
            // 'id' => "SCRU_DATE", utilisons l'inflexion par défaut scrut-date.
            'class' => 'datepicker',
            'type' => "text",
            'label' => "Date Scrutin : ",
            'value' => $this->request->getData("SCRU_DATE"),
                ]
        );
        ?>


    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
