var
        $$ = function (id) {
            return document.getElementById(id);
        },
        csrf = $("#csrftoken").val(),
        container = $$('hot1'),
        // parentContainer = container.parent(),
        exampleConsole = $$('example1console'),
        autosave = $$('autosave'),
        load = $$('load'),
        save = $$('save'),
        autosaveNotification,
        hotColWidths = [20, 20, 20, 20, 20, 20, 20]
        ,
        hotColHeaders = [
            "Modif.", "erreur",
            "ID", "LISTE_NO", "CAND_NO",
            "Liste", "Étiquette", "Candidature", "Étiquette", "Cvs",
            "Sortant", "Obs.", "Notes"
        ],
        hotHiddenColumns = {columns: [0, 1], indicators: false},
        hotColumns = [
            {readOnly: true, data: "modification"},
            {visible: false, readOnly: true, data: "erreur", renderer: errorRenderer},
            {readOnly: true, data: "CAND_ID"},
            {readOnly: true, data: "LISTE_NO"},
            {readOnly: true, data: "CAND_NO"},
            {readOnly: false, data: "LISTE_DESI"},
            {readOnly: false, data: "LISTE_ETIQ"},
            {readOnly: false, data: "CAND_DESI"},
            {readOnly: false, data: "CAND_ETIQ"},
            {readOnly: false, data: "CVS"},
            {readOnly: false, data: "CAND_LIST_TYP_SORT"},
            {readOnly: false, data: "CAND_LIST_LIB"},
            {readOnly: false, data: "CAND_LIB_2"},
        ],
        hot,
        hot = new Handsontable(container, {
            // liste des candidatures
            // language: 'fr-FR',
            licenseKey: 'non-commercial-and-evaluation',
            minSpareRows: 1, // lig. en sus de startRows.
            minSpareCols: 3, // col. en sus de startCols.
            startRows: 4, // 4 candidatures par défaut
            startCols: 8, // 7 col. Par défaut
            rowHeaders: false, // pas de nom de ligne
            colHeaders: hotColHeaders, // un nom pour chaque colonne
            columns: hotColumns, // ignore options startCols, minCols, maxCols
            hiddenColumns: hotHiddenColumns,
            afterInit: function () {
                hot1AfterInit();
            },
            afterChange: function (change, source) {
                hot1AfterChange(change, source);
            }
        }),
        pb = $("#pbid");


function progress_avirer() {
    alert("fonction progress");
    var v = pb.progressbar('value'); // || 0;
    pb.progressbar("value", v + 1);
    if (v < 99) {
        setTimeout(progress, 100);
    }
}

/**
 * Toute Action devant être effectuée à la fin de l'initialisation de hot1
 * @return {undefined}
 */
function hot1AfterInit() {
    /* datumŝarĝo */
    /* datumsxargxo */
    hot1LoadData();
    //Watchdog2scrut();
}
function hot1AfterChange(change, source) {
    if (source === 'loadData') {
        return; // don't save this change
    }
    if (!autosave.checked) {
        return; // don't save this change
    }
    saveChangeData(change);
}
/**
 * https://api.jquery.com/jQuery.ajax/
 * https://api.jquery.com/jQuery.post/
 * 
 * @return {undefined}
 */
function hot1LoadData() {
    // https://api.jquery.com/jQuery.ajax/#jqXHR
    $.post({// si pas d'envoi de data => GET
        url: 'hot1load.json', // extension JSON =>réponse au format JSON
        data: {_csrfToken: csrf},
        success: function (data, textStatus, jqXHR) {
            //alert("datumŝarĝo");
            successHot1LoadData(data);
        },
        fail: function (jqXHR, textStatus, errorThrown) {
            errorHot1LoadData(jqXHR, textStatus, errorThrown);
        },
        always: function (jqXHR, textStatus) {
            //       btnRetour = document.getElementById("btnretourindex");
            //       btnRetour.click();
        }
    });
}
/**
 * Fonction définissant l'aspect de la colonne Erreur dans la grille Handsontable
 */
