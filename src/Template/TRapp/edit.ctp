<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeRappel $typeRappel
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeRappel->TYRA_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeRappel->TYRA_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Rappel'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeRappel->TYRA_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeRappel->TYRA_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Rappel'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeRappel); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Rappel']) ?></legend>
    <?php
    echo $this->Form->control('TYRA_LIBE');
    echo $this->Form->control('TYRA_CHAMP');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
