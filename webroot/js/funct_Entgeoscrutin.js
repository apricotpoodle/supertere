/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
function renvoieClef(row) {
    // adapter suivant le nom des champs
    return row.INDI_CLE + '/' + row.ENTG_CLE + '/' + row.ELEC_CLE + '/' + row.SCRU_TOUR;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.ENTG_CLE;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    return getWebRoot() + 'Entgeoscrutin/' + suite;
}
function initDatePickers() {
    //$('#datepicker').datepicker($.datepicker.regional['fr']); // ça marche !
    /*
     * français par défaut ? merci datepicker-fr.js
     * cakePHP fléchit, par défaut, la forme SCRU_DATE en scru-date.
     */
    $('#scru-date').datepicker();
}

function dgAddRound() {
    //alert("Vous ajoutez un tour !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('addround//' + renvoieClef(r));
}

function dgGestionResultatskkk() {
    alert("funct_Entgeoscrutin.js !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('gestionResultats/' + renvoieClef(r));
}

function dgGestionCandidatures() {
    //alert("Vous ajoutez un tour !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('gestionCandidatures/' + renvoieClef(r));
}
function dgChoixUneEngeo() {
    row = dg_getSelected();
    location.assign(nomController('choixFait/' + row.ENTG_CLE));
    //location.assign(history.back() + "/" + clef);

}

function dgGestionCirconscriptions() {
    //alert("Vous ajoutez un tour !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('gestionCirconscriptions/' + renvoieClef(r));
}


//-8<-8<-8<-Début du lancement et traitement du watchdog-8<-8<-8<
// Dans le fichier frm_gene.js sont situées les fonctions :
// La function watchDog().
// La function watchDogEtape()
var
        minutes = 5,
        promise = watchDogRetour(minutes, clickBtnRetourPrecedent)
        .progress(watchDogEtape) // ĉiu'sekund'ag'o= travail à chaque seconde
        ;
// si nécessaire alors lier le reset du WatchDog
// Je préfère que l'appel au reset soit local
$("body") // reset du WatchDog à chaque
        .keypress(watchDogReset)  // appui sur une touche
        .mousemove(watchDogReset) // ou mouvement de la souris
        ;
//-8<-8<-8<-Fin du lancement et traitement du watchdog-8<-8<-8<
