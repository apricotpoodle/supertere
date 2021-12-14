<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Scrutin $scrutin
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($scrutin); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Scrutin']) ?></legend>
    <?php
    echo $this->Form->control('SCRU_DATE');
    echo $this->Form->control('SCRU_VALIDE');
    echo $this->Form->control('SCRU_VALI_DATE');
    echo $this->Form->control('SCRU_ACTIF');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
