<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IndiceCandidature $indiceCandidature
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $entity->INDI_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $entity->INDI_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Indice Candidature'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $entity->INDI_CLE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $entity->INDI_CLE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Indice Candidature'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($entity); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Indice Candidature']) ?></legend>
    <?php
    echo $this->Form->control('INDI_DATE_OUV');
    echo $this->Form->control('INDI_DATE_FER');
    echo $this->Form->control('INDI_LIBELLE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
