<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Valeur Classif Geo'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('TYCL_CODE'); ?></th>
            <th><?= $this->Paginator->sort('VACL_VALE'); ?></th>
            <th><?= $this->Paginator->sort('VACL_LIBE'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($valeurClassifGeo as $valeurClassifGeo): ?>
        <tr>
            <td><?= h($valeurClassifGeo->TYCL_CODE) ?></td>
            <td><?= h($valeurClassifGeo->VACL_VALE) ?></td>
            <td><?= h($valeurClassifGeo->VACL_LIBE) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $valeurClassifGeo->TYCL_CODE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $valeurClassifGeo->TYCL_CODE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $valeurClassifGeo->TYCL_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $valeurClassifGeo->TYCL_CODE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
