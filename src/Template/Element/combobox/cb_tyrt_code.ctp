<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
?>
<a href="#" title="Filtre type de rattachement " class="easyui-tooltip">
    <input id="cbtyrtCode" class="easyui-combobox" style="width:100px"
           url="<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'cb_tyrt_code',
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
