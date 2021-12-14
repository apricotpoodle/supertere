<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathForm = 'form' . DS;
?>
<div id="tb" style="padding:5px;height:auto">
    <?= $this->element($pathForm . 'Form_tour_tyel_tysc') ?>
    <div>
        Date From: <input class="easyui-datebox" style="width:80px">
        To: <input class="easyui-datebox" style="width:80px">
        Language:
        <!--input class="easyui-combobox" style="width:100px"
               url="data/combobox_data.json"
               valueField="id" textField="text"-->
        <!--a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a-->
    </div>
</div>