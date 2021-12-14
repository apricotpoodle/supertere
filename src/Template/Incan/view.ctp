<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Indice Candidature'), ['action' => 'edit', $entity->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Indice Candidature'), ['action' => 'delete', $entity->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Indice Candidature'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Indice Candidature'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Indice Candidature'), ['action' => 'edit', $entity->INDI_CLE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Indice Candidature'), ['action' => 'delete', $entity->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->INDI_CLE)]) ?> </li>
<li><?= $this->Html->link(__('List Indice Candidature'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Indice Candidature'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($entity->INDI_CLE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('INDI CLE') ?></td>
            <td><?= h($entity->INDI_CLE) ?></td>
        </tr>
        <tr>
            <td><?= __('INDI LIBELLE') ?></td>
            <td><?= h($entity->INDI_LIBELLE) ?></td>
        </tr>
        <tr>
            <td><?= __('INDI DATE OUV') ?></td>
            <td><?= h($entity->INDI_DATE_OUV) ?></td>
        </tr>
        <tr>
            <td><?= __('INDI DATE FER') ?></td>
            <td><?= h($entity->INDI_DATE_FER) ?></td>
        </tr>
    </table>
</div>

