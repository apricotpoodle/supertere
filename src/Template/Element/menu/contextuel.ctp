<?php
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
/**
 * Menu Contextuel de l'application G2TERE
 */
$titres = [
    "Gestion des scrutins",
    "Gestion des hommes politiques",
    "Paramètres - Circ. Élect. …",
    "Paramètres - Étiquettes",
    "Paramètres - Type de…",
    "Paramètres - Scrutin…",
];
$ssmenu0 = [// 1 ligne
    "window.location.href = '" .
    $this->Url->build(['controller' => 'scrut']) . "'"
    => "Gestion Scrutins",
];
$ssmenu1 = [// 4 lignes
    "window.location.href = '" .
    $this->Url->build(['controller' => 'ghopo']) . "'"
    => "Gestion Homme Politique",
];
$ssmenu2 = [// 4 lignes
    "window.location.href = '" .
    $this->Url->build(['controller' => 'engeo']) . "'"
    => "Circ. Élect.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'egcan']) . "'"
    => "Circ. Élect. de Cand.",
    "javascript:alert('À venir…')" => "Circ. Élect. de Candidat. classifiées",
    //"window.location.href = 'rgcec'" => "Circ. Élect. de Candidat. classifiées",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'trage']) . "'"
    => "Regr. Géog. Circ. Élect.",
];
$ssmenu3 = [// 3 lignes
    "window.location.href = '" .
    $this->Url->build(['controller' => 'etpol']) . "'"
    => "Étiq. Pol.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'venti']) . "'"
    => "Ventil. d'étiq.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'reget']) . "'"
    => "Regroup. des étiq.",
];
$ssmenu4 = [// 12 lignes
    "window.location.href = '" .
    $this->Url->build(['controller' => 'incan']) . "'"
    => "Indices de Candidature",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'vcgeo']) . "'"
    => "Val. de Classif.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tenti']) . "'"
    => "… Entité Candidate",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tscru']) . "'"
    => "… Scrutin",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tenge']) . "'"
    => "… Circ. élect.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'telec']) . "'"
    => "… Élection",
    "javascript:alert('À venir…')" => "… Circ. du conseil",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tfonc']) . "'"
    => "… Fonction",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'trapp']) . "'"
    => "… Rappel",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tratt']) . "'"
    => "… Regroup. Géog.",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tdeci']) . "'"
    => "… Décision",
    "window.location.href = '" .
    $this->Url->build(['controller' => 'tclas']) . "'"
    => "… Classification",
];
$ssmenu5 = [// 6 lignes
//!\ Les espaces de début de lignes différencient la clef => ne pas supprimer !
    "javascript:alert('Dans Param Type de… Scrutin')" => "Suppr. d'un scrutin",
    " javascript:alert('Dans Param Type de… Scrutin')" => "Réinit. d'un scrutin",
    "  javascript:alert('Dans Param Type de… Scrutin')" => "Valid. d'un scrutin",
    "   javascript:alert('Dans Param Type de… Scrutin')" => "Activ. d'un scrutin",
    "javascript:alert('À venir…')" => "Homonymie - Transfert de Candidature",
    " javascript:alert('À venir…')" => "Suppr. homme politique sans candidature",
];

$elmtssmenu = "menu" . DS . "ssmenu2";
/**
 * Tableaux de paramètres pour l'élément affichant un sous menu
 */
$arrsm0 = ["ssmenu" => $ssmenu0, "sstitre" => $titres[0]];
$arrsm1 = ["ssmenu" => $ssmenu1, "sstitre" => $titres[1]];
$arrsm2 = ["ssmenu" => $ssmenu2, "sstitre" => $titres[2]];
$arrsm3 = ["ssmenu" => $ssmenu3, "sstitre" => $titres[3]];
$arrsm4 = ["ssmenu" => $ssmenu4, "sstitre" => $titres[4]];
$arrsm5 = ["ssmenu" => $ssmenu5, "sstitre" => $titres[5]];
?>
<div id="mm" class="easyui-menu" style="width:250px;">
    <?= $this->element($elmtssmenu, $arrsm0); ?>
    <?= $this->element($elmtssmenu, $arrsm1); ?>
    <?= $this->element($elmtssmenu, $arrsm2); ?>
    <?= $this->element($elmtssmenu, $arrsm3); ?>
    <?= $this->element($elmtssmenu, $arrsm4); ?>
    <?= $this->element($elmtssmenu, $arrsm5); ?>
    <div class="menu-sep"></div>
    <div onclick="javascript:alert('À venir…')" >Log out</div>
</div>
