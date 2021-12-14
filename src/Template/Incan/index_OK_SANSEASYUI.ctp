<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Indice Candidature'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('INDI_CLE'); ?></th>
            <th><?= $this->Paginator->sort('INDI_DATE_OUV'); ?></th>
            <th><?= $this->Paginator->sort('INDI_DATE_FER'); ?></th>
            <th><?= $this->Paginator->sort('INDI_LIBELLE'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entity as $entity): ?>
        <tr>
            <td><?= h($entity->INDI_CLE) ?></td>
            <td><?= h($entity->INDI_DATE_OUV) ?></td>
            <td><?= h($entity->INDI_DATE_FER) ?></td>
            <td><?= h($entity->INDI_LIBELLE) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $entity->INDI_CLE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $entity->INDI_CLE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $entity->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->INDI_CLE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
