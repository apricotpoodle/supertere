<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Rattachement Geographique'), ['action' => 'edit', $rattachementGeographique->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Rattachement Geographique'), ['action' => 'delete', $rattachementGeographique->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $rattachementGeographique->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Rattachement Geographique'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Rattachement Geographique'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Rattachement Geographique'), ['action' => 'edit', $rattachementGeographique->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Rattachement Geographique'), ['action' => 'delete', $rattachementGeographique->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $rattachementGeographique->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Rattachement Geographique'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Rattachement Geographique'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($rattachementGeographique->INDI_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('INDI CLE') ?></td>
            <td><?= h($rattachementGeographique->INDI_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('EG  INDI CLE') ?></td>
            <td><?= h($rattachementGeographique->EG__INDI_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYRT CODE') ?></td>
            <td><?= h($rattachementGeographique->TYRT_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CLE') ?></td>
            <td><?= $this->Number->format($rattachementGeographique->ENTG_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('EG  ENTG CLE') ?></td>
            <td><?= $this->Number->format($rattachementGeographique->EG__ENTG_CLE) ?></td>
        </tr>
    </table>
</div>

