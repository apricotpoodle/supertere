<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Election $election
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Election'), ['action' => 'edit', $election->ELEC_CLE]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Election'), ['action' => 'delete', $election->ELEC_CLE], ['confirm' => __('Are you sure you want to delete # {0}?', $election->ELEC_CLE)]) ?> </li>
        <li><?= $this->Html->link(__('List Election'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Election'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="election view large-9 medium-8 columns content">
    <h3><?= h($election->ELEC_CLE) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('INDI CLE') ?></th>
            <td><?= h($election->INDI_CLE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYSC CODE') ?></th>
            <td><?= h($election->TYSC_CODE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYEN CODE') ?></th>
            <td><?= h($election->TYEN_CODE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYEG CODE') ?></th>
            <td><?= h($election->TYEG_CODE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYEL CODE') ?></th>
            <td><?= h($election->TYEL_CODE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TYRT CODE') ?></th>
            <td><?= h($election->TYRT_CODE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ELEC LIB') ?></th>
            <td><?= h($election->ELEC_LIB) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ELEC CLE') ?></th>
            <td><?= $this->Number->format($election->ELEC_CLE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('REGL CODE') ?></th>
            <td><?= $this->Number->format($election->REGL_CODE) ?></td>
        </tr>
    </table>
</div>
