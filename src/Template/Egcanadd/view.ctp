<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Eg Candidature'), ['action' => 'edit', $egCandidature->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Eg Candidature'), ['action' => 'delete', $egCandidature->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $egCandidature->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Eg Candidature'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Eg Candidature'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Eg Candidature'), ['action' => 'edit', $egCandidature->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Eg Candidature'), ['action' => 'delete', $egCandidature->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $egCandidature->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Eg Candidature'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Eg Candidature'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($egCandidature->INDI_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('INDI CLE') ?></td>
            <td><?= h($egCandidature->INDI_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYEG CODE') ?></td>
            <td><?= h($egCandidature->TYEG_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG DESI') ?></td>
            <td><?= h($egCandidature->ENTG_DESI) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CODINSEE') ?></td>
            <td><?= h($egCandidature->ENTG_CODINSEE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG LIBELLE') ?></td>
            <td><?= h($egCandidature->ENTG_LIBELLE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG TYPO') ?></td>
            <td><?= h($egCandidature->ENTG_TYPO) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG TRI') ?></td>
            <td><?= h($egCandidature->ENTG_TRI) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG GEOCODE') ?></td>
            <td><?= h($egCandidature->ENTG_GEOCODE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG CLE') ?></td>
            <td><?= $this->Number->format($egCandidature->ENTG_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('ENTG SELECT') ?></td>
            <td><?= $egCandidature->ENTG_SELECT ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

