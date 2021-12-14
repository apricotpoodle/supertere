<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Ventilation'), ['action' => 'edit', $ventilation->VENT_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Ventilation'), ['action' => 'delete', $ventilation->VENT_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $ventilation->VENT_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Ventilation'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ventilation'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Ventilation'), ['action' => 'edit', $ventilation->VENT_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Ventilation'), ['action' => 'delete', $ventilation->VENT_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $ventilation->VENT_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Ventilation'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ventilation'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($ventilation->VENT_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('VENT CODE') ?></td>
            <td><?= h($ventilation->VENT_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('VENT LIBE') ?></td>
            <td><?= h($ventilation->VENT_LIBE) ?></td>
        </tr>
    </table>
</div>

