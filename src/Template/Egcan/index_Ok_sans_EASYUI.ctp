<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Eg Candidature'), ['action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('INDI_CLE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_CLE'); ?></th>
            <th><?= $this->Paginator->sort('TYEG_CODE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_DESI'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_CODINSEE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_LIBELLE'); ?></th>
            <th><?= $this->Paginator->sort('ENTG_TYPO'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($egCandidature as $egCandidature): ?>
        <tr>
            <td><?= h($egCandidature->INDI_CLE) ?></td>
            <td><?= $this->Number->format($egCandidature->ENTG_CLE) ?></td>
            <td><?= h($egCandidature->TYEG_CODE) ?></td>
            <td><?= h($egCandidature->ENTG_DESI) ?></td>
            <td><?= h($egCandidature->ENTG_CODINSEE) ?></td>
            <td><?= h($egCandidature->ENTG_LIBELLE) ?></td>
            <td><?= h($egCandidature->ENTG_TYPO) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $egCandidature->INDI_CLE], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $egCandidature->INDI_CLE], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $egCandidature->INDI_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $egCandidature->INDI_CLE), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
