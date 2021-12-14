<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeEntite $typeEntite
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
<li><?=
    $this->Form->postLink(
            __('Delete'), ['action' => 'delete', $typeEntite->TYEN_CODE],
            ['confirm' => __('Are you sure you want to delete # {0}?',
                $typeEntite->TYEN_CODE)]
    )
    ?>
</li>
<li><?= $this->Html->link(__('List Type Entite'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Form->postLink(
                __('Delete'), ['action' => 'delete', $typeEntite->TYEN_CODE],
                ['confirm' => __('Are you sure you want to delete # {0}?',
                    $typeEntite->TYEN_CODE)]
        )
        ?>
    </li>
    <li><?= $this->Html->link(__('List Type Entite'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($typeEntite); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Type Entite']) ?></legend>
    <?php
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
