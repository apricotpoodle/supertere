<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Regroupement Etiquette'), ['action' => 'edit', $regroupementEtiquette->ETIQ_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Regroupement Etiquette'), ['action' => 'delete', $regroupementEtiquette->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $regroupementEtiquette->ETIQ_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Regroupement Etiquette'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Regroupement Etiquette'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Regroupement Etiquette'), ['action' => 'edit', $regroupementEtiquette->ETIQ_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Regroupement Etiquette'), ['action' => 'delete', $regroupementEtiquette->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $regroupementEtiquette->ETIQ_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Regroupement Etiquette'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Regroupement Etiquette'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($regroupementEtiquette->ETIQ_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('ETIQ CLE') ?></td>
            <td><?= h($regroupementEtiquette->ETIQ_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('VENT CODE') ?></td>
            <td><?= h($regroupementEtiquette->VENT_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('REGP ETIQ GROUPE') ?></td>
            <td><?= h($regroupementEtiquette->REGP_ETIQ_GROUPE) ?></td>
        </tr>
    </table>
</div>

