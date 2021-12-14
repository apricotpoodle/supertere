/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
function renvoieClef(row) {
    // adapter suivant le nom des champs
    return row.ELEC_CLE;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.ELEC_LIB;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    return getWebRoot() + 'Elect/' + suite;
}

function initDatePickers() {
    //$('#datepicker').datepicker($.datepicker.regional['fr']); // ça marche !
    /*
     * français par défaut ? merci datepicker-fr.js
     * cakePHP fléchit, par défaut, la forme SCRU_DATE en scru-date.
     */
    $('#scru-date').datepicker();
}