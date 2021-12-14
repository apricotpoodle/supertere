<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeRattachement $typeRattachement
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeRattachement->TYRT_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeRattachement->TYRT_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Rattachement'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeRattachement->TYRT_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeRattachement->TYRT_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Rattachement'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeRattachement); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Rattachement']) ?></legend>
    <?php
    echo $this->Form->control('TYRT_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
