<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ventilation $ventilation
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $ventilation->VENT_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $ventilation->VENT_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Ventilation'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $ventilation->VENT_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $ventilation->VENT_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Ventilation'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($ventilation); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Ventilation']) ?></legend>
    <?php
    echo $this->Form->control('VENT_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
