var // ttes les variables globales…
        timeRefresh = 0,
        watchDogMaxMinutes = 14, // attente de 14 minutes max.
        watchDogCount = watchDogMaxMinutes * 60, // Le compteur de secondes
        dateFormat = "dd/mm/yy", // format de date français
        /*
         * select a date range from 2 datepickers
         *
         * html part
         * <label for="from">From</label>
         * <input type="text" id="from" name="from">
         * <label for="to">to</label>
         * <input type="text" id="to" name="to">
         */
        from = $("#from") // changer seulement #from en nouvel id ?
        .datepicker({defaultDate: "+1w", numberOfMonths: 3})
        .on("change", function () {
            to.datepicker("option", "minDate", getDate(this));
        }),
        to = $("#to") // changer seulement #to en nouvel id ?
        .datepicker({defaultDate: "+1w", numberOfMonths: 3})
        .on("change", function () {
            from.datepicker("option", "maxDate", getDate(this));
        })
        ;
$(document).ready(function () {
// Toute «class datepicker» sera associée à un datepicker…
//$(".datepicker").datepicker($.datepicker.regional[ "fr" ]);
//initDatePickers(); inutile avec la ligne ci dessous
    $(".datepicker").datepicker();
    $(document).bind('contextmenu', function (e) {
        $('#mm').menu('show', {
            left: e.pageX,
            top: e.pageY
        });
        return false;
    });
});
/**
 * Renvoie la colonne ELEC_LIB
 * @param {type} value
 * @param {type} row
 * @param {type} index
 * @return {unresolved}
 */
function formatterElectionElecLib(value, row, index) {
    if (row.election) {
        return row.election.ELEC_LIB;
    } else {
        return value;
    }
}
function formatterElectionTyelCode(value, row, index) {
    if (row.election) {
        return row.election.TYEL_CODE;
    } else {
        return value;
    }
}
function formatterElectionTyscCode(value, row, index) {
    if (row.election) {
        return row.election.TYSC_CODE;
    } else {
        return value;
    }
}
function formatterEngeoEntgLibelle(value, row, index) {
    if (row.engeo) {
        return row.engeo.ENTG_LIBELLE;
    } else {
        return value;
    }
}
function formatterEngeoEntgDesi(value, row, index) {
    if (row.engeo) {
        return row.engeo.ENTG_DESI;
    } else {
        return value;
    }
}
function formatterEngeoEntgCodinsee(value, row, index) {
    if (row.engeo) {
        return row.engeo.ENTG_CODINSEE;
    } else {
        return value;
    }
}
function formatterEngeoTyegCode(value, row, index) {
    if (row.engeo) {
        return row.engeo.TYEG_CODE;
    } else {
        return value;
    }
}
function formatterEasyUIDate(date) {
    var y = date.getFullYear();
    var m = date.getMonth();
    var d = date.getDate();
    return d + '/' + m + '/' + y;
}
/**
 * Ajout d'un séparateur à chaque groupe de 3 chiffres
 *
 * https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat
 *
 * @param {*} nb  le nombre à formater avec des séprateurs
 * @param {*} sep le caractère utilisé pour séparer les groupes de 3 chiffres
 * @returns
 */
 function format_nombre_separateur (nStr, sep = ' ') {
    return new Intl.NumberFormat().format(nStr);
    // if (sep === undefined) {
    //     sep = ' '; // La France Môssieur ! La France !
    // }
    // nStr += '';
    // x = nStr.split(',');
    // x1 = x[0];
    // x2 = x.length > 1 ? ',' + x[1] : '';
    // var rgx = /(\d+)(\d{3})/;
    // while (rgx.test(x1)) {
    //     x1 = x1.replace(rgx, '$1' + sep + '$2');
    // }
    // return x1 + x2;
}

/**
 * Reformate correctement des pourcentages nuls, nuls, nuls
 * @param {*} nStr  raw integer
 * @returns  string formatted as a percent
 */
function format_percent(awful_percentage) {
    var result = new Intl.NumberFormat(
        "fr-FR",
        {
            style: 'percent',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }
    )
    .format(
        awful_percentage
        .replace(',','.')
        .replace('%','')/100
    );
    return result;
}

