<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Type Rappel'), ['action' => 'edit', $typeRappel->TYRA_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Rappel'), ['action' => 'delete', $typeRappel->TYRA_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeRappel->TYRA_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Rappel'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Rappel'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
<li><?= $this->Html->link(__('Edit Type Rappel'), ['action' => 'edit', $typeRappel->TYRA_CODE]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Type Rappel'), ['action' => 'delete', $typeRappel->TYRA_CODE], ['confirm' => __('Are you sure you want to delete # {0}?', $typeRappel->TYRA_CODE)]) ?> </li>
<li><?= $this->Html->link(__('List Type Rappel'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Type Rappel'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($typeRappel->TYRA_CODE) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('TYRA CODE') ?></td>
            <td><?= h($typeRappel->TYRA_CODE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYRA LIBE') ?></td>
            <td><?= h($typeRappel->TYRA_LIBE) ?></td>
        </tr>
        <tr>
            <td><?= __('TYRA CHAMP') ?></td>
            <td><?= h($typeRappel->TYRA_CHAMP) ?></td>
        </tr>
    </table>
</div>

