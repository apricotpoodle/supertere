<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Etiquette Politique'), ['action' => 'edit', $etiquettePolitique->ETIQ_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Etiquette Politique'), ['action' => 'delete', $etiquettePolitique->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $etiquettePolitique->ETIQ_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Etiquette Politique'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Etiquette Politique'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Etiquette Politique'), ['action' => 'edit', $etiquettePolitique->ETIQ_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Etiquette Politique'), ['action' => 'delete', $etiquettePolitique->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $etiquettePolitique->ETIQ_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Etiquette Politique'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Etiquette Politique'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($etiquettePolitique->ETIQ_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('ETIQ CLE') ?></td>
            <td><?= h($etiquettePolitique->ETIQ_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ LIBEL') ?></td>
            <td><?= h($etiquettePolitique->ETIQ_LIBEL) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ TYPO') ?></td>
            <td><?= h($etiquettePolitique->ETIQ_TYPO) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ COM') ?></td>
            <td><?= h($etiquettePolitique->ETIQ_COM) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ ORDRE') ?></td>
            <td><?= $this->Number->format($etiquettePolitique->ETIQ_ORDRE) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ DATE') ?></td>
            <td><?= h($etiquettePolitique->ETIQ_DATE) ?></td>
        </tr>
        <tr>
            <td><?= __('ETIQ PREF PART') ?></td>
            <td><?= $etiquettePolitique->ETIQ_PREF_PART ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

