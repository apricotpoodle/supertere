<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEntiteGeo $typeEntiteGeo
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeEntiteGeo->TYEG_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntiteGeo->TYEG_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $typeEntiteGeo->TYEG_CODE],
        ['confirm' => __('Are you sure you want to delete # {0}?', $typeEntiteGeo->TYEG_CODE)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Type Entite Geo'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeEntiteGeo); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Entite Geo']) ?></legend>
    <?php
    echo $this->Form->control('TYEG_LIBE');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
