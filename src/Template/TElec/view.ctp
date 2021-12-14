<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Election'), ['action' => 'edit', $typeElection->TYSC_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Election'), ['action' => 'delete', $typeElection->TYSC_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeElection->TYSC_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Election'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Election'), ['action' => 'edit', $typeElection->TYSC_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Election'), ['action' => 'delete', $typeElection->TYSC_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeElection->TYSC_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Election'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeElection->TYSC_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYSC CODE') ?></td>
            <td><?= h($typeElection->TYSC_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYEN CODE') ?></td>
            <td><?= h($typeElection->TYEN_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYEG CODE') ?></td>
            <td><?= h($typeElection->TYEG_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYEL CODE') ?></td>
            <td><?= h($typeElection->TYEL_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO CODE') ?></td>
            <td><?= h($typeElection->TYFO_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYCO CODE') ?></td>
            <td><?= h($typeElection->TYCO_CODE) ?></td>
        </tr>
    </table>
</div>

