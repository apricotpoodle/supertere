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
    return row.ENTG_CLE;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.ENTG_DESI;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    return getWebRoot() + 'engeo/' + suite;
}
function dgChoixUneEngeo() {
    clef = renvoieClef(dg_getSelected());
    location.assign(nomController('choixFait/' + clef));
    //location.assign(history.back() + "/" + clef);

}
function initDatePickers() {
    //$('#datepicker').datepicker($.datepicker.regional['fr']); // ça marche !
    /*
     * français par défaut ? merci datepicker-fr.js
     * cakePHP fléchit, par défaut, la forme SCRU_DATE en scru-date.
     */
    //$('#scru-date').datepicker();
}