/**
 * Conversion d'une date format ISO à un format long
 *
 * Considérons la date ISO suivante : "2020-02-05T16:30:41.392Z"
 * Disons vouloir l'afficher en un format pour utilisateur italien ou américain
 *
 *
 * @param {*} isoString "2020-02-05T16:30:41.392Z"
 * @param {*} locale "fr-FR"
 * @returns "02 février 2020" pour le format français par défaut.
 */
function ISOtoLongDate(isoString, locale = "fr-FR") {
    const options  = { month: "long", day: "numeric", year: "numeric" };
    const date     = new Date(isoString);
    const longDate = new Intl.DateTimeFormat(locale, options).format(date);
    return longDate;
}

function parserEasyUIDate(s) {
    if (!s)
        return new Date();
    var ss = (s.split('-'));
    var y = parseInt(ss[0], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[2], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
    } else {
        return new Date();
    }
}

/**
 *
 * @return {undefined}
 */
function gSearch() { // general search
    dgSearch();
    dggSearch();
    /*
     $('#dg').datagrid({
     queryParams: {
     _csrfToken: $('#csrftoken').val(),
     q: $('#q').val(), // rech. générale
     ENTG_CLE: $('#cbentgCle').val(),
     INDI_CLE: $('#cbindiCle').val(),
     SCRU_TOUR: $('#cbscruTour').val(),
     TYEG_CODE: $('#cbtyegCode').val(),
     TYEL_CODE: $('#cbtyelCode').val(),
     TYRT_CODE: $('#cbtyrtCode').val(),
     TYSC_CODE: $('#cbtyscCode').val(),
     VENT_CODE: $('#cbventCode').val(),
     ENTG_SELECT: $('#cbselect').val()//,
     /*            ENTG_DESI: $('#designation').val(),
     /*            exportBase: $('#cb_SaisiOuVide').val(),
     /*            importBase: $('#cbImportBase').val()
     }
     });
     $('#dgg').datagrid({
     queryParams: {
     _csrfToken: $('#csrftoken').val(),
     q: $('#q').val(), // rech. générale
     ENTG_CLE: $('#cbentgCle').val(),
     INDI_CLE: $('#cbindiCle').val(),
     SCRU_TOUR: $('#cbscruTour').val(),
     TYEG_CODE: $('#cbtyegCode').val(),
     TYEL_CODE: $('#cbtyelCode').val(),
     TYCL_CODE: $('#cbtyclCode').val(),
     TYRT_CODE: $('#cbtyrtCode').val(),
     TYSC_CODE: $('#cbtyscCode').val(),
     VENT_CODE: $('#cbventCode').val(),
     ENTG_SELECT: $('#cbselect').val()//,
     /*            ENTG_DESI: $('#designation').val(),
     /*            exportBase: $('#cb_SaisiOuVide').val(),
     /*            importBase: $('#cbImportBase').val()
     }
     });
     */
}
function dgSearch() {
    $('#dg').datagrid({
        queryParams: {
            _csrfToken: $('#csrfToken').val(),
            q: $('#q').val(), // rech. générale
            ENTG_CLE: $('#cbentgCle').val(),
            INDI_CLE: $('#cbindiCle').val(),
            SCRU_TOUR: $('#cbscruTour').val(),
            TYEG_CODE: $('#cbtyegCode').val(),
            TYEL_CODE: $('#cbtyelCode').val(),
            TYCL_CODE: $('#cbtyclCode').val(),
            TYRT_CODE: $('#cbtyrtCode').val(),
            TYSC_CODE: $('#cbtyscCode').val(),
            VENT_CODE: $('#cbventCode').val(),
            ENTG_SELECT: $('#cbselect').val()//,
                    /*            ENTG_DESI: $('#designation').val(),*/
                    /*            exportBase: $('#cb_SaisiOuVide').val(),*/
                    /*            importBase: $('#cbImportBase').val()*/
        }
    });
}
function dggSearch() {
    $('#dgg').datagrid({
        queryParams: {
            _csrfToken: $('#csrftoken').val(),
            q: $('#q').val(), // rech. générale
            ENTG_CLE: $('#cbentgCle').val(),
            INDI_CLE: $('#cbindiCle').val(),
            SCRU_TOUR: $('#cbscruTour').val(),
            TYEG_CODE: $('#cbtyegCode').val(),
            TYEL_CODE: $('#cbtyelCode').val(),
            TYCL_CODE: $('#cbtyclCode').val(),
            TYRT_CODE: $('#cbtyrtCode').val(),
            TYSC_CODE: $('#cbtyscCode').val(),
            VENT_CODE: $('#cbventCode').val(),
            ENTG_SELECT: $('#cbselect').val()//,
                    /*            ENTG_DESI: $('#designation').val(),*/
                    /*            exportBase: $('#cb_SaisiOuVide').val(),*/
                    /*            importBase: $('#cbImportBase').val()*/
        }
    });
}
function dg_getSelected() {
    var row = $('#dg').datagrid('getSelected');
    /*if (row) {
     $.messager.alert(
     'Coucou', row.ENTG_CODINSEE + ":" + row.TYEG_CODE + ":" + row.ENTG_DESI
     );
     }*/
    /* alert(row.ELEC_CLE); */
    if (row === null) {
        alert("Vous n'avez rien sélectionné !");
    }

    return row;
}
function dgg_getSelections() {
// var ss = [];
    var rows = $('#dgg').datagrid('getSelections');
    //if (rows === null) {
    //        alert("Vous n'avez rien sélectionné !");
    // }
    return rows;
    /*
     for (var i = 0; i < rows.length; i++) {
     var row = rows[i];
     //ss.push('<span>' + row.VACL_VALE + row.VACL_LIBE + '</span>');
     //ss.push('<span>' + row.VACL_VALE + '</span>');
     ss.push(row.VACL_VALE);
     }
     //$.messager.alert('Info', ss.join('<br/>'));
     //$.messager.alert('Info', ss.join(','));
     return ss.join(',');
     */
}
/**
 * Renvoie le tableau des
 * @return {Array}
 */
