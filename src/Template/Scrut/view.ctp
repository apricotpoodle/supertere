<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Scrutin'), ['action' => 'edit', $scrutin->ELEC_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Scrutin'), ['action' => 'delete', $scrutin->ELEC_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $scrutin->ELEC_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Scrutin'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Scrutin'), ['action' => 'edit', $scrutin->ELEC_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Scrutin'), ['action' => 'delete', $scrutin->ELEC_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $scrutin->ELEC_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Scrutin'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($scrutin->ELEC_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('SCRU TOUR') ?></td>
            <td><?= h($scrutin->SCRU_TOUR) ?></td>
        </tr>
        <tr>
            <td><?= __('ELEC CLE') ?></td>
            <td><?= $this->Number->format($scrutin->ELEC_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('SCRU DATE') ?></td>
            <td><?= h($scrutin->SCRU_DATE) ?></td>
        </tr>
        <tr>
            <td><?= __('SCRU VALI DATE') ?></td>
            <td><?= h($scrutin->SCRU_VALI_DATE) ?></td>
        </tr>
        <tr>
            <td><?= __('SCRU VALIDE') ?></td>
            <td><?= $scrutin->SCRU_VALIDE ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('SCRU ACTIF') ?></td>
            <td><?= $scrutin->SCRU_ACTIF ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

