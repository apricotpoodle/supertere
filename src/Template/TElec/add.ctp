<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeElection $typeElection
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeElection); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Election']) ?></legend>
    <?php
    echo $this->Form->control('TYSC_CODE', ['type' => 'text']);
    echo $this->Form->control('TYEN_CODE', ['type' => 'text']);
    echo $this->Form->control('TYEG_CODE', ['type' => 'text']);
    echo $this->Form->control('TYEL_CODE', ['type' => 'text']);

    echo $this->Form->control('TYFO_CODE');
    echo $this->Form->control('TYCO_CODE');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
