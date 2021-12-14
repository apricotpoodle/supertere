<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Decision'), ['action' => 'edit', $typeDecision->TYDE_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Decision'), ['action' => 'delete', $typeDecision->TYDE_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeDecision->TYDE_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Decision'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Decision'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Decision'), ['action' => 'edit', $typeDecision->TYDE_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Decision'), ['action' => 'delete', $typeDecision->TYDE_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeDecision->TYDE_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Decision'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Decision'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeDecision->TYDE_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYDE CODE') ?></td>
            <td><?= h($typeDecision->TYDE_CODE) ?></td>
        </tr>
    </table>
</div>

