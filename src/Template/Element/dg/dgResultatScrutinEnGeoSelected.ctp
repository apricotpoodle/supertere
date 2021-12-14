<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

/**
 * Syntaxe pour appeler cet élément :
 * https://book.cakephp.org/3.0/en/views.html#passing-variables-into-an-element
 * You can pass data to an element through the element’s second argument:
 *
 * echo $this->element('helpbox', [
 *     "helptext" => "Oh, this text is very helpful."
 * ]);
 * Inside the element file, all the passed variables are available as members
 *  of the parameter array. In the above example,
 * the src/Template/Element/helpbox.ctp file can use the $helptext variable:
 *
 * // Inside src/Template/Element/helpbox.ctp
 * echo $helptext; // Outputs "Oh, this text is very helpful."
 * Keep in mind that in those view vars are merged with the view vars
 * from the view itself. So all view vars set using Controller::set()
 * in the controller and View::set() in the view itself are also
 * available inside the element.
 */
//< ?= $this->element($eltToolBar); ? >
?>
<a href="#" title="<?= isset($titre) ? $titre : "Résultat courant"; ?>" class="easyui-tooltip">
    <table id="dgRSESelected" class="easyui-datagrid"
           data-options="
           iconCls: 'icon-edit',
           singleSelect: true,
           url:'<?=
           $this->Url->build([
           'controller' => $this->name,
           'action' => 'getRsltsScrEg',
           '_ext' => 'json'
           ]);
           ?>',
           queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>',
           q: $('#q').val(),

           },
           onLoadSuccess: function(data){
           onloadsuccessRSES(data);
           },
           //
           //onClickCell: onClickCellRSES,
           //onEndEdit: onEndEditRSES,
           //
           rowStyler: function(index,row){
           if (row.listprice>80){
           return 'background-color:#FFFFFF;color:#fff;'; // return inline style
           //return 'background-color:#6293BB;color:#fff;'; // return inline style
           // the function can return predefined css class and inline style
           // return {class:'r1', style:{'color:#fff'}};
           }
           }
           "
           >
        <thead>
            <tr>
                <!-- ,editor :  pour un datagrid grid spécial edition çô morche moyen :\
                <th style="width:auto" data-options="field:'RESU_SCR_INS',editor:{type:'numberbox',options:{precision:0}}">Inscrits</th>
                <th style="width:auto" data-options="field:'RESU_SCR_VOT',editor:{type:'numberbox',options:{precision:0}}">Votants</th>
                <th style="width:auto" data-options="field:'RESU_SCR_EXP',editor:{type:'numberbox',options:{precision:0}}">Exprimés</th>
                -->
                <th style="width:auto" data-options="field:'RESU_SCR_INS',formatter:function(value,row,index){return format_nombre_separateur(value,' ');},editor:{type:'numberbox',options:{precision:0}}">Inscrits</th>
                <th style="width:auto" data-options="field:'RESU_SCR_VOT',formatter:function(value,row,index){return format_nombre_separateur(value,' ');},editor:{type:'numberbox',options:{precision:0}}">Votants</th>
                <th style="width:auto" data-options="field:'RESU_SCR_EXP',formatter:function(value,row,index){return format_nombre_separateur(value,' ');},editor:{type:'numberbox',options:{precision:0}}">Exprimés</th>
                <th style="width:auto" data-options="field:'ABSTENTION'  ,formatter:function(value,row,index){return format_percent(value);}">ABSTENTION</th>
                <th style="width:auto" data-options="field:'egeo_sieges' ,formatter:function(value,row,index){return format_nombre_separateur(value,' ');},editor:{type:'numberbox',options:{precision:0}}">Sièges à pourvoir</th>
                <th style="width:auto" data-options="field:'egeo_libel',editor:{type:'text'}">Étiquette</th>
                <th style="width:auto" data-options="field:'egeo_libel_2'">Divers</th>
            </tr>
        </thead>
    </table>
</a>


<script>
    function onloadsuccessRSES(data) {
        // Activation  ou désactivation du mode édition via un bouton ?
        $('#dgRSESelected').datagrid('enableCellEditing');
    }
    ;
</script>