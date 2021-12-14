<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeRattachement $typeRattachement
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('List Type Rattachement'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Html->link(__('List Type Rattachement'), ['action' => 'index'])
        ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeRattachement); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Rattachement']) ?></legend>
    <?= $this->Form->control('TYRT_CODE', ['type' => 'text']); ?>
    <?= $this->Form->control('TYRT_LIBE'); ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
