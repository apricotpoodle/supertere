<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EntiteGeo $entiteGeo
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $entiteGeo->ENTG_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $entiteGeo->ENTG_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Entite Geo'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $entiteGeo->ENTG_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $entiteGeo->ENTG_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Entite Geo'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($entiteGeo); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Entite Geo']) ?></legend>
    <?php
    echo $this->Form->control('TYEG_CODE');
    echo $this->Form->control('ENTG_DESI');
    echo $this->Form->control('ENTG_CODINSEE');
    echo $this->Form->control('ENTG_LIBELLE');
    echo $this->Form->control('ENTG_TYPO');
    echo $this->Form->control('ENTG_TRI');
    echo $this->Form->control('ENTG_GEOCODE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
