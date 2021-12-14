<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Type Fonction'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('TYFO_CODE'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_LIBE'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_TYPO'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_CAUSE'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_ORDRE'); ?></th>
            <th><?= $this->Paginator->sort('TYFO_ORDRE_FLOT'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($typeFonction as $typeFonction): ?>
        <tr>
            <td><?= h($typeFonction->TYFO_CODE) ?></td>
            <td><?= h($typeFonction->TYFO_LIBE) ?></td>
            <td><?= h($typeFonction->TYFO_TYPO) ?></td>
            <td><?= h($typeFonction->TYFO_CAUSE) ?></td>
            <td><?= $this->Number->format($typeFonction->TYFO_ORDRE) ?></td>
            <td><?= $this->Number->format($typeFonction->TYFO_ORDRE_FLOT) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $typeFonction->TYFO_CODE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $typeFonction->TYFO_CODE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $typeFonction->TYFO_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeFonction->TYFO_CODE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
