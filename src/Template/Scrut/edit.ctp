<?php

use App\Model\Table\AppTable;
use App\View\AppView;

/**
 * @var AppView $this
 * @var \App\Model\Entity\Scrutin $scrutin
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
/**
 * Append `script` block with jQuery and Bootstrap scripts
 */
/*
 *  si pas extend de g2terelayout
 */
$this->prepend('script', $this->Html->script(['funct_' . 'gene']));
/*
 * tjs nécessaire 'funct_' . $this->name
 */
$this->prepend('script', $this->Html->script(['funct_' . $this->name]));

$this->start('tb_actions');
?>
<li><?=
    $this->Form->postLink(
            __('Delete'), ['action' => 'delete', $entity->ELEC_CLE],
            ['confirm' => __('Are you sure you want to delete # {0}?',
                $scrutin->ELEC_CLE)]
    )
    ?>
</li>
<li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Form->postLink(
                __('Delete'), ['action' => 'delete', $entity->ELEC_CLE],
                ['confirm' => __('Are you sure you want to delete # {0}?',
                    $entity->ELEC_CLE)]
        )
        ?>
    </li>
    <li><?=
        $this->Html->link(__('Caractéristiques'),
                ['action' => 'caract', $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?=
        $this->Html->link(__('Choix Circ.'),
                ['action' => 'choixCirc', $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?=
        $this->Html->link(__('Rappels'),
                ['action' => 'rappels', $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?=
        $this->Html->link(__('Candidatures'),
                ['action' => 'candidatures', $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?=
        $this->Html->link(__('Résultats'),
                ['action' => 'resultats',
            $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?=
        $this->Html->link(__('Commentaires'),
                ['action' => 'commentaires',
            $entity->ELEC_CLE, $entity->SCRU_TOUR])
        ?></li>
    <li><?= $this->Html->link(__('List Scrutin'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();

echo $this->Form->create($entity);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Scrutin']) ?></legend>
    <?php
    //dd($entity);
    echo $this->Form->control(AppTable::SETTABELECT . "." . "TYEL_CODE",
            ["label" => "Type élection", 'type' => 'text', "readonly" => true]);
    echo $this->Form->control(AppTable::SETTABELECT . "." . "TYSC_CODE",
            ["label" => "Type scrutin", 'type' => 'text', "readonly" => true]);
    echo $this->Form->control(AppTable::SETTABELECT . "." . "ELEC_LIB",
            ["label" => "Libellé", 'type' => 'text', "readonly" => false]);
    //dd(__FILE__ . "::" . __LINE__, $entity);
    echo $this->Form->control("SCRU_DATE",
            [
        // dev'u uz'i cakephp fleks'o "scru-date"
        // 'id' => "SCRU_DATE", utilisons l'inflexion par défaut scrut-date.
        'class' => 'datepicker',
        'type' => "text",
        'label' => "Date Scrutin : ",
            //'value' => substr($this->request->getData("SCRU_DATE"),0,10) ,
            //'value' => substr($entity["SCRU_DATE"], 0, 10),
            //'value' => $this->request->getData("SCRU_DATE"),
            ]
    );
    echo $this->Form->control(AppTable::SCRUTTOUR,
            ['type' => 'text', "readonly" => true]);
//    echo $this->Form->control('SCRU_VALIDE');
//    echo $this->Form->control('SCRU_VALI_DATE');
//    echo $this->Form->control('SCRU_ACTIF');
    ?>
</fieldset>
<?php
echo $this->Form->button(__("Save"));
echo $this->Form->end()
?>
