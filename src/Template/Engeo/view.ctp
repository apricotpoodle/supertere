<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Entite Geo'), ['action' => 'edit', $entiteGeo->ENTG_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Entite Geo'), ['action' => 'delete', $entiteGeo->ENTG_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entiteGeo->ENTG_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Entite Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Entite Geo'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Entite Geo'), ['action' => 'edit', $entiteGeo->ENTG_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Entite Geo'), ['action' => 'delete', $entiteGeo->ENTG_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entiteGeo->ENTG_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Entite Geo'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Entite Geo'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($entiteGeo->ENTG_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYEG CODE') ?></td>
            <td><?= h($entiteGeo->TYEG_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG DESI') ?></td>
            <td><?= h($entiteGeo->ENTG_DESI) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CODINSEE') ?></td>
            <td><?= h($entiteGeo->ENTG_CODINSEE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG LIBELLE') ?></td>
            <td><?= h($entiteGeo->ENTG_LIBELLE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG TYPO') ?></td>
            <td><?= h($entiteGeo->ENTG_TYPO) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG TRI') ?></td>
            <td><?= h($entiteGeo->ENTG_TRI) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG GEOCODE') ?></td>
            <td><?= h($entiteGeo->ENTG_GEOCODE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CLE') ?></td>
            <td><?= $this->Number->format($entiteGeo->ENTG_CLE) ?></td>
        </tr>
    </table>
</div>

