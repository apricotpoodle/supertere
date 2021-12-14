<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EntGeoScrutin $entGeoScrutin
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Ent Geo Scrutin'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Ent Geo Scrutin'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($entGeoScrutin); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Ent Geo Scrutin']) ?></legend>
    <?php
    echo $this->Form->control('EGEO_SIEGES');
    echo $this->Form->control('EGEO_LIBEL');
    echo $this->Form->control('EGEO_LIBEL_2');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
