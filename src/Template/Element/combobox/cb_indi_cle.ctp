<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<a href="#" title="Filtre indice candidature" class="easyui-tooltip">
    <input id="cbindiCle" class="easyui-combobox" style="width:120px"
           url="<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'cb_indi_cle',
               '_ext' => 'json'
           ]);
           ?>"
           valueField="id" textField="text"
           data-options= "queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>'
           },
           limitToList:false,
           onChange:function(newValue,oldValue){
           gSearch();
           },
           "
           >

</a>