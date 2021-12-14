<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Classification'), ['action' => 'edit', $typeClassification->TYCL_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Classification'), ['action' => 'delete', $typeClassification->TYCL_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeClassification->TYCL_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Classification'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Classification'), ['action' => 'edit', $typeClassification->TYCL_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Classification'), ['action' => 'delete', $typeClassification->TYCL_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeClassification->TYCL_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Classification'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeClassification->TYCL_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYCL CODE') ?></td>
            <td><?= h($typeClassification->TYCL_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYCL LIBE') ?></td>
            <td><?= h($typeClassification->TYCL_LIBE) ?></td>
        </tr>
    </table>
</div>

