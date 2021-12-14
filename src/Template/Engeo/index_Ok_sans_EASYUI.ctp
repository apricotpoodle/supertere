<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Entite Geo'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('ENTG_CLE'); ?></th>
            <th><?= $this->Paginator->sort('TYEG_CODE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_DESI'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_CODINSEE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_LIBELLE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_TYPO'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_TRI'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entiteGeo as $entiteGeo): ?>
        <tr>
            <td><?= $this->Number->format($entiteGeo->ENTG_CLE) ?></td>
            <td><?= h($entiteGeo->TYEG_CODE) ?></td>
            <td><?= h($entiteGeo->ENTG_DESI) ?></td>
            <td><?= h($entiteGeo->ENTG_CODINSEE) ?></td>
            <td><?= h($entiteGeo->ENTG_LIBELLE) ?></td>
            <td><?= h($entiteGeo->ENTG_TYPO) ?></td>
            <td><?= h($entiteGeo->ENTG_TRI) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $entiteGeo->ENTG_CLE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $entiteGeo->ENTG_CLE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $entiteGeo->ENTG_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entiteGeo->ENTG_CLE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
