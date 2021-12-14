<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeClassification $typeClassification
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeClassification); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Classification']) ?></legend>
    <?php
    echo $this->Form->control('TYCL_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
