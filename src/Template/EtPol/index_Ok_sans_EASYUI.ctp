<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Etiquette Politique'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('ETIQ_CLE'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_LIBEL'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_TYPO'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_DATE'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_COM'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_PREF_PART'); ?></th>
            <th><?= $this->Paginator->sort('ETIQ_ORDRE'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etiquettePolitique as $etiquettePolitique): ?>
        <tr>
            <td><?= h($etiquettePolitique->ETIQ_CLE) ?></td>
            <td><?= h($etiquettePolitique->ETIQ_LIBEL) ?></td>
            <td><?= h($etiquettePolitique->ETIQ_TYPO) ?></td>
            <td><?= h($etiquettePolitique->ETIQ_DATE) ?></td>
            <td><?= h($etiquettePolitique->ETIQ_COM) ?></td>
            <td><?= h($etiquettePolitique->ETIQ_PREF_PART) ?></td>
            <td><?= $this->Number->format($etiquettePolitique->ETIQ_ORDRE) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $etiquettePolitique->ETIQ_CLE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $etiquettePolitique->ETIQ_CLE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $etiquettePolitique->ETIQ_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $etiquettePolitique->ETIQ_CLE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
