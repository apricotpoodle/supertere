<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeClassification $typeClassification
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeClassification->TYCL_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeClassification->TYCL_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeClassification->TYCL_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeClassification->TYCL_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Classification'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeClassification); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Classification']) ?></legend>
    <?php
    echo $this->Form->control('TYCL_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
