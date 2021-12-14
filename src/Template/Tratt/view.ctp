<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Rattachement'), ['action' => 'edit', $typeRattachement->TYRT_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Rattachement'), ['action' => 'delete', $typeRattachement->TYRT_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeRattachement->TYRT_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Rattachement'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Rattachement'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Rattachement'), ['action' => 'edit', $typeRattachement->TYRT_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Rattachement'), ['action' => 'delete', $typeRattachement->TYRT_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeRattachement->TYRT_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Rattachement'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Rattachement'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeRattachement->TYRT_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYRT CODE') ?></td>
            <td><?= h($typeRattachement->TYRT_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYRT LIBE') ?></td>
            <td><?= h($typeRattachement->TYRT_LIBE) ?></td>
        </tr>
    </table>
</div>

