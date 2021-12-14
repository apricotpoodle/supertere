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
<a href="#" title="<?= isset($titre) ? $titre : "Circ. courante"; ?>" class="easyui-tooltip">
    <table id="dgEnGeoSelected" class="easyui-datagrid"
           data-options=
           "
           loadMsg:'Veuillez Patienter…',
           emptyMsg:'Aucune Donnée…',

           rownumber:false,
           singleSelect:true,

           url:'<?=
           $this->Url->build([
               'controller' => $this->name,
               'action' => 'getengeoselected',
               '_ext' => 'json'
           ]);
           ?>',
           fitColumns:true,
           singleSelect:true,
           queryParams: {
           _csrfToken: '<?= $this->getRequest()->getParam('_csrfToken') ?>',
           q: $('#q').val(),

           }
           "
           >
        <thead>
            <tr>
                <th style="width:auto" data-options="field:'ENTG_CLE'">Clef</th>
                <th style="width:auto" data-options="field:'TYEG_CODE'">Type</th>
                <th style="width:auto" data-options="field:'ENTG_DESI'">Libellé</th>
                <th style="width:auto" data-options="field:'ENTG_CODINSEE'">INSEE</th>
            </tr>
        </thead>
    </table>
</a>
