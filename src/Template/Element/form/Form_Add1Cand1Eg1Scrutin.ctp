<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
$pathCb = 'combobox' . DS;
/*
 *     <?= $this->element($pathCb . 'cb_entg_cle'); ?>
 *     <?= $this->element($pathCb . 'cb_indi_cle'); ?>
 *     <?= $this->element($pathCb . 'cb_tyeg_code'); ?>
 */
/*
 * Token pour ce formulaire
 */
$kcrsfToken = $this->getRequest()->getParam('_csrfToken');
/*
 * Descritpion texte de nom de liste
 */
$optNomListe = [
    //"disabled" => !$listeNomLibre,
    "required" => true,
        //"autofocus" => $listeNomLibre,
        //"style" => $listeNomLibre ? "width:300px" : "display:none",
        //"label" => [
//        "style" => $listeNomLibre ? "" : "display:none",
//    ]
];
/*
 * Combobox choix d'une étiquette
 */
$urlCbEtiq = $this->Url->build(
        [
            'controller' => $this->name,
            'action' => 'cb_et_pol_cle',
            '_ext' => 'json'
        ]
);

$optCbEtiq = [
    /* Tjs visible
     *     "autofocus" => !$listeNomLibre,
     */
    //"type" => "easyui-combobox",
    "required" => true,
    "style" => "width:120px",
    "class" => "easyui-combobox",
    "url" => "$urlCbEtiq",
    "valueField" => "id",
    "textField" => "text",
    //"hidden" => false,
    "data-options" => "limitToList: false,queryParams: {_csrfToken: '$kcrsfToken'}",
];
$optForm = [
    'valueSources' => [
        'query',
        'context',
    ],
        /*
          'url' => $this->Url->build(
          [
          'controller' => $this->name,
          'action' => 'frmAjoutCandLst',
          //'_ext' => 'json'
          ]
          ),
         * 
         */
];
?>
<div>
    <?= $this->Form->create(null, $optForm); ?>
    <!--?= $this->Form->control("nomListe", $optNomListe); ?-->
    <a href="#" title=" Saisissez ou choisissez un libellé de liste." class="easyui-tooltip">
        <!--?= $this->Form->control("cbetqpol", $optCbEtiq); ?-->
        <!--?= $this->Form->input("cbetqpol", $optCbEtiq); ?-->
        <input id="cbetqpol" class="easyui-combobox form-control" style="width:120px"
               name ="cbetqpol"
               url="<?= $urlCbEtiq; ?>"
               valueField="id" textField="text"
               data-options= "queryParams: {
               _csrfToken: '<?= $kcrsfToken ?>'
               },
               onChange:function(newValue,oldValue){
               // dgSearch();
               },
               limitToList:false,
               "
               required >
    </a>

    <?= $this->Form->submit('Click me'); ?>
    <?= $this->Form->end(); ?>
</div>

