<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Fonction'), ['action' => 'edit', $typeFonction->TYFO_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Fonction'), ['action' => 'delete', $typeFonction->TYFO_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeFonction->TYFO_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Fonction'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Fonction'), ['action' => 'edit', $typeFonction->TYFO_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Fonction'), ['action' => 'delete', $typeFonction->TYFO_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeFonction->TYFO_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Fonction'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeFonction->TYFO_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYFO CODE') ?></td>
            <td><?= h($typeFonction->TYFO_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO LIBE') ?></td>
            <td><?= h($typeFonction->TYFO_LIBE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO TYPO') ?></td>
            <td><?= h($typeFonction->TYFO_TYPO) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO CAUSE') ?></td>
            <td><?= h($typeFonction->TYFO_CAUSE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO ORDRE') ?></td>
            <td><?= $this->Number->format($typeFonction->TYFO_ORDRE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYFO ORDRE FLOT') ?></td>
            <td><?= $this->Number->format($typeFonction->TYFO_ORDRE_FLOT) ?></td>
        </tr>
    </table>
</div>

