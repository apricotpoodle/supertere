<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Valeur Classif Geo'), ['action' => 'edit', $valeurClassifGeo->TYCL_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Valeur Classif Geo'), ['action' => 'delete', $valeurClassifGeo->TYCL_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $valeurClassifGeo->TYCL_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Valeur Classif Geo'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Valeur Classif Geo'), ['action' => 'edit', $valeurClassifGeo->TYCL_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Valeur Classif Geo'), ['action' => 'delete', $valeurClassifGeo->TYCL_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $valeurClassifGeo->TYCL_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Valeur Classif Geo'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($valeurClassifGeo->TYCL_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYCL CODE') ?></td>
            <td><?= h($valeurClassifGeo->TYCL_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('VACL VALE') ?></td>
            <td><?= h($valeurClassifGeo->VACL_VALE) ?></td>
        </tr>
        <tr>
            <td><?= __('VACL LIBE') ?></td>
            <td><?= h($valeurClassifGeo->VACL_LIBE) ?></td>
        </tr>
    </table>
</div>

