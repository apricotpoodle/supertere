<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Scrutin[]|\Cake\Collection\CollectionInterface $scrutin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Scrutin'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="scrutin index large-9 medium-8 columns content">

    <!--h3><?= __('Scrutin') ?></h3-->
    <div>
        <?php
        echo $this->Form->create(null, ['valueSources' => 'query']);
        // You'll need to populate $authors in the template from your controller
        echo $this->Form->control('ELEC_CLE',
                ["value" => $this->request->getData()['ELEC_CLE'] ?? ""]);
        // Match the search param in your table configuration
        echo $this->Form->control('q',
                ["value" => $this->request->getData()['q'] ?? ""]);
        echo $this->Form->button('Filter', ['type' => 'submit']);
        echo $this->Html->link('Reset', ['action' => 'index']);
        echo $this->Form->end();
        ?>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <!--?= $this->Paginator->prev('< ' . __('previous')) ?-->
            <!--?= $this->Paginator->numbers() ?-->
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>

            <!--?= $this->Paginator->next(__('next') . ' >') ?-->
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ELEC_CLE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SCRU_TOUR') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SCRU_DATE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SCRU_VALIDE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SCRU_VALI_DATE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SCRU_ACTIF') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scrutin as $scrutin): ?>
            <tr>
                <td><?= $this->Number->format($scrutin->ELEC_CLE) ?></td>
                <td><?= h($scrutin->SCRU_TOUR) ?></td>
                <td><?= h($scrutin->SCRU_DATE) ?></td>
                <td><?= h($scrutin->SCRU_VALIDE) ?></td>
                <td><?= h($scrutin->SCRU_VALI_DATE) ?></td>
                <td><?= h($scrutin->SCRU_ACTIF) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $scrutin->ELEC_CLE]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $scrutin->ELEC_CLE]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scrutin->ELEC_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $scrutin->ELEC_CLE)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