function dg_getSelections() {
// var ss = [];
    var rows = $('#dg').datagrid('getSelections');
    /*for (var i = 0; i < rows.length; i++) {
     var row = rows[i];
     ss.push('<span>' + row.itemid + ":" + row.productid + ":" + row.attr1 + '</span>');
     }
     $.messager.alert('Info', ss.join('<br/>'));
     */
    return rows;
}
function dg_getSelectionsToString() {
    var ss = [];
    var rows = dg_getSelections();
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        ss.push(dg_getPK2String(row));
    }
//$.messager.alert('Info', ss.join('<br/>'));

    return ss.join(",");
}
/**
 * Renvoie vrai si plusieurs lignes sont sélectionnées
 * @return {Boolean}
 */
function dg_multiselection() {
    var nbre = dg_nbreSelected();
    return (nbre > 1);
}
/**
 * renvoie le nombre des articles sélectionnés
 * @return {dg_getSelections.rows.length}
 */
function dg_nbreSelected() {
    var rows = dg_getSelections();
    return rows.length;
}

/**
 *
 * @return {undefined}
 */
function rafraichir_dg() {
    if (timeRefresh > 0) {
        dgSearch();
        // toutes les x  millisecondes rafraîchir
        setTimeout("rafraichir_dg()", 1000); //500000);
    }
}

function doShowMenu() {
    $('#mm').menu('show', {
        left: 200,
        top: 100
    });
}

function dgEdit() {
    if (dg_nbreSelected() != 1) {
        alert("Sélection unique attendue !");
    } else {
        r = dg_getSelected(); // r= row selected
        //doEdit('TypeEntite/edit/' + r.TYEN_CODE);
        //alert(nomController('edit/' + renvoieClef(r)));
        window.location.href = nomController('edit/' + renvoieClef(r));
    }
}
function dgDelete() {
    if (dg_nbreSelected() != 1) {
        alert("Sélection unique attendue !");
    } else {
        r = dg_getSelected(); // r= row selected
        if (confirm("Voulez-vous effacer " + renvoieLibelle(r) + " ?")) {
            if (confirm("Certain ? certain ?")) {
//alert("clef d'effacement : " + renvoieClef(r))
                window.location.href = nomController('delete/' + renvoieClef(r));
            } else {
                alert("vous n'êtes pas d'accord")
            }
        } else {
            alert("vous n'êtes pas d'accord")
        }
    }
}
function dgDuplicate() {
    if (dg_nbreSelected() != 1) {
        alert("Sélection unique attendue !");
    } else {
        r = dg_getSelected(); // r= row selected
        //doEdit('TypeEntite/edit/' + r.TYEN_CODE);
        //alert(nomController('edit/' + renvoieClef(r)));
        window.location.href = nomController('duplicate/' + renvoieClef(r));
    }
}
function getDate(element) {
    var date;
    try {
        date = $.datepicker.parseDate(dateFormat, element.value);
    } catch (error) {
        date = null;
    }
    return date;
}

