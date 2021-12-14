<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeDecision $typeDecision
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeDecision->TYDE_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeDecision->TYDE_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Decision'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeDecision->TYDE_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeDecision->TYDE_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Decision'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeDecision); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Decision']) ?></legend>
    <?php
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
