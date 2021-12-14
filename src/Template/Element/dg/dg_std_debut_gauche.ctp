<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<table id="dgg" class="easyui-datagrid"
       data-options=
       "
       striped:true,
       loadMsg:'Veuillez Patienter…',
       emptyMsg:'Aucune Donnée…',

       pagination:true,
       pagePosition:'top',
       pageNumber:1,
       pageSize:<?= $pageSize ?>,
       pageList:[10,12,15,20,25,30,40,50,1000],

       toolbar:tbg,

       remoteSort:true,
       multiSort:true,

       rownumber:false,
       singleSelect:false,
       checkbox:true,

       url:'<?=
       $this->Url->build([
           'controller' => $this->name,
           'action' => 'getdatagridgauche',
           '_ext' => 'json'
       ]);
       ?>',
       fitColumns:true,
       queryParams: {
       _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>',
       q: $('#q').val(),

       }
       "
       >