function resetContent() {
    window.location.reload();
}
/**
 * Retourne à l'url appelante
 * @return {undefined}
 */
function retourAUrlAppelante() {
    // retour à url appelante
    window.location.href = document.referrer; // your previous url
}
/**
 * renvoie la seule partie de l'url correspondant à la racine web
 * par exemple : http://localhost/g2tere pour g2tere en localhoqt
 * @return {String}
 */
function getWebRoot() {
    // https://www.w3schools.com/js/js_window_location.asp
    // The window.location object can be written without the window prefix.
    // Some examples:
    // window.location.href returns the href (URL) of the current page
    // window.location.hostname returns the domain name of the web host
    // window.location.pathname returns the path and filename of the current page
    // window.location.protocol returns the web protocol used (http: or https:)
    // window.location.assign() loads a new document

    webroot  = "";
    str_href = window.location.href;
    str_host = window.location.hostname;
    str_prot = window.location.protocol;
    str_path = window.location.pathname;

    // console.log(">host getwWebroot");
    // console.log("hostname");
    // console.log(window.location.hostname);
    // console.log("pathname");
    // console.log(window.location.pathname);
    // console.log("protocol");
    // console.log(window.location.protocol);
    // console.log("<host getwWebroot");
    // alert("getWebRoot");
    // http://localhost/g2tere/engeo/choix#
    arr_href = str_href.split("//");
//    http     = arr_href[0]; // protocol
    lhref    = arr_href[1];
    ss       = lhref.split("/"); // localhost/g2tere/etc
//    ss[1]    = (ss[0] == "localhost" ) ? ss[1] : "";
    switch(ss[0]){
        case "localhost":
        case "websrv10":
        break;
        default:
        ss[1] = "";
    }
    webroot  = str_prot + "//" + ss[0] + "/"+ ((ss[1] == "" ) ? "": ss[1] +"/");
    // console.log("str_prot=["+str_prot+"]");
    // console.log("ss[0]=["+ss[0]+"]");
    // console.log("ss[1]=["+ss[1]+"]");
    console.log("hostname=["+str_host+"]");
    console.log("[" + webroot + "]" );
    // alert("getWebRoot");
    return webroot;
}
/**
 * Véritable Fonction Asynchrone
 * Usage : sleepAsync(2000).then(
 *              () => {
 *              // action à effectuer
 *          //autosaveNotification = setTimeout(msgAutoSave(), 3000);
 *          msgAutoSave();
 *      }
 * )
 * @param {int} ms
 * @return {Promise}
 *
 */
function sleepAsync(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
/**
 * Retourne sur l'index du Contrôleur Courant
 *
 * @returns {undefined}
 */
function clickBtnRetourIndex() {
    btnRetour = document.getElementById("btnretourindex");
    btnRetour.click();
}
/**
 * Retourne à la page appelante
 *
 * @returns {undefined}
 */
function clickBtnRetourPrecedent() {
    btnRetour = document.getElementById("btnRetourPrecedent");
    btnRetour.click();
}
function watchDogSet(minutes) {
    watchDogMaxMinutes = minutes;
    watchDogReset();
}
function watchDogReset() {
    watchDogCount = watchDogMaxMinutes * 60;
}

/**
 * Retour automatique au menu Gestion Scrutin
 * @return {Promise}
 */
function watchDogRetour(minutes, fct_retour) {
    var dfd = $.Deferred();
    watchDogSet(minutes);
    watchDogCount = minutes * 60;
//    alert("watchDogRetour " + watchDogCount);
    var intervalId = setInterval(function () {
        dfd.notify(watchDogCount--);
        if (watchDogCount <= 0) {
            clearInterval(intervalId);
            fct_retour();
        }
    }, 1000);
    return dfd.promise();
}
;
function watchDogEtape(i) {
    console.log("watchDog : " + i);
}
