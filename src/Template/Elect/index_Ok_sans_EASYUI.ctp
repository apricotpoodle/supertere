<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Election[]|\Cake\Collection\CollectionInterface $election
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Election'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="election index large-9 medium-8 columns content">
    <h3><?= __('Election') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ELEC_CLE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('INDI_CLE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYSC_CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYEN_CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYEG_CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYEL_CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYRT_CODE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ELEC_LIB') ?></th>
                <th scope="col"><?= $this->Paginator->sort('REGL_CODE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($election as $election): ?>
            <tr>
                <td><?= $this->Number->format($election->ELEC_CLE) ?></td>
                <td><?= h($election->INDI_CLE) ?></td>
                <td><?= h($election->TYSC_CODE) ?></td>
                <td><?= h($election->TYEN_CODE) ?></td>
                <td><?= h($election->TYEG_CODE) ?></td>
                <td><?= h($election->TYEL_CODE) ?></td>
                <td><?= h($election->TYRT_CODE) ?></td>
                <td><?= h($election->ELEC_LIB) ?></td>
                <td><?= $this->Number->format($election->REGL_CODE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $election->ELEC_CLE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $election->ELEC_CLE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $election->ELEC_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $election->ELEC_CLE)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
