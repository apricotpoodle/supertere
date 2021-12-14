<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegroupementEtiquette $regroupementEtiquette
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $regroupementEtiquette->ETIQ_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $regroupementEtiquette->ETIQ_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Regroupement Etiquette'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $regroupementEtiquette->ETIQ_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $regroupementEtiquette->ETIQ_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Regroupement Etiquette'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($regroupementEtiquette); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Regroupement Etiquette']) ?></legend>
    <?php
    echo $this->Form->control('REGP_ETIQ_GROUPE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
