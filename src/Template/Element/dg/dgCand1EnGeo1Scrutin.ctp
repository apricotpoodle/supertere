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
<a href="#" title="<?= isset($titre) ? $titre : "Candidatures de l'entité géogr. courant"; ?>" position="bottom" class="easyui-tooltip">
    <table id="dgCand1Eg1Sc" class="easyui-datagrid"
           data-options="
           iconCls: 'icon-edit',
           singleSelect: true,
           url:'<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'getCand1Eg1Sc',
               '_ext' => 'json'
           ]);
           ?>',
           queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>',
           q: $('#q').val(),

           }
           "
           >
        <thead>
            <tr>
                <th style="width:auto" data-options="field:'CAND_ID',hidden:true">Cand. IID</th>
                <th style="width:auto" data-options="field:'LISTE_DESI',editor:{type:'numberbox',options:{precision:0}}">Liste</th>
                <th style="width:auto" data-options="field:'LISTE_ETIQ',editor:{type:'numberbox',options:{precision:0}}">Étiq. Liste</th>
                <th style="width:auto" data-options="field:'CAND_DESI',editor:{type:'numberbox',options:{precision:0}}">Candidat</th>
                <th style="width:auto" data-options="field:'CAND_ETIQ'">Étiq. Candidat</th>
                <th style="width:auto" data-options="field:'CVS'">Cvs</th>
                <th style="width:auto" data-options="field:'CL__CAND_LIST_TYP_SORT'">Sortant</th>
                <th style="width:auto" data-options="field:'CL__CAND_LIST_LIB'">F</th>
            </tr>
        </thead>
    </table>
</a>

<script>
    /**
     * Renvoie la ligne de candidature sélectionné
     * @return row
     */
    function dgCandGetSelected() {
        var row = $('#dgCand1Eg1Sc').datagrid('getSelected');
        /*for (var i = 0; i < rows.length; i++) {
         var row = rows[i];
         ss.push('<span>' + row.itemid + ":" + row.productid + ":" + row.attr1 + '</span>');
         }
         $.messager.alert('Info', ss.join('<br/>'));
         */
        return row;
    }
    function dgGetSelectionsDgCand() {
        var rows = $('#dgCand1Eg1Sc').datagrid('getSelections');
        /*for (var i = 0; i < rows.length; i++) {
         var row = rows[i];
         ss.push('<span>' + row.itemid + ":" + row.productid + ":" + row.attr1 + '</span>');
         }
         $.messager.alert('Info', ss.join('<br/>'));
         */
        return rows;
    }
    /**
     * renvoie le nombre des candidatures sélectionnées
     * @return {dg_getSelections.rows.length}
     */
    function dg_nbreCandSelected() {
        var rows = dgGetSelectionsDgCand();
        return rows.length;
    }
    function renvoieLibelleCand(row) {
        return row.CAND_DESI;
    }
    function renvoieClefCand(row) {
        return row.CAND_ID;
    }
    function dgSupprCand1Eg1Sc() {
        var effacement = false;
        if (dg_nbreCandSelected() !== 1) {
            alert("Sélection unique attendue !");
        } else {
            rowCand = dgCandGetSelected(); // r= row selected
            if (confirm("Voulez-vous effacer " + renvoieLibelleCand(rowCand) + " ?")) {
                if (confirm("Certain ? certain ?")) {
                    /**
                     * Récupération du Scrutin Courant
                     * dans dg "dgScrutSelected"
                     */
                    $('#dgScrutSelected').datagrid('selectRow', 0);
                    Scrutin = $('#dgScrutSelected').datagrid('getSelected');
                    $('#dgScrutSelected').datagrid('unselectRow', 0);
                    SelTypEnt = Scrutin.TYEN_CODE;
                    TypeElect = Scrutin.TYEL_CODE;
                    SelTypEle = TypeElect.slice(0, 4);
                    if (
                            (SelTypEle === "Régi")
                            || (SelTypEle === "Euro")
                            || ((SelTypEle === "Légi") && (SelTypEnt === "Liste"))
                            ) {
                        effacement = confirm("Attention, vous allez supprimer la liste '" +
                                rowCand.LISTE_DESI +
                                "' pour tous les niveaux de résultat. Voulez-vous continuer ?");
                    } else {
                        effacement = true;
                    }

                    if (effacement) {
                        //alert("coucou à " + rowCand.LISTE_DESI);
                        //alert("clef d'effacement : " + renvoieClefCand(rowCand));
                        window.location.href = nomController('deleteCandEgScrutin/' + renvoieClefCand(rowCand));
                    }

                } else {
                    alert("vous n'êtes pas d'accord");
                }
            } else {
                alert("vous n'êtes pas d'accord");
            }
        }
    }
    function dgAddCand1Eg1Sc() {
        window.location.href = nomController('frmAjoutCandLst');

    }

</script>