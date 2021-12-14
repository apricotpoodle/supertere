<?php

use Cake\Core\Configure;

/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (!$this->fetch('tb_footer')) {
    $southTitle = sprintf('&copy;%s %s', date('Y'), Configure::read('App.title'));
    $this->start('tb_footer');
    ?>
    <div data-options="
         region:'south',
         title:'<?= $southTitle ?>',
         collapsed:true,
         hideCollapsedContent:false,
         split:true" style="height:100px;">
    </div>
    <?php
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend('tb_body_attrs',
        ' class="' . implode(' ',
                [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
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
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta',
        $this->Html->meta('author', null,
                ['name' => 'infogestion@lemonde.fr', 'content' => Configure::read('App.author')]));
$this->prepend('meta',
        $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']));

/**
 * Prepend `css` block with Bootstrap stylesheets and append
 * the `$html5Shim`.
 */
$html5Shim = <<<HTML

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
HTML;
$this->prepend('css',
        $this->Html->css([
        'bootstrap/bootstrap',
        '../js/jquery/ui/jquery-ui-1.12.1/jquery-ui.min',
        '../js/jquery/ui/jquery-ui-1.12.1/jquery-ui.theme.min',
        '../js/jquery/ui/jquery-ui-1.12.1/jquery-ui.structure.min',
        '../jquery-easyui-1.8.6/themes/bootstrap/easyui',
        '../jquery-easyui-1.8.6/themes/icon',
        '../jquery-easyui-1.8.6/themes/color',
        ])
);

$this->append('css', $html5Shim);

/**
 * Prepend `script` block with jQuery and Bootstrap scripts
 */
$this->prepend('script',
        $this->Html->script([
        // jquery
        'jquery/jquery.3.4.1', // Version 3.4.1
        //'jquery/jquery', // Version 3.3.1
        //'../jquery-easyui-1.8.6/jquery.min', // version 1.12.4
        // jquey-ui
        '../js/jquery/ui/jquery-ui-1.12.1/jquery-ui.min',
        '../js/jquery/ui/jquery-ui-1.12.1/datepicker-fr',
        // jquery.easyui
        '../jquery-easyui-1.8.6/jquery.easyui.min',
        // jquery datagrid extension permettant l'édition de cellule
        '../datagrid-cellediting/datagrid-cellediting',
        // bootstrap
        'bootstrap/bootstrap',
        ])
);
?>
<!DOCTYPE html>

<?= $this->fetch('html') ?>

<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">

    <title><?= $this->fetch('title') ?></title>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<?php
echo $this->fetch('tb_body_start');
echo $this->fetch('tb_flash');
echo $this->fetch('content');
echo $this->fetch('tb_footer');
echo $this->fetch('script');
echo $this->fetch('tb_body_end');
?>

</html>
