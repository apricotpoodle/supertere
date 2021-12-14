<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValeurClassifGeo $valeurClassifGeo
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($valeurClassifGeo); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Valeur Classif Geo']) ?></legend>
    <?php
    echo $this->Form->control('VACL_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
