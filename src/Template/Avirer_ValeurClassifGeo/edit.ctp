<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValeurClassifGeo $valeurClassifGeo
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $valeurClassifGeo->TYCL_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $valeurClassifGeo->TYCL_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $valeurClassifGeo->TYCL_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $valeurClassifGeo->TYCL_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Valeur Classif Geo'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($valeurClassifGeo); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Valeur Classif Geo']) ?></legend>
    <?php
    echo $this->Form->control('VACL_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
