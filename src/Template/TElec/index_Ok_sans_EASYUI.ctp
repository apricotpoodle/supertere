<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Type Election'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('TYSC_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYEN_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYEG_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYEL_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYCO_CODE'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($typeElection as $typeElection): ?>
        <tr>
            <td><?= h($typeElection->TYSC_CODE) ?></td>
            <td><?= h($typeElection->TYEN_CODE) ?></td>
            <td><?= h($typeElection->TYEG_CODE) ?></td>
            <td><?= h($typeElection->TYEL_CODE) ?></td>
            <td><?= h($typeElection->TYFO_CODE) ?></td>
            <td><?= h($typeElection->TYCO_CODE) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $typeElection->TYSC_CODE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $typeElection->TYSC_CODE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $typeElection->TYSC_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeElection->TYSC_CODE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
