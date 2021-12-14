<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EtiquettePolitique $etiquettePolitique
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $etiquettePolitique->ETIQ_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $etiquettePolitique->ETIQ_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Etiquette Politique'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $etiquettePolitique->ETIQ_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $etiquettePolitique->ETIQ_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Etiquette Politique'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($etiquettePolitique); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Etiquette Politique']) ?></legend>
    <?php
    echo $this->Form->control('ETIQ_LIBEL');
    echo $this->Form->control('ETIQ_TYPO');
    echo $this->Form->control('ETIQ_DATE');
    echo $this->Form->control('ETIQ_COM');
    echo $this->Form->control('ETIQ_PREF_PART');
    echo $this->Form->control('ETIQ_ORDRE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
