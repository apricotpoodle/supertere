<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

/* @var $this \Cake\View\View */

use Cake\Core\Configure;

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->prepend('tb_body_attrs',
        ' class="' . implode(' ',
                [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar">bleble</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/g2tere/scrutin"><?= Configure::read('App.title') ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right visible-xs">
                    <?= $this->fetch('tb_actions') ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-divider"></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#help">Help</a></li>
                </ul>
                <!--form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Recherche…">
                </form-->
                <?php
                echo $this->Form->create(
                        null
                        ,
                        [
                    'valueSources' => 'query',
                    'class' => 'navbar-form navbar-right'
                ]);
                // Hidden CSRF token
                echo $this->Form->control(
                        "csrfToken",
                        [
                    "type" => "hidden",
                    "value" => $this->getRequest()->getParam('_csrfToken'),
                        ]
                );
                // Match the search param in your table configuration
                echo $this->Form->control(
                        'q',
                        [
                    "value" => $this->request->getData()['q'] ?? "",
                    "placeholder" => "Recherche Globale…",
                ]);
                echo $this->Form->button('',
                        [
                    'type' => 'submit',
                    'title' => __('Filter'),
                    'class' => 'btn btn-default glyphicon glyphicon-filter',
                        ]
                );
                echo $this->Html->link(
                        ''
                        , ['action' => 'index']
                        ,
                        [
                    'title' => __('Reset'),
                    'class' => 'btn btn-default glyphicon glyphicon-refresh',
                        ]
                );
                echo $this->Form->end();
                ?>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <?= $this->fetch('tb_sidebar') ?>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header"><?= $this->request->getParam('controller'); ?></h1>
                <?php
                /**
                 * Default `flash` block.
                 */
                if (!$this->fetch('tb_flash')) {
                    $this->start('tb_flash');
                    if (isset($this->Flash)) {
                        echo $this->Flash->render();
                    }
                    $this->end();
                }
                $this->end(); // tb_body_start

                $this->start('tb_body_end');
                echo '</body>';
                $this->end();

                $this->append('content', '</div></div></div>');
                echo $this->fetch('content');
                