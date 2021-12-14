<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeFonction $typeFonction
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeFonction); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Fonction']) ?></legend>
    <?php
    echo $this->Form->control('TYFO_LIBE');
    echo $this->Form->control('TYFO_TYPO');
    echo $this->Form->control('TYFO_CAUSE');
    echo $this->Form->control('TYFO_ORDRE');
    echo $this->Form->control('TYFO_ORDRE_FLOT');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
