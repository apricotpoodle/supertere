<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Ent Geo Scrutin'), ['action' => 'edit', $entGeoScrutin->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Ent Geo Scrutin'), ['action' => 'delete', $entGeoScrutin->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entGeoScrutin->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Ent Geo Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ent Geo Scrutin'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Ent Geo Scrutin'), ['action' => 'edit', $entGeoScrutin->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Ent Geo Scrutin'), ['action' => 'delete', $entGeoScrutin->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entGeoScrutin->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Ent Geo Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Ent Geo Scrutin'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($entGeoScrutin->INDI_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('INDI CLE') ?></td>
            <td><?= h($entGeoScrutin->INDI_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('SCRU TOUR') ?></td>
            <td><?= h($entGeoScrutin->SCRU_TOUR) ?></td>
        </tr>
        <tr>
            <td><?= __('EGEO LIBEL') ?></td>
            <td><?= h($entGeoScrutin->EGEO_LIBEL) ?></td>
        </tr>
        <tr>
            <td><?= __('EGEO LIBEL 2') ?></td>
            <td><?= h($entGeoScrutin->EGEO_LIBEL_2) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CLE') ?></td>
            <td><?= $this->Number->format($entGeoScrutin->ENTG_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('ELEC CLE') ?></td>
            <td><?= $this->Number->format($entGeoScrutin->ELEC_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('EGEO SIEGES') ?></td>
            <td><?= $this->Number->format($entGeoScrutin->EGEO_SIEGES) ?></td>
        </tr>
    </table>
</div>

