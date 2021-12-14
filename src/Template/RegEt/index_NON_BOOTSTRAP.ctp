<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Regroupement Etiquette'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('ETIQ_CLE'); ?></th>
            <th><?= $this->Paginator->sort('VENT_CODE'); ?></th>
            <th><?= $this->Paginator->sort('REGP_ETIQ_GROUPE'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($regroupementEtiquette as $regroupementEtiquette): ?>
        <tr>
            <td><?= h($regroupementEtiquette->ETIQ_CLE) ?></td>
            <td><?= h($regroupementEtiquette->VENT_CODE) ?></td>
            <td><?= h($regroupementEtiquette->REGP_ETIQ_GROUPE) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $regroupementEtiquette->ETIQ_CLE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $regroupementEtiquette->ETIQ_CLE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $regroupementEtiquette->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $regroupementEtiquette->ETIQ_CLE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
