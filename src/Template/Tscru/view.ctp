<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Scrutin'), ['action' => 'edit', $typeScrutin->TYSC_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Scrutin'), ['action' => 'delete', $typeScrutin->TYSC_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeScrutin->TYSC_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Scrutin'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Scrutin'), ['action' => 'edit', $typeScrutin->TYSC_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Scrutin'), ['action' => 'delete', $typeScrutin->TYSC_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeScrutin->TYSC_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Scrutin'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeScrutin->TYSC_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYSC CODE') ?></td>
            <td><?= h($typeScrutin->TYSC_CODE) ?></td>
        </tr>
    </table>
</div>

