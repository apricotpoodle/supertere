<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Election $election
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $election->ELEC_CLE],
                ['confirm' => __('Are you sure you want to delete # {0}?', $election->ELEC_CLE)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Election'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="election form large-9 medium-8 columns content">
    <?= $this->Form->create($election) ?>
    <fieldset>
        <legend><?= __('Edit Election') ?></legend>
        <?php
            echo $this->Form->control('INDI_CLE');
            echo $this->Form->control('TYSC_CODE');
            echo $this->Form->control('TYEN_CODE');
            echo $this->Form->control('TYEG_CODE');
            echo $this->Form->control('TYEL_CODE');
            echo $this->Form->control('TYRT_CODE');
            echo $this->Form->control('ELEC_LIB');
            echo $this->Form->control('REGL_CODE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
