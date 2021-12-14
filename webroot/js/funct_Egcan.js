/* 
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
function renvoieClef(row) {
    // adapter suivant le nom des champs
    return row.INDI_CLE + "/" + row.ENTG_CLE;
}
function dg_getPK2String(row) {
    // adapter suivant le nom des champs
    return row.INDI_CLE + "::" + row.ENTG_CLE;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return "Circ. de Cand. : " + row.TYEG_CODE + " " + row.ENTG_CODINSEE + " " + row.ENTG_DESI;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    return getWebRoot() + 'Egcan/' + suite;
}
function dg_toggleSelect() {
    if (dg_nbreSelected() === 0) {
        alert("Sélection attendue !");
    } else {
        //r = dg_getSelected(); // r= row selected
        //doEdit('TypeEntite/edit/' + r.TYEN_CODE);
        //alert(nomController('edit/' + renvoieClef(r)));
        window.location.href = nomController('toggleSelect/' + dg_getSelectionsToString());
    }
}
function initDatePickers() {
    //$('#datepicker').datepicker($.datepicker.regional['fr']); // ça marche !
    /*
     * français par défaut ? merci datepicker-fr.js
     * cakePHP fléchit, par défaut, la forme SCRU_DATE en scru-date.
     */
    //$('#scru-date').datepicker();
}