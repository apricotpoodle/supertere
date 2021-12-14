<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeElection $typeElection
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeElection->TYSC_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeElection->TYSC_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeElection->TYSC_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeElection->TYSC_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Election'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeElection); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Election']) ?></legend>
    <?php
    echo $this->Form->control('TYFO_CODE');
    echo $this->Form->control('TYCO_CODE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