function errorRenderer(instance, td, row, col, prop, value, cellProperties) {

    Handsontable.renderers.TextRenderer.apply(this, arguments);
    var valeur = Handsontable.helper.stringify(value);
    if (valeur === "1") {
        td.style.background = 'red';
        td.style.color = 'red';
    }
    return td;
}

function successHot1LoadData(data) {
    /** JSON data format description
     *
     * {
     *   answ :{
     *      "result":"OK",
     *      "data":[[val1,val2…],[val1,…]]
     *   }
     * }
     *
     **/
    //alert(data);
    //var data = JSON.parse(res.response);// Déjà au format JSON
    hot.loadData(data.data);
    // alert(data.response);
    msg = 'Data loaded !';
    //msgExampleConsole(msg);
}
function errorLoadAllData(jqXHR, textStatus, errorThrown) {
    /** JSON data format description
     *
     * {
     *   answ :{
     *      "result":"OK",
     *      "data":[[val1,val2…],[val1,…]]
     *   }
     * }
     *
     **/
    alert("Une erreur s'est produite ! ");
    alert(textStatus);
    alert(jqXHR.statusText);
    alert(jqXHR.getAllResponseHeaders())
    /*
     alert(data.message);
     alert(data.url);
     alert(data.code);
     alert(data.file);
     alert(data.ligne);
     */
}
/*
 Handsontable.dom.addEvent(autosave, 'click', function () {
 msgAutoSave();
 });
 Handsontable.dom.addEvent(load, 'click', function () {
 loadAllData();
 });
 Handsontable.dom.addEvent(save, 'click', function () {
 // save all cell's data
 saveAllData();
 });
 function saveAllData() {
 $.post(
 {
 //      type: "POST",
 url: 'save.json',
 data:
 {
 _csrfToken: csrf
 ,
 data: hot.getData()
 }
 ,
 success: function (res) {
 successSaveAllData(res);
 },
 error: function (res) {
 errorSaveAllData(res);
 }
 }
 );
 }
 function saveChangeData(change) {
 $.post(
 {
 //      type: "POST",
 url: 'afterchange.json',
 data: {_csrfToken: csrf, data: change},
 success: function (res) {
 successSaveChangeData(res, change);
 },
 error: function (res) {
 errorSaveAllData(res);
 }
 }
 );
 }
 function msgExampleConsole(msg = "") {
 clearTimeout(autosaveNotification);
 exampleConsole.innerText = msg;
 //autosaveNotification = setTimeout(msgAutoSave(), 3000);
 sleepAsync(2000).then(
 () => {
 //autosaveNotification = setTimeout(msgAutoSave(), 3000);
 msgAutoSave();
 }
 );
 }
 function msgAutoSave() {
 if (autosave.checked) {
 exampleConsole.innerText = 'Changes will be autosaved';
 } else {
 exampleConsole.innerText = 'Changes will not be autosaved';
 }
 }
 function sleepAsync(ms) {
 return new Promise(resolve => setTimeout(resolve, ms));
 }
 
 function successSaveAllData(res) {
 msg = 'Data saved !';
 msgExampleConsole(msg);
 }
 function successSaveChangeData(res, change) {
 var msg = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
 msgExampleConsole(msg);
 //   exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
 
 }
 */

//-8<-8<-8<-Début du lancement et traitement du watchdog--8<-8<-8<
// Dans le fichier frm_gene.js sont situées les fonctions : 
// watchDog().
// watchDogEtape()
var
        minutes = 14.5,
        promise = watchDogRetour(minutes, clickBtnRetourIndex)
        .progress(watchDogEtape) // ĉiu'sekund'ag'o= travail à chaque seconde
        ;
// si nécessaire alors lier le reset du WatchDog
// Je préfère que l'appel au reset soit local
$("body") // reset du WatchDog à chaque
        .keypress(watchDogReset)  // appui sur une touche
        .mousemove(watchDogReset) // ou mouvement de la souris
        ;
//-8<-8<-8<-Fin du lancement et traitement du watchdog--8<-8<-8<
