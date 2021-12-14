<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<a href="#" title="Filtre Sélection Ville" class="easyui-tooltip">
    <input id="cbselect" class="easyui-combobox" style="width:120px"
           url="<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'cb_select',
               '_ext' => 'json'
           ]);
           ?>"
           valueField="id" textField="text"
           data-options= "queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>'
           },
           limitToList:true,
           onChange:function(newValue,oldValue){
           gSearch();
           },
           onLoadSuccess:function(){
           gSearch();
           }
           "
           >
</a>