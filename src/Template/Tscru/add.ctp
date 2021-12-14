<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeScrutin $typeScrutin
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeScrutin); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Scrutin']) ?></legend>
    <?php
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
