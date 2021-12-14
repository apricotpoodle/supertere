/* 
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
function renvoieClef(row) {
    // adapter suivant le nom des champs
    return row.TYSC_CODE + '/' + row.TYEN_CODE + '/' + row.TYEG_CODE + '/' + row.TYEL_CODE;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.TYFO_CODE + "/" + row.TYCO_CODE;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    return getWebRoot() + 'Telec/' + suite;
}
function initDatePickers() {
    //$('#datepicker').datepicker($.datepicker.regional['fr']); // ça marche !
    /*
     * français par défaut ? merci datepicker-fr.js
     * cakePHP fléchit, par défaut, la forme SCRU_DATE en scru-date.
     */
    //$('#scru-date').datepicker();
}