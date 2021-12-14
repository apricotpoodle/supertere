<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEntiteGeo $typeEntiteGeo
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeEntiteGeo); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Type Entite Geo']) ?></legend>
    <?php
    echo $this->Form->control('TYEG_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
