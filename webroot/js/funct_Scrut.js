/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */
function renvoieClef(row) {
    // adapter suivant le nom des champs
    // alert(row.ELEC_CLE + '/' + row.SCRU_TOUR);
    // console.log(row.ELEC_CLE + '/' + row.SCRU_TOUR);
    return row.ELEC_CLE + '/' + row.SCRU_TOUR;
}
function renvoieLibelle(row) {
    // adapter suivant le nom des champs
    return row.ELEC_CLE + '/' + row.SCRU_TOUR;
}
function nomController(suite = '') {
    // adapter suivant le nom du contrôleur
    // console.log(getWebRoot()            // + 'scrut/'            + suite);
    return getWebRoot()
            + 'scrut/'
            + suite;
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
function dgAddTour2() {
// https://api.jquery.com/jQuery.ajax/
// https://api.jquery.com/jQuery.post/
    // alert("Lancement ajout tour 02");
    var jqxhr = $.post({
        url: "addtour2"
        , data: {
            _csrfToken: $("#csrf").val(),
            SCRU_DATE: $("#scru-date").val()
        }
        , success: function (data, textStatus, jqXHR) {
            // alert("Ajout du tour 02 censé être effectif !");
            switch (jqXHR.status) {
                case 205:
                    resetContent();
                    break;
                default:
                    btnRetour = document.getElementById("btnretourindex");
                    btnRetour.click();
            }
        }
        , error: function (jqXHR, textStatus, errorThrown) {
            msg = textStatus
                + " [" + jqXHR.status + "] "
                + "(" + jqXHR.statusText + ")",
                /*
                    alert(
                    textStatus
                    + " [" + jqXHR.status + "] "
                    + "(" + jqXHR.statusText + ")"
                    );
                    */
            resetContent();
        }
        /*
         , complete: function (jqXHR, textStatus) {
         // exécution après success ou error
         }
         */
    });
}

function dgGestionResultats() {
    // alert("funct_Scrut.js !");
    r = dg_getSelected(); // r= row selected
    console.log(nomController('gestionResultats/' + renvoieClef(r)));
    window.location.href = nomController('gestionResultats/' + renvoieClef(r));
    //window.location.href = '//g2tere';
}

function dgGestionCandidatures() {
//alert("Vous ajoutez un tour !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('gestionCandidatures/' + renvoieClef(r));
}

function dgGestionCirconscriptions() {
//alert("Vous ajoutez un tour !");
    r = dg_getSelected(); // r= row selected
    window.location.href = nomController('gestionCirconscriptions/' + renvoieClef(r));
}
function dgModifResultats() {
    // alert(' passe par ici ! dgModifResultats()');
    /* Quelques constantes plus rapides à écrire */
    /* Noms des "datagrid" */
    DGC = '#dgCSESelected'; // kandidatablo
    DGR = '#dgRSESelected'; // rezultablo
    DGS = '#dgScrutSelected'; // rezult
    DGE = '#dgEnGeoSelected';

    /* Quelques fonctions de datagrid */
    FGC = 'getChanges';
    FGD = 'getData';

    SFC = 'created';
    SFU = 'updated';
    SFD = 'deleted';

    /* Y a_t_il eu au moins un changement ? */
    /*
     * deux dg sont à vérifier
     * id="dgRSESelected" pour les résultats du scrutin de l'EG sélectionnée
     * id="dgCSESelected" pour les candidatures du scrutin l'EG sélectionnée
     *
     * method
     *  getChanges	type	Get changed rows since the last commit.
     *                          The type parameter indicate which type
     *                          changed rows, possible value is:
     *                          inserted,deleted,updated,etc.
     *
     *                          When the type parameter is not assigned,
     *                          return all changed rows.
     */
    modifsCSES = $('#dgCSESelected').datagrid('getChanges');
    modifsRSES = $('#dgRSESelected').datagrid('getChanges');
    if ((modifsCSES.length + modifsRSES.length) <= 0)
    {
        /* Aucun changement détecté
         * Retour à l'index
         */
        window.location.replace(nomController()); // fonction index par défaut
    } else
    {
        /*  au moins un changement est détecté */
        //
        // Assign handlers immediately after making the request,
        // and remember the jqxhr object for this request
        // document.getElementsByName("csrfToken").value
        //
        // alert($('#csrfToken').val());
        // alert($('meta[name="_csrfToken"]').attr('content'));
        var jqxhr = $.post({
            url: nomController('OkClickFrmResultatScrutin')
            , data: {
                _csrfToken: $("#csrfToken").val(),
                //_csrfToken: getCookie("csrftoken"),
                /*
                 * modifsRSES: modifsRSES, il vaut mieux tout importer
                 * Pour cela utiliser une méthode de datagrid fournissant
                 * getData : toutes les lignes.
                 * getRows : uniquement les lignes affichées.
                 */
                DSCRU: $(DGS).datagrid(FGD),
                DEGEO: $(DGE).datagrid(FGD),
                DRSES: $(DGR).datagrid(FGD), // Dat'um'o'j
                KRSES: $(DGR).datagrid(FGC, SFC), // Datumoj kreitaj
                MRSES: $(DGR).datagrid(FGC, SFU), // Datumoj modifitaj
                FRSES: $(DGR).datagrid(FGC, SFD), // Datumoj forviŝitaj

                DCSES: $(DGC).datagrid(FGD), // Dat'um'o'j
                KCSES: $(DGC).datagrid(FGC, SFC), // Datumoj kreitaj
                MCSES: $(DGC).datagrid(FGC, SFU), // Datumoj modifitaj
                FCSES: $(DGC).datagrid(FGC, SFD), // Datumoj forviŝitaj
            }
            // , done: function (data, textStatus, jqXHR) {
            , success: function (data, textStatus, jqXHR) {
                /*
                 * ici on joue principalement avec data
                 */
                // switch (jqXHR.status) {
                //     case 200:
                //         break;
                //     case 299:
                //         // saisie correcte mais incomplète ou incohérence
                //         // entre scru et CAND
                //         break;
                //     default:
                // }
                /*
                 * Simple retour à l'index,
                 * Après vérification et application,
                 * via php,
                 * des modifications.
                 */
                // Décommenter pour le mode production
                // window.location.replace(nomController()); // fonction index par défaut
            }
            // , fail: function (jqXHR, textStatus, errorThrown) {
            , error: function (jqXHR, textStatus, errorThrown) {
                // windows.location.reload();
                /* Ici on joue principalement avec errorThrown */
                /*
                 * nous restons sur l'écran de saisie des modifications
                 * permettant de ressaisir ou d'abandonner,
                 * après vérification et refus des modifications.
                 */
                // switch (jqXHR.status) {
                //     case 409:
                //         /*
                //          * 4×× CLIENT ERROR
                //          * 409 CONFLICT
                //          * The request could not be completed due to a conflict
                //          * with the current state of the target resource.
                //          * This code is used in situations where the user
                //          * might be able to resolve the conflict and
                //          * resubmit the request.
                //          */
                //         // saisie correcte mais incomplète ou incohérence
                //         // entre scru et CAND
                //         break;
                //     default:
                // }
            }
            // , always: function (jqXHR, textStatus) {
            , complete: function (jqXHR, textStatus) {
                // exécution après success ou error
                //
                // ici on joue principalement avec ce qui reste soit
                // jqXHR, textStatus

                msg = textStatus
                        // + " /" + jqXHR.responseText + "/ "
                        + " [" + jqXHR.status + "] "
                        + "(" + jqXHR.statusText + ")"
                        ;
                alert(msg);
            }

        });

    }
}

function dgModifResultatsLst() {
    // alert(' passe par ici ! dgModifResultats()');
    /* Quelques constantes plus rapides à écrire */
    /* Noms des "datagrid" */
    DGC = '#dgCSESelected'; // kandidatablo
    DGR = '#dgRSESelected'; // rezultablo
    DGS = '#dgScrutSelected'; // rezult
    DGE = '#dgEnGeoSelected';

    /* Quelques fonctions de datagrid */
    FGC = 'getChanges';
    FGD = 'getData';

    SFC = 'created';
    SFU = 'updated';
    SFD = 'deleted';

    /* Y a_t_il eu au moins un changement ? */
    /*
     * deux dg sont à vérifier
     * id="dgRSESelected" pour les résultats du scrutin de l'EG sélectionnée
     * id="dgCSESelected" pour les candidatures du scrutin l'EG sélectionnée
     *
     * method
     *  getChanges	type	Get changed rows since the last commit.
     *                          The type parameter indicate which type
     *                          changed rows, possible value is:
     *                          inserted,deleted,updated,etc.
     *
     *                          When the type parameter is not assigned,
     *                          return all changed rows.
     */
    modifsCSES = $('#dgCSESelected').datagrid('getChanges');
    modifsRSES = $('#dgRSESelected').datagrid('getChanges');
    if ((modifsCSES.length + modifsRSES.length) <= 0)
    {
        /* Aucun changement détecté
         * Retour à l'index
         */
        window.location.replace(nomController()); // fonction index par défaut
    } else
    {
        /*  au moins un changement est détecté */
        //
        // Assign handlers immediately after making the request,
        // and remember the jqxhr object for this request
        // document.getElementsByName("csrfToken").value
        //
        // alert($('#csrfToken').val());
        // alert($('meta[name="_csrfToken"]').attr('content'));
        var jqxhr = $.post({
            url: nomController('OkClickFrmResultatScrutinLst')
            , data: {
                _csrfToken: $("#csrfToken").val(),
                //_csrfToken: getCookie("csrftoken"),
                /*
                 * modifsRSES: modifsRSES, il vaut mieux tout importer
                 * Pour cela utiliser une méthode de datagrid fournissant
                 * getData : toutes les lignes.
                 * getRows : uniquement les lignes affichées.
                 */
                DSCRU: $(DGS).datagrid(FGD),
                DEGEO: $(DGE).datagrid(FGD),
                DRSES: $(DGR).datagrid(FGD), // Dat'um'o'j
                KRSES: $(DGR).datagrid(FGC, SFC), // Datumoj kreitaj
                MRSES: $(DGR).datagrid(FGC, SFU), // Datumoj modifitaj
                FRSES: $(DGR).datagrid(FGC, SFD), // Datumoj forviŝitaj

                DCSES: $(DGC).datagrid(FGD), // Dat'um'o'j
                KCSES: $(DGC).datagrid(FGC, SFC), // Datumoj kreitaj
                MCSES: $(DGC).datagrid(FGC, SFU), // Datumoj modifitaj
                FCSES: $(DGC).datagrid(FGC, SFD), // Datumoj forviŝitaj
            }
            // , done: function (data, textStatus, jqXHR) {
            , success: function (data, textStatus, jqXHR) {
                /*
                 * ici on joue principalement avec data
                 */
                // switch (jqXHR.status) {
                //     case 200:
                //         break;
                //     case 299:
                //         // saisie correcte mais incomplète ou incohérence
                //         // entre scru et CAND
                //         break;
                //     default:
                // }
                /*
                 * Simple retour à l'index,
                 * Après vérification et application,
                 * via php,
                 * des modifications.
                 */
                // Décommenter pour le mode production
                // window.location.replace(nomController()); // fonction index par défaut
            }
            // , fail: function (jqXHR, textStatus, errorThrown) {
            , error: function (jqXHR, textStatus, errorThrown) {
                // windows.location.reload();
                /* Ici on joue principalement avec errorThrown */
                /*
                 * nous restons sur l'écran de saisie des modifications
                 * permettant de ressaisir ou d'abandonner,
                 * après vérification et refus des modifications.
                 */
                // switch (jqXHR.status) {
                //     case 409:
                //         /*
                //          * 4×× CLIENT ERROR
                //          * 409 CONFLICT
                //          * The request could not be completed due to a conflict
                //          * with the current state of the target resource.
                //          * This code is used in situations where the user
                //          * might be able to resolve the conflict and
                //          * resubmit the request.
                //          */
                //         // saisie correcte mais incomplète ou incohérence
                //         // entre scru et CAND
                //         break;
                //     default:
                // }
            }
            // , always: function (jqXHR, textStatus) {
            , complete: function (jqXHR, textStatus) {
                // exécution après success ou error
                //
                // ici on joue principalement avec ce qui reste soit
                // jqXHR, textStatus

                msg = textStatus
                        // + " /" + jqXHR.responseText + "/ "
                        + " [" + jqXHR.status + "] "
                        + "(" + jqXHR.statusText + ")"
                        ;
                alert(msg);
            }

        });

    }
}
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1)
                c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
