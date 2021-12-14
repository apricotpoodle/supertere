/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

function renvoieClef(row) {
    // adapter suivant le nom des champs
    return row.ENTG_CLE + "/" + row.INDI_CLE;
}
function dg_getPK2String(row) {
    // adapter suivant le nom des champs
    return row.INDI_CLE + "::" + row.ENTG_CLE;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.ENTG_DESI;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    // return window.location.href + '/' + suite;
    // return  suite;
    return getWebRoot() + 'Egcanadd/' + suite;
}
/**
 * Sélection automatique des C.E. par le critère de classement de population
 * @return {undefined}
 */
function dggApply() {
    var $rows = dgg_getSelections();
    var $Indic = $('#cbindiCle').combobox('getValue');
    var $TypEg = $('#cbtyegCode').combobox('getValue');
    //var $BtRaz = $('#sb_raz').switchbutton('options').value;
    if ($rows.length < 1) {
        $.messager.alert("! Attention !", "Vous devez sélectionner une valeur de classification !");
        return false;
    }
    if ($TypEg !== "Ville") {
        $.messager.alert("! Attention !", "vous devez filtrer les villes pour les sélectionner selon un critère de population !");
        return false;
    }
    if ($Indic === "") {
        $.messager.alert("! Attention !", "vous devez sélectionner un indice de Candidature !");
        return false;
    }
    //$.messager.alert('Info', 'Bravo !');
    //
    var ss = [];
    for (var i = 0; i < $rows.length; i++) {
        var row = $rows[i];
        ss.push(row.VACL_VALE);
    }
    // $.messager.alert('Info', $BtRaz + " * " + ss.join(','));
    // on se fout des paramètres
    // window.location.href = nomController('pretraitement/' + $Indic + '/' + $TypEg);
    // window.location.href = nomController();//'index');//$Indic + '/' + $TypEg);
    window.location.href = nomController("SelectAutoVille/" + BtRaz + "/" + $Indic + "/" + $TypEg + "/" + ss.join(','));

}
function dg_AddSelect() {
    if (dg_nbreSelected() === 0) {
        alert("Sélection attendue !");
    } else {
        //r = dg_getSelected(); // r= row selected
        //doEdit('TypeEntite/edit/' + r.TYEN_CODE);
        alert(dg_getSelectionsToString());
        window.location.href = nomController('add/' + dg_getSelectionsToString());
    }
}
