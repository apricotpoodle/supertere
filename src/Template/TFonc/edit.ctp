<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeFonction $typeFonction
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeFonction->TYFO_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeFonction->TYFO_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeFonction->TYFO_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeFonction->TYFO_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Fonction'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeFonction); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Fonction']) ?></legend>
    <?php
    echo $this->Form->control('TYFO_LIBE');
    echo $this->Form->control('TYFO_TYPO');
    echo $this->Form->control('TYFO_CAUSE');
    echo $this->Form->control('TYFO_ORDRE');
    echo $this->Form->control('TYFO_ORDRE_FLOT');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
