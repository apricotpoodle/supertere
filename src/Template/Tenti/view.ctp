<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Entite'), ['action' => 'edit', $typeEntite->TYEN_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Entite'), ['action' => 'delete', $typeEntite->TYEN_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntite->TYEN_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Entite'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Entite'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Entite'), ['action' => 'edit', $typeEntite->TYEN_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Entite'), ['action' => 'delete', $typeEntite->TYEN_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntite->TYEN_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Entite'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Entite'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeEntite->TYEN_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYEN CODE') ?></td>
            <td><?= h($typeEntite->TYEN_CODE) ?></td>
        </tr>
    </table>
</div>

