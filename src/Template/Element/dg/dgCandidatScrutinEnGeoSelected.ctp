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
/*
 * Token pour ce formulaire
 */
$kcrsfToken = $this->getRequest()->getParam('_csrfToken');
?>
<a href="#" title="<?= isset($titre) ? $titre : "Candidatures courantes"; ?>" class="easyui-tooltip">
    <!-- lien inspirant pour rendre éditable une datagrid
    view-source:http://www.jeasyui.com/tutorial/datagrid/datagrid12_demo.html
    view-source:http://www.jeasyui.com/demo/main/index.php?plugin=DataGrid&theme=material-teal&dir=ltr&pitem=&sort=asc
    -->
    <table id="dgCSESelected" class="easyui-datagrid"
           data-options="
           iconCls: 'icon-edit',
           singleSelect: true,
           clicktoEdit: true,
           url:'<?=
           $this->Url->build([
           'controller' => $this->name,
           'action' => 'getCandScrEg',
           '_ext' => 'json'
           ]);
           ?>',
           queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>',
           q: $('#q').val(),
           },
           onLoadSuccess: function(data){
           onloadsuccessCSES(data);
           },
           /*
           //onClickCell: function(index,row){
           //onClickRowCSES(index,row)
           //}
           //,
           //onEndEdit: function(index,row){
           //onEndEditCSES(index,row)
           //},
           */
           rowStyler: function(index,row){
           // if (row.listprice>80){
           // // return 'background-color:#FFFFFF;color:#fff;'; // return inline style
           return ; //'background-color:#6293BB;color:#fff;'; // return inline style
           // // the function can return predefined css class and inline style
           // // return {class:'r1', style:{'color:#fff'}};
           // }
           }
           "
           >
        <thead>
            <tr>
                <th style="width:auto" data-options="field:'ETIQ_CLE'">Liste</th>
                <th style="width:auto" data-options="field:'ENTI_CAN_DESI'">Candidature</th>
                <th style="width:auto" data-options="align:'right',field:'RESU_CAND_VOIX',formatter:function(value,row,index){return format_nombre_separateur(value,' ');},editor:{type:'numberbox',options:{precision:0}}">Voix obtenues</th>
                <th style="width:auto" data-options="align:'center',field:'CAND_TYP_DEC'">Décision</th>
                <th style="width:auto" data-options="align:'right',field:'POURCENTAGE_EXPRIME',formatter:function(value,row,index){return format_percent(value,' ');}">% Exprimé</th>
                <th style="width:auto" data-options="align:'right',field:'RESU_CAND_SIEGES'">Sièges</th>
                <!--th style="width:80" data-options="align:'right',formatter:formatActionRow">Action</th-->
            </tr>
        </thead>
    </table>
</a>


<script>
    var deprecated_editIndexCSES = undefined;
    function endEditingCSES() {
        if (editIndexCSES == undefined) {
            return true
        }
        if ($('#dgCSESelected').datagrid('validateRow', editIndexCSES)) {
            $('#dgCSESelected').datagrid('endEdit', editIndexCSES);
            editIndexCSES = undefined;
            return true;
        } else {
            return false;
        }
    }
    function onClickRowCSES(index, field) {
        // alert("passe par ici");

        if (editIndexCSES != index) {
            if (endEditingCSES()) {
                $('#dgCSESelected').datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                var ed = $('#dgCSESelected').datagrid('getEditor', {index: index, field: field});
                if (ed) {
                    ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
                }
                editIndex = index;
            } else {
                setTimeout(function () {
                    $('#dgCSESelected').datagrid('selectRow', editIndex);
                }, 0);
            }
        }
    }
    function onloadsuccessCSES(data) {
        // Activation  ou désactivation du mode édition via un bouton ?
        $('#dgCSESelected').datagrid('enableCellEditing');
    }
    ;
    function deprecatedonEndEditCSES(index, row) {
        /* traitement particulier d'un editor combobox */
        /*
         var ed = $(this).datagrid('getEditor', {
         index: index,
         field: 'productid'
         });
         row.productname = $(ed.target).combobox('getText');
         *
         */
    }
    function deprecatedgetRowIndex(target) {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function deprecatededitrow(target) {
        // Active le mode edition
        $('#dgCSESelected').datagrid('beginEdit', deprecatedgetRowIndex(target));
    }
    function deprecatedsaverow(target) {
        // Désactive le mode édition
        $('#dgCSESelected').datagrid('endEdit', deprecatedgetRowIndex(target));
    }
</script>