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
                [
                'easyui-layout', // "style='width:700px;height:350px;'",
                "style='width:auto;height:750px;'",
                $this->request->getParam('controller'),
                $this->request->getParam('action'),
        ]) . '" ');

/**
 * Prepend `script` block with jQuery and Bootstrap scripts
 */
$this->prepend('script', $this->Html->script(['funct_gene']));


$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div
        data-options="
        region:'north',
        title:'<?=
        Configure::read('App.title') . "/"
        . $this->request->getParam('controller');
        ?>',
        hideCollapsedContent:false,
        split:true
        " style="height:100px;">
        <a href="#" title="Panneau menu + boutons." class="easyui-tooltip">
            <div class="easyui-panel" style="padding:0px;">

                <!-- Switch button Connexion -->
                <a href="#" title="Connexion" class="easyui-tooltip">
                    <input id = "sb_connection"
                        <?= $isInProd ? " checked " : ""; ?>
                        name = "sb_connection"
                        class = "easyui-switchbutton"
                        style="width:75px"
                        data-options="
                        onText: '<?= $nomBase; ?>',
                        offText: '<?= $nomBase; ?>',
                        onChange: function (checked) {
                        <!-- window.location.href = '< ? = $this->name ?>/changeDataSource/' + checked; -->
                        window.location.href =  getWebRoot() +  '<?= $this->name ?>/changeDataSource/' + checked;
                        },
                        "
                    >
                </a>
                <!-- Switch button Rafraichir Autom. -->
                <a href="#" title="Rafraîchissement automatique" class="easyui-tooltip">
                    <input id="sb_rafraichir"
                           name="sb_rafraichir"
                           class="easyui-switchbutton"
                           value="0"
                           style="width:75px"

                           data-options="
                           onText: 'Auto.',
                           offText: 'Manu.',
                           reversed: false,
                           onChange: function (checked) {

                           timeRefresh=checked;
                           rafraichir_dg();

                           //if (checked) {
                           //timeRefresh = 1;
                           //} else {
                           //timeRefresh = 0;
                           //};

                           },
                           ">
                </a>
                <!-- Bouton Menu Contextuel -->
                <button onclick="doShowMenu()">Menu</button>
                <!-- Menu Contextuel -->
                <?= $this->element("menu" . DS . "contextuel"); ?>
                <!-- Formulaire de query général -->
                <a href="#" title="Recherche Globale" class="easyui-tooltip">
                    <?php
                    echo $this->Form->create(
                            null
                            ,
                            [
                            'valueSources' => 'query',
                            //'class' => 'navbar-form navbar-right',
                            'class' => 'navbar-form navbar-left',
                            //'class' => 'navbar-right',
                            //'class' => 'navbar-form',
                    ]);
                    // Hidden CSRF token
                    echo $this->Form->control(
                            "csrfToken",
                            [
                            "id" => "csrfToken",
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
                            //'type' => 'button',
                            'title' => __('Filter'),
                            'class' => 'btn btn-default glyphicon glyphicon-filter',
                            //'onClick' => 'doSearch()',
                            ]
                    );
                    echo $this->Html->link(
                            ''
                            ,
                            ['action' => 'index']
                            ,
                            [
                            'title' => __('Reset'),
                            'class' => 'btn btn-default glyphicon glyphicon-refresh',
                            ]
                    );
                    echo $this->Form->end();
                    ?>
                </a>
            </div>
        </a>
    </div>
    <div data-options="region:'east',title:'East',collapsed:true,hideCollapsedContent:false,split:true" style="width:100px;"></div>
    <div data-options="region:'west',title:'Action',collapsed:false,hideCollapsedContent:false,split:true" style="width:100px;">
        <?= $this->fetch('tb_sidebar') ?>
    </div>
    <div data-options="region:'center',title:'<?= isset($centerTitle) ? $centerTitle : "center title"; ?>'" style="padding:5px;background:#eee;">

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

        $this->append('content', '</div></div></div></div>');
        echo $this->fetch('content');
