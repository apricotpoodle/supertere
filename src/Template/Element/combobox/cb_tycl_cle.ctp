<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<a href="#" title="Filtre Type Classement Entité Géogr." class="easyui-tooltip">
    <input id="cbtyclCode" class="easyui-combobox" style="width:120px"
           url="<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'cb_tycl_code',
               '_ext' => 'json'
           ]);
           ?>"
           valueField="id" textField="text"
           data-options= "queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>'
           },
           limitToList:true,
           onChange:function(newValue,oldValue){
           dgSearch();
           },
           "
           >
</a>