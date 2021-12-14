<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeScrutin $typeScrutin
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeScrutin->TYSC_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeScrutin->TYSC_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeScrutin->TYSC_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeScrutin->TYSC_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Scrutin'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeScrutin); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Scrutin']) ?></legend>
    <?php
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
