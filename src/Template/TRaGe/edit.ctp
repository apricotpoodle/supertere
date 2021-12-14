<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RattachementGeographique $rattachementGeographique
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $rattachementGeographique->INDI_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $rattachementGeographique->INDI_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Rattachement Geographique'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $rattachementGeographique->INDI_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $rattachementGeographique->INDI_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Rattachement Geographique'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($rattachementGeographique); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Rattachement Geographique']) ?></legend>
    <?php
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
