<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EgCandidature $egCandidature
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Eg Candidature'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Eg Candidature'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($egCandidature); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Eg Candidature']) ?></legend>
    <?php
    echo $this->Form->control('TYEG_CODE');
    echo $this->Form->control('ENTG_DESI');
    echo $this->Form->control('ENTG_CODINSEE');
    echo $this->Form->control('ENTG_LIBELLE');
    echo $this->Form->control('ENTG_TYPO');
    echo $this->Form->control('ENTG_SELECT');
    echo $this->Form->control('ENTG_TRI');
    echo $this->Form->control('ENTG_GEOCODE');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
