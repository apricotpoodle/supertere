<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Entite Geo'), ['action' => 'edit', $typeEntiteGeo->TYEG_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Entite Geo'), ['action' => 'delete', $typeEntiteGeo->TYEG_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntiteGeo->TYEG_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Entite Geo'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Entite Geo'), ['action' => 'edit', $typeEntiteGeo->TYEG_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Entite Geo'), ['action' => 'delete', $typeEntiteGeo->TYEG_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntiteGeo->TYEG_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Entite Geo'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeEntiteGeo->TYEG_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYEG CODE') ?></td>
            <td><?= h($typeEntiteGeo->TYEG_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYEG LIBE') ?></td>
            <td><?= h($typeEntiteGeo->TYEG_LIBE) ?></td>
        </tr>
    </table>
</div>

