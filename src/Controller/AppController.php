<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * php version 7.2.10
 *
 * @category  Description
 * @package   App\Controller
 * @author    Fabrice bouilerot <bouillerot@lemonde.fr>
 * @copyright 0001-9999 Copyright (c) Cake Software Foundation, Inc. * (https://cakefoundation.org)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @version   GIT: 8.0
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 */

namespace App\Controller;

use App\Model\Table\AppTable;
use CakeDC\OracleDriver\ORM\MethodRegistry;
use Cake\Chronos\Chronos;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\Http\Exception\ServiceUnavailableException;
use Cake\Http\Response;
use Cake\I18n\Number;
use Cake\Log\Log;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

//use Zend\Diactoros\Response as Response2;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @category  Description
 * @package   App\Controller
 * @author    Fabrice bouilerot <bouillerot@lemonde.fr>
 * @copyright 0001-9999 Copyright (c) Cake Software Foundation, Inc. * (https://cakefoundation.org)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @version   GIT: 8.0
 * @link      https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 * @since     0.2.9
 */
class AppController extends Controller
{
    // Messages d'erreur

    /**
     * Message générique de bon déroulement d'une action.
     *
     * @var String Message générique de bon déroulement d'une action.
     */
    const MSGPB = "L'action s'est mal terminée."; // The action ended badly

    /**
     * Message générique
     *
     * @var String Message générique de mauvais déroulement d'une action.
     */
    const MSGOK = "L'action s'est bien déroulée."; // The action went wel
    // Noms des contrôleurs

    /**
     * Nom du contrôleur des entités géographiques
     *
     * @var String Nom du contrôleur des entités géographiques
     */
    const ENGEO = "Engeo";

    /**
     * Nom du contrôleur des entités géographiques par scrutin.
     *
     * @var String
     */
    const ENGEOSCRUT = "Entgeoscrutin";

    /**
     * Gestion des candidatures d'un scrutin
     *
     * @var string Traitement gestion des candidatures d'un scrutin
     */
    const TRTCAND = "Candidatures";

    /**
     * Gestion des résultats d'un scrutin
     *
     * @var string Traitement
     */
    const TRTRESU = "Résultats";

    /**
     * Noms des DataSources
     */
    const NDS_PROD = 'ptere'; // Base de production
    const NDS_TEST = 'default'; // Base de Test

    /**
     * * Noms des Champs
     */
    const SCRUDATE = "SCRU_DATE";       // nom de champ
    const SCRUTOUR = "SCRU_TOUR";       // nom de champ
    const TYELCODE = "TYEL_CODE";       // nom de champ
    const TYENCODE = "TYEN_CODE";       // nom de champ
    const TYEGCODE = "TYEG_CODE";       // nom de champ
    const CANDID   = "CAND_ID";         // nom de champ
    const INDICLE  = "INDI_CLE";        // nom de champ
    const TYRTCODE = "TYRT_CODE";       // nom de champ
    const ELECLIB  = "ELEC_LIB";        // nom de champ
    const TYSCCODE = "TYSC_CODE";       // nom de champ
    const ELECCLE  = "ELEC_CLE";        // nom de champ
    const NUMTOUR  = "NUM_TOUR";        // nom de champ
    const EGCLE    = "ENTG_CLE";        // nom de champ
    const RESINS   = "RESU_SCR_INS";    // nom de champ
    const RESVOT   = "RESU_SCR_VOT";    // nom de champ
    const RESEXP   = "RESU_SCR_EXP";    // nom de champ
    const RESCVOIX = "RESU_CAND_VOIX";  // nom de champ
    const RESLI2   = "RESU_LIBEL_2";    // nom de champ
    const EGSIEGES = "EGEO_SIEGES";     // nom de champ
    const EGLIB    = "EGEO_LIBEL";      // nom de champ
    const EGLIB2   = "EGEO_LIBEL_2";    // nom de champ


    /**
     * Nom de Clef utilisé à différents endroits du Code
     * pour stocker des variables de cz de résultat d'1 eg d'1 scrutin.
     */
    const MODIFSCRUTIN = "modifScrutin";

    /*
      Noms Des boutons génériques des formulaires

      CONST BTN_FLT = 'btnFiltrer';  // bouton de filtrage
      CONST BTN_RAZ = 'btnRaz';      // bouton de filtrage
      CONST NAV_SRC = 'navSearch';   // filtre de barre de navigation
      Noms des Actions gérées en requête
      CONST ACT_FILTER = "Filter"; // demande de filtre
      CONST ACT_RAZFILTER = "RAZ"; // RAZ du Filtre Action utile ?
      CONST ACT_ORDER = "order"; // demande tri sur une colonne
      Noms des params obtenus par méthode get:
      CONST GET_SORT = "sort";
      CONST GET_DIRECTION = "direction";
     */

    /**
     * Comboboxes
    */

    /**
     * Clefs des options, tableau associatif
    */
    const OPTSELECT = "selected"; // fournie par le dév.
    const OPTALIAS = "alias"; // fournie par le dév.
    const OPTDEFAUT = "defaut"; // fournie par le dév.
    const OPTQUERY = "query"; // fourni par le dév.

    /**
     * Par défaut
     *
     * @var int  JSON_UNESCAPED_UNICODE  JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
     */
    const OPTJSONP = "jsonp";
    /* JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK */
    const OPTJSONV = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;
    //350; // 256 + 64 + 30;

    const OPTVALFD = 'valueField';
    const OPTTXTFD = 'textField';
    const OPTNOMVAL = 'id';
    const OPTNOMTXT = 'text';

    /**
     * 3 CONST pour les fonctions de choix
     */

    /**
     * Nom de la variable mémoire
     *
     * @var String  Nom de la variable mémoire en session
     *              contenant le nom du contrôleur de retour
     *              après un choix
     */
    const CHXCTLRET = "CHX_CTLRET";

    /**
     * Nom de la variable mémoire
     *
     * @var String  Nom de la variable mémoire en session
     *              contenant le nom de l'action à effectuer
     *              quand un choix est fait.
     */
    const CHXACTOK = "CHX_ACTOK";

    /**
     * Nom de la variable mémoire
     *
     * @var String  Nom de la variable mémoire en session
     *              contenant le nom de l'action à effectuer
     *              quand un choix N'est PAS fait.
     */
    const CHXACTNO = "CHX_ACTNO";

    /**
     * Tableau des options par défaut
     */
    public $defaultOptions = [
        self::OPTVALFD => self::OPTNOMVAL,
        self::OPTTXTFD => self::OPTNOMTXT,
        self::OPTJSONP => self::OPTJSONV, //dangereux à l'usage !
    ];

    /**
     * Index method
     *
     * @return Response2|null
     */
    public function index()
    {
        /*
          $egCandidature = $this->paginate($this->EgCandidature);

          $this->set(compact('egCandidature'));
         */
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', ['enableBeforeRedirect' => false,]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for
         * recommended CakePHP security settings.
         * see
         * https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    /**
     * Traitement à effectuer avant render
     *
     * @param \Cake\Event\Event $event -
     *
     * @return void
     */
    public function beforeRender(Event $event)
    {
        //        $koonexion = ConnectionManager::get($this->getActiveDataSourceName());
        //        dd($koonexion->config()['shortName']);
        $shortName = ConnectionManager::get($this->getActiveDataSourceName())
            ->config()["shortName"];
        $this->set(
            [
                //'nomBase' => '(' . $this->getActiveDataSourceName() . ') ',
                'nomBase' => '(' . $shortName . ') ',
                'isInProd' => $this->isInProd(),
            ]
        );
        parent::beforeRender($event);
    }

    /**
     * Traitement à effectuer après render
     *
     * @param \Cake\Event\Event $event -
     *
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        //dd(__METHOD__, Configure::read('App.maintenance'));
        /**
         * Down for Maintenance variable
         * http://mark-story.com/posts/view/quick-and-dirty-down-for-maintenance-page-with-cakephp
         */
        if (Configure::read('App.maintenance')) {
            //if ($this->Auth->user('id') !== 1) {
            if (true) {
                $message = __(
                    "Nous travaillons actuellement sur l'application,"
                        . " Veuillez réessayer plus tard !"
                    //'We are currently working on the application,
                    // please check back later.'
                    //,                    true
                );
                throw new ServiceUnavailableException($message, 503);
            }
        }
        $this->connection = $this->getActiveConnexion();
        parent::beforeFilter($event);
    }

    /**
     * Undocumented function
     *
     * @param string $nomfunc -
     * @param mixed  $pk      -
     *
     * @return void
     */
    protected function nonImplantee(string $nomfunc, $pk)
    {
        $this->Flash->error(
            __(
                "Méthode "
                    . "non implantée. "
                    . $this->name . "." . $nomfunc
                    . " Identifiant reçu [{0}]",
                [print_r($pk, true)]
            )
        );
        $this->redirect(["controller" => $this->name, "action" => "index"]);
    }

    /**
     * Duplication d'une Entity
     *
     * @param type $pk -
     *
     * @return mixed
     */
    public function duplicate($pk)
    {
        $this->nonImplantee(__FUNCTION__, $pk);
    }

    /**
     * Renvoie un Json spécifique pour EasyUI Datagrid
     *
     * @param \Cake\Datasource\ResultSetInterface $resultSet -
     *
     * @return JSON
     */
    public function renderResultSet2EasyUIDatagrid(\Cake\Datasource\ResultSetInterface $resultSet)
    {
        $rows = [];
        if (is_array($resultSet)) {
            $rows[] = $resultSet;
        } else {
            $rows = $resultSet->toArray();
            // dd(__METHOD__, $tmp, $rows);
        }
        $total = count($rows); // forcément !
        $this->renderEasyUIDatagrid($total, $rows);
    }

    /**
     * Render of Json flux of a datagrid from EasyUI
     *
     * @param int   $total total of items
     * @param mixed $rows  array of data
     *
     * @return render
     */
    public function renderEasyUIDataGrid(int $total = 0, $rows = [])
    {
        /**
         * Préparation du Render Json spécifique à une datagrid
         */
        $data = ['total', 'rows'];
        $this->set(compact($data));
        $this->set('_serialize', $data);
        /**
         * Mise en forme du flot JSON
         *
         * Lien
         * https://www.php.net/manual/fr/json.constants.php
         *
         * JSON_UNESCAPED_UNICODE
         * Encode les caractères multi-octets Unicode littéralement
         * (le comportement par défaut est de les échapper par \uXXXX).
         * Disponible à partir de PHP 5.4.0.
         *
         * JSON_UNESCAPED_SLASHES
         * Ne pas échapper les caractères /. Disponible à partir de PHP 5.4.0.
         *
         * JSON_FORCE_OBJECT
         * Produit un objet plutôt qu'un tableau, lorsqu'un tableau
         * non-associatif est utilisé. C'est particulièrement utile lorsque
         * le destinataire du résultat attend un objet, et que le tableau
         * est vide. Disponible à partir de PHP 5.3.0.
         *
         * JSON_NUMERIC_CHECK
         * Encode les chaînes numériques en tant que nombres.
         * Disponible à partir de PHP 5.3.3.
         */
        $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            //| JSON_FORCE_OBJECT // tjs tablo assoc.
            //| JSON_NUMERIC_CHECK // "099" en 99
        ;
        $this->set('_jsonOptions', $jsonOptions);
    }

    /**
     * Render of Json flux of a combobox from EasyUI
     *
     * @param array $rows array of data
     *
     * @return render
     */
    public function renderEasyUIComboBox(array $rows = [])
    {
        /**
         * Préparation du Render Json spécifique à une comboBox
         */
        $data = ['rows'];
        $this->set(compact($data));
        //$this->set(compact($rows));
        $this->set('rows', $rows);

        //  $this->set('_serialize', $data);
        $this->set('_serialize', $rows);
        /**
         * Mise en forme du flot JSON
         *
         * Lien https://www.php.net/manual/fr/json.constants.php
         *
         * JSON_UNESCAPED_UNICODE
         * Encode les caractères multi-octets Unicode littéralement
         * (le comportement par défaut est de les échapper par \uXXXX).
         * Disponible à partir de PHP 5.4.0.
         *
         * JSON_UNESCAPED_SLASHES
         * Ne pas échapper les caractères /. Disponible à partir de PHP 5.4.0.
         *
         * JSON_FORCE_OBJECT
         * Produit un objet plutôt qu'un tableau, lorsqu'un tableau
         * non-associatif est utilisé. C'est particulièrement utile lorsque
         * le destinataire du résultat attend un objet, et que le tableau
         * est vide. Disponible à partir de PHP 5.3.0.
         *
         * JSON_NUMERIC_CHECK
         * Encode les chaînes numériques en tant que nombres.
         * Disponible à partir de PHP 5.3.3.
         */
        $jsonOptions = JSON_UNESCAPED_SLASHES //Don't escape /.
            | JSON_UNESCAPED_UNICODE //default is to escape as \uXXXX
            //| JSON_OBJECT_AS_ARRAY // Decodes JSON objects as PHP array.
            //| JSON_FORCE_OBJECT // tjs tablo assoc.
            //| JSON_BIGINT_AS_STRING // Decodes large int as their original string value.
            //| JSON_NUMERIC_CHECK // "099" en 99
        ;
        $this->set('_jsonOptions', $jsonOptions);
    }

    /**
     * Renvoie le tri par défaut en fonction du nom du contrôleur.
     * Par défaut, dans l'ordre descendant de la clef primaire.
     *
     * @param string $tableName -
     *
     * @return array : Associative array ['fieldname' => 'desc']
     */
    public function getDefaultSortController(string $tableName = "")
    {
        $nameCtl = ($tableName === "") ? $this->name : $tableName;
        $table = $this->getTableLocator()->get(
            $nameCtl,
            ['connection' => $this->getActiveConnexion()]
        );
        $k0 = (array) $table->getPrimaryKey();
        /* dd(__METHOD__ . "::" . __LINE__, $table, $k0); */
        $this->sessionMergeArray($this->name, ['ctlunivoque' => $nameCtl]);
        $k = array_map([$this, 'univoque'], $k0);
        $v = array_fill(0, count($k), 'desc');
        $result = array_combine($k, $v);
        return $result;
    }

    /**
     * Supprime ambiguïté de nommage du nom de champ.
     * Modifie le nom du tri en syntaxe à point.
     *
     * @param string $v | value est 'INDI_CLE'

     * @return string | resultat devient 'ELECT.INDI_CLE'
     */
    public function univoque($v)
    {
        $nameCtl = $this->sessionCheck('ctlunivoque') ?
            $this->sessionRead('ctlunivoque') : $this->name;
        $this->sessionDelete('ctlunivoque');
        return (strpos($v, '.') === false ? $nameCtl . '.' : '') . $v;
    }

    /**
     * Renvoie un tableau associatif permettant de trier un query.
     * Tableau associatif de la forme ['field1' => 'asc', 'field2'=> 'desc',…]
     *
     * @param array $gdata | Array of session datas
     *
     * @return array | Associative array key = fieldname, value = orderby
     */
    public function getSortController(array $gdata = [])
    {
        $result = [];
        if (key_exists('sort', $gdata)) {
            if (key_exists('order', $gdata)) {
                $delimiter = ",";
                $k0 = explode($delimiter, $gdata['sort']);
                /**
                 * Éviter l'ambiguïté de nommage des clefs.
                 */
                $k = array_map([$this, 'univoque'], $k0);

                $v = explode($delimiter, $gdata['order']);
                $result = array_combine($k, $v);
            }
        } else {
            /**
             * ! Tri par défaut
             */
            $result = $this->getDefaultSortController();
        }

        return $result;
    }

    /**
     * Envoi Json de remplissage d'une datagrid
     *
     * Tri optionel
     * fournir dans $options deux tableaux de la forme
     * $options["sort"] = "FieldName1,FieldName2,Fieldname3…";
     * $options["order"] = "asc,asc,desc,…";
     *
     * @param array $options -
     *
     * @return type
     */
    public function getdatagrid(array $options = [])
    {
        /**
         * ! Scope pour Log::info()
         */
        $infoOpt = ['scope' => ['getdatagrid']];
        /*
         * Journalise
         */
        //Log::info(__METHOD__ . "::" . __LINE__ . " : > " . $this->name, $infoOpt);
        /*
         *  Nom du Contrôleur concerné.
         */
        $ctrlName = $this->name;
        /*
         * Tamponne les données :
         * - de session
         * - d'options
         * de toute manière un des deux est vide en tout cas.
         * => donc pas de perte d'information «a priori».
         */
        //Log::info(__METHOD__ . "::" . __LINE__ . " : " . print_r($options, true),
        //      $infoOpt);
        //              true), $infoOpt);
        $gdata = array_merge($this->request->getData(), $options);
        //Log::info(__METHOD__ . "::" . __LINE__ . " : " . print_r($gdata, true),
        //      $infoOpt);
        $this->sessionMergeArray($this->name, $gdata);
        /*
        * Données tamponnées de la session
        */
        $sdata = $this->sessionRead($this->name);
        /*
         * Préparation du Query
         */
        /*
         * Préparation du tri
         */
        $options['order'] = $this->getSortController($sdata);
        /*
         * Construction du Query
         * ->find('all') // allow to apply specific filter (i.e.) table Vcgeo
         */
        //dd(__METHOD__, $ctrlName, $sdata);
        $query = $this->$ctrlName
            //->find('all') // allow to apply specific filter.
            ->find('search', ['search' => $sdata]) // search Behavior
        ;

        /*
         * Associations ?
         */
        if (key_exists('contain', $options)) {
            $query->contain($options['contain']);
        }
        /*
         * Tri
         */
        $query->order($options['order']); // an array [fieldname => orderby]
        try {
            /*
             * pagination par défaut
             */
            $options = array_merge($options, $this->paginate);
            /*
             * Prise en compte et conversion du
             * nom des paramètres spécifiques à la pagination
             * easyUI -> Paginator CakePHP
             */
            if (!is_null($sdata['page'])) {
                $options['page'] = $sdata['page'];
            }
            if (!is_null($sdata['rows'])) {
                $options['limit'] = $sdata['rows'];
            }
            $rows = $this->paginate($query, $options);
            //dd(__METHOD__, $rows);
        } catch (Exception $exc) {
            $this->Flash->error($exc);
            return $this->redirect(['action' => 'index']);
        }
        /*
         * En utilisant un objet query unique, il est possible d’obtenir
         * le nombre total de lignes trouvées pour un ensemble de conditions
         */
        $total = $query->count(); //ttes les lignes du query.
        $this->renderEasyUIDatagrid($total, $rows);
    }

    /**
     * Envoi Json de remplissage d'une HandsonTable grid
     *
     * Tri optionel
     * fournir dans $options deux tableaux de la forme
     * $options["sort"] = "FieldName1,FieldName2,Fieldname3…";
     * $options["order"] = "asc,asc,desc,…";
     *
     * @param array $options -
     *
     * @return type
     */
    public function hotGetGrid(array $options = [])
    {
        // * Préparation des conditions de filtrage
        $keys = [AppTable::ELECCLE, AppTable::SCRUTTOUR, AppTable::SCRUTDATE];
        $filtre = $this->modifScrutinExtractArrayScrutin($keys);
        $filtre[AppTable::EGCLE] = $this->modifScrutinEnGeoLire(AppTable::EGCLE);

        try {
            $tmp = $this->stmtSelCandEgLst($filtre)->enableHydration(false)
                //->stmtCandEg($param)
                ->all();
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $rows = [];
        if (is_array($tmp)) {
            $rows[] = $tmp;
        } else {
            $rows = $tmp->toArray();
            // dd(__METHOD__, $tmp, $rows);
        }
        $total = count($rows); // forcément !
        //$this->renderEasyUIDatagrid($total, $rows);
        return $rows;
        //        return ['data' => [['ID' => "1"], ['ID' => "2"]]];
    }

    /**
     * Fournit un query pour l'alias de table fourni en paramètre.
     *
     * @param string $alias -
     *
     * @return Query
     */
    private function _getAQuery4all(string $alias = "")
    {
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        return $table->find();
    }

    /**
     * Affichage liste de la comboBox dédiée à TYEL_CODE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbTyelCode()
    {
        $alias = "typeElection";
        $nchp = AppTable::TYELCODE;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];

        /*
         * Gestion des options à générer, et la valeur par défaut.
         * pour générer le résultat JSON
         */

        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à TYCL_CODE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbTyclCode()
    {
        $alias = "typeClassification";
        $nchp = AppTable::TYCLCODE;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];

        /*
         * Gestion des options à générer, et la valeur par défaut.
         * pour générer le résultat JSON
         */

        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à TYEG_CODE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbTyegCode()
    {
        $alias = "typeEntiteGeo";
        $nchp = AppTable::TYEGCODE;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];
        /*
         * Gestion des options à générer, et la valeur par défaut.
         * pour générer le résultat JSON
         */
        $this->cbQuery($options);
    }

    /**
     * Fournit une sortie JSON pour la combobox des valeurs de classfification
     * Remarque : Il ne faut plus utiliser les options commençant par "De_"
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbVaclVale()
    {
        $alias = "valeurClassifGeo";
        $nchp = AppTable::VACLVALE;
        $query = $this->_getAQuery4all($alias);
        $query->where(
            function (QueryExpression $exp, Query $q) {
                return $exp->notLike('VACL_VALE', 'De%');
            }
        );
        $options = [
            /* self::OPTALIAS => $alias, */
            self::OPTQUERY => $query, // query spécifique !
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à ENTG_CLE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbEntgCle()
    {
        echo 'Faut pas utiliser cb_entgcle !';
    }

    /**
     * Affichage liste de la comboBox dédiée à INDI_CLE
     *
     * @param mixed $selected - élément sélectionné
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbIndiCle($selected = null)
    {
        /*
         * Génère un query
         */
        $alias = "incan";
        $nchp = self::INDICLE;
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        //$query = $table->find();
        /*
         * Il y a une valeur par défaut
         * Gestion indice courant, par défaut
         */
        $defaut = $table->defautInCan();
        /*
         * Assure un tri en ordre DESC pour
         * les codes d'indice de candidature.
         */
        $query = $this->_getAQuery4all($alias);
        $query->orderDesc(AppTable::INDICLE);

        /*
         * Gestion des options à générer, et la valeur par défaut.
         * pour générer le résultat JSON
         */
        $options = [
            /* self::OPTALIAS => $alias, */
            self::OPTQUERY => $query, // ! query spécifique !
            self::OPTDEFAUT => $defaut,
            self::OPTNOMVAL => $nchp,
            self::OPTNOMTXT => $nchp,
        ];
        $this->cbQuery($options);
    }

    /**
     * Vérifie existence et pertinence de chaque paramètre
     * nécessaire à la réalisation de la function cbQuery
     *
     * @param array $options -
     *
     * @return array
     * @throws Exception
     */
    private function _checkOptions(array $options = [])
    {
        $isOk = true;
        if ($isOk) {
            $options = array_merge($this->defaultOptions, $options);
            /*
             * ici $options contient au moins les clefs suivantes :
             * alias ou query, ValueFIeld, TextFIeld
             *
             */
        }
        $msg = [
            "un paramètre 'alias' ou 'query' doit être présent dans les options !",
            "champ [%s] est manquant !",
            "champ [%s] n'est pas une STRING !",
            "champ [%s] ne doit pas être vide !",
        ];
        if (key_exists('alias', $options)) {
            /*
             * Option 'alias' est présente - Fabriquons le query
             */
            $options['query'] = !key_exists('query', $options) ?
                $this->_getAQuery4all($options['alias']) : $options['query'];
        }
        if (!key_exists('query', $options)) {
            $message = __METHOD__ . "::" . __LINE__ . "::" .
                $msg[0] . \print_r($options, true);
            Log::error($message);
            throw new \Exception($message);
        }
        /*
         * Gestion de l'option ValueField
         */
        $valueField = !key_exists('valueField', $options) ? "id" :
            $options['valueField'];
        $options['ValueField'] = $valueField;
        /*
         * Gestion option TextField
         */
        $textField = !key_exists('textField', $options) ?
            'text' :
            $options['textField'];
        $options['textField'] = $textField;
        /*
         * gestion de l'existence effective
         */
        if (!key_exists($valueField, $options)) {
            $message = sprintf($msg[1], $valueField) . \print_r($options, true);
            Log::error($message);
            throw new \Exception($message);
        }
        /*
         * Chaque champ nécessaire est présent.
         * Reste à vérifier la qualité des données.
         */
        $id = $options[$valueField];

        if (!is_string($id)) {
            $message = sprintf($msg[2], $valueField) . \print_r($options, true);
            Log::error($message);
            throw new \Exception($message);
        }
        if (("" === $id)) {
            $message = sprintf($msg[3], $valueField) . \print_r($options, true);
            Log::error($message);
            throw new \Exception($message);
        }
        /*
         *  text field
         */
        $text = key_exists($textField, $options) ? $options[$textField] : $id;
        if (("" === $text) or (!is_string($text))) {
            $text = $id;
        }
        $options = array_merge(
            $options,
            [
                'valueField' => $valueField,
                'textField' => $textField,
                $valueField => $id, // permet d'éviter les doublons
                $textField => $text,
            ]
        );
        return $options;
    }

    /**
     * Génère un echo JSON pour une combobox
     *
     * @param array $options -
     *
     * @return JsonString
     */
    public function cbQuery(array $options = [])
    {
        $verif = $this->_checkOptions($options);
        /**
         *  Chaque champ est censé exister et être de qualité
         */
        $query = $verif[self::OPTQUERY];
        $textField = $verif[self::OPTTXTFD];
        /**
         * Sélectionner une éventuelle valeur par défaut.
         */
        if (array_key_exists(self::OPTDEFAUT, $verif)) {
            $verif[self::OPTSELECT] = $verif[self::OPTDEFAUT];
        }
        /**
         * Avez-vous pensé à mémoriser l'élément sélectionné ?
         * La valeur est mémorisée en Session.
         */
        $ns = $this->name . "." . $verif[$textField];
        if ($this->sessionCheck($ns)) {
            $verif[self::OPTSELECT] = $this->sessionRead($ns)[0];
        }
        $records = $this->Query2Combobox($query, $verif);
        $jsonv = $verif[self::OPTJSONP];
        $toto = json_encode($records, $jsonv);
        /*
         * la limite d'affichage de la commande ECHO
         * semble pouvoir être dépassée.
         *
         * On peut toujours essayer la technique du Salami… non…
         *
         * Note : Dans php.ini voir le paramètre output_buffering
         * Je l'ai augmenté de 4096 à 16384 octets
         * À l’usage cela semble suffisant.
          $this->log($toto);
         */
        echo $toto;
    }

    /**
     * Affichage liste de la comboBox dédiée à TYSC_CODE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbTyscCode()
    {
        $alias = "typeScrutin";
        $nchp = AppTable::TYSCCODE;
        $npoint = $alias . "." . $nchp;
        $valDefaut = $this->sessionCheck($npoint) ?
            $this->sessionRead($npoint)[0] : AppTable::TYSCDEFT;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
            self::OPTDEFAUT => $valDefaut,
        ];
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à TYRT_CODE
     *
     * @return string cbQuery - Query de la combobox
     */
    public function cbEtPolCle()
    {
        $alias = "etPol";
        //$nchp = AppTable::TYRTCODE;
        $nchp = "ETIQ_CLE";
        $query = $this->_getAQuery4all($alias);
        $query->where(
            [
                "ETIQ_PREF_PART <> 0",
                "ETIQ_DATE IS NOT NULL",
            ]
        )
            //->select(['count' => $query->func()->count("*"), $nchp,])
            //->group($nchp)
            ->orderAsc($nchp);
        //dd($query->sql());
        $options = [
            /*
         * self::OPTALIAS => $alias,
         */
            self::OPTQUERY => $query, // query spécifique !
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à TYRT_CODE
     *
     * @return void
     */
    public function cbTyrtCode()
    {
        $alias = "TRatt";
        $nchp = AppTable::TYRTCODE;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => $nchp, // permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
        ];
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à VENT_CODE
     *
     * @return void
     */
    public function cbVentCode()
    {
        $alias = "Venti";
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        $query = $table->find();
        $options = [
            self::OPTALIAS => $alias,
            self::OPTNOMVAL => 'VENT_CODE', // permet d'éviter les doublons
            self::OPTNOMTXT => 'VENT_CODE',
        ];
        /*
         * Limite d'affichage de la commande ECHO, semble dépassée
         *
         * On peut toujours essayer la technique du Salami
         *
         * Note : Dans php.ini voir le paramètre output_buffering
         * Je l'ai augmenté de 4096 à 16384 octets
         *
         */
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à SCRU_TOUR
     *
     * @return void
     */
    public function cbScruTour()
    {
        $alias = "Scrutin";
        $nchp = AppTable::SCRUTTOUR;
        $npoint = $alias . "." . $nchp;
        $valDefaut = $this->sessionCheck($npoint) ?
            $this->sessionRead($npoint)[0] : AppTable::SCRUTTOUR1;
        $options = [
            self::OPTALIAS => $alias,
            self::OPTJSONP => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
            /**
         *  | JSON_NUMERIC_CHECK
         * IMPORTANT NE PAS LE METTRE POUR AVOIR '01' et pas '1'
         */
            self::OPTNOMVAL => $nchp, // <- permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
            self::OPTDEFAUT => $valDefaut,
        ];
        $this->cbQuery($options);
    }

    /**
     * Affichage liste de la comboBox dédiée à ENTG_SELECT
     * de la Table  EG_CANDIDATURE
     *
     * @return void
     */
    public function cbSelect()
    {
        $alias = AppTable::EGCAN;
        $nchp = AppTable::EGCANSEL;
        $npoint = $alias . "." . $nchp;
        $valDefaut = $this->sessionCheck($npoint) ?
            $this->sessionRead($npoint)[0] : "0";
        $query = $this->_getAQuery4all($alias);
        $query->select(['count' => $query->func()->count("*"), $nchp])
            ->group($nchp)
            ->orderDesc($nchp);
        //dd($query->sql());
        $options = [
            // self::OPTALIAS => $alias,
            //self::OPTJSONP => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
            /**
         *  | JSON_NUMERIC_CHECK
         * IMPORTANT NE PAS LE METTRE POUR AVOIR '01' et pas '1'
         */
            self::OPTQUERY => $query, // query spécifique !
            self::OPTNOMVAL => $nchp, // <- permet d'éviter les doublons
            self::OPTNOMTXT => $nchp,
            self::OPTDEFAUT => $valDefaut,
        ];
        //dd(__METHOD__ . "::" . __LINE__, $options);
        $this->cbQuery($options);
    }

    /**
     * Préparation liste de ComboBox pour toute ComboBox
     * Exemple :  d'un tableau d'options
     *  $options = [
     *      'valueField' => 'id',
     *      'textField' => 'text',
     *      'id' => 'TYEL_CODE', // permet d'éviter les doublons
     *      'text' => 'TYEL_CODE',
     *  ];
     *
     * @param Query $query   query
     * @param array $options options
     *
     * @return array
     */
    protected function Query2Combobox(Query $query, array $options = [])
    {
        $records = [];
        $valueField = 'id';
        if (key_exists('valueField', $options)) {
            $valueField = $options['valueField'];
        }
        $textField = 'text';
        if (key_exists('textField', $options)) {
            $textField = $options['textField'];
        }

        if (!in_array($textField, $options)) {
            return $records;
        }
        try {
            $rows = $query->all();
            $colText = $options[$textField];

            $colValue = in_array($valueField, $options) ?
                $options[$valueField] : null;

            /**
             * Array_column, le troisième paramètre supprime les doublons
             * https://www.php.net/manual/en/function.array-column.php
             * Problème pour gérer une clef $colText qui est nulle
              $data = array_column($rows->toArray(), $colText, $colValue);
             */
            $data = [];


            $toto = (array) $rows->toArray();
            foreach ($toto as $value) {
                $data[(null === $value[$colText]) ? " " : $value[$colText]] = (null === $value[$colValue]) ?
                    "Rien" : $value[$colValue];
            }
            /*
             * Affichage trié des options
             */
            if (key_exists('sort', $options)) {
                if (strtoupper($options['sort']) == 'ASC') {
                    asort($data);
                } else {
                    arsort($data);
                }
            }

            $selected = key_exists("selected", $options) ?
                $options["selected"] : null;

            /*
             * Ajout de l'option blanche sélection totale
             *
             *  'id' = "" => aucun filtre => toute valeur
             */
            $v = ['id' => "", 'text' => "Tout"];
            $records[] = $v;

            /**
             *  Conversion toutes data au format 'id'=> id, 'value'=>$value
             */
            foreach ($data as $key => $value) {
                $v = ['id' => (string) $key, 'text' => $value];
                if ($selected == $key) {
                    $v['selected'] = $key;
                }
                $records[] = $v;
                // $records[] = ($selected == $key) ?
                // ['id' => (string) $key, 'text' => $value, 'selected' => $key] :
                // ['id' => (string) $key, 'text' => $value];
            }
        } catch (Exception $exc) {
            $this->log($exc);
        } finally {
            return $records;
        }
    }

    /**
     * Indique si nous sommes en mode production
     *
     * @return boolean
     */
    public function isInProd()
    {
        return ($this->getActiveDataSourceName() === self::NDS_PROD);
    }

    /**
     * Undocumented function
     *
     * @param string $nomTable nom de Table
     * @param array  $conds    conditions
     *
     * @return void
     */
    protected function compteDansUnetable(string $nomTable, array $conds)
    {
        $table = $this->getTableLocator()->get(
            $nomTable,
            ['connection' => $this->getActiveConnexion()]
        );
        $records = $table->find()->where($conds);
        return $records->count();
    }

    /**
     * Est-ce un tableau Associatif ?
     *
     * @param array $arr le tableau à tester
     *
     * @return boolean Vrai si au moins une key est (string)
     */
    public function isArrayAssoc(array $arr)
    {
        if ([] === $arr) {
            return false;
        }
        foreach ($arr as $key => $value) {
            if (is_string($key)) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @param array $arr
     * @return boolean vrai si toute key est (int) et ordonnée depuis 0
     */
    public function isArraySequential(array $arr)
    {
        if ([] === $arr) {
            return false;
        }
        return array_keys($arr) === range(0, count($arr) - 1);
    }

    /**
     * filtre les clefs attendues d'un tableau.
     * Note : La présence de la totalité des clefs désirées n'est pas garantie !
     * @param array $source : le tableau à filtrer
     * @param array $kWanted : Tableau INDEXÉ des clefs désirées
     * @return array : contient tout élément dont la clef est désirée.
     */
    public function arrayFilterByKeysWanted(array $source, array $kWanted)
    {
        $result = [];
        foreach ($kWanted as $key => $value) {
            if (key_exists($value, $source)) {
                $result[$value] = $source[$value];
            }
        }
        return $result;
    }

    /**
     * filtre les clefs rejetées d'un tableau.
     * Note : La présence de la totalité des clefs rejetées n'est pas garantie !
     * @param array $source : le tableau à filtrer
     * @param array $kWanted : Tableau INDEXÉ des clefs rejetées
     * @return array : contient tout élément dont la clef est rejetée.
     */
    public function arrayFilterByKeysRejected(array $source, array $kRejected)
    {
        $result = [];
        foreach ($source as $key => $value) {
            if (in_array($key, $kRejected)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     *
     * @param array $source  le tableau à tester
     * @param array $kWanted tableau INDEXÉ des clefs désirées
     * @return boolean Faux si au moins une clef est manquante, Vrai sinon.
     */
    public function isAllKeysPresentInArray(array $source, array $kWanted)
    {
        $isAllPresent = true;
        foreach ($kWanted as $key => $value) {
            if (!key_exists($value, $source)) {
                $isAllPresent = false;
                break;
            }
        }
        return $isAllPresent;
    }

    /**
     * Indique si nous sommes en mode rafraîchissment automatique de datagrid
     *
     * @return boolean
     */
    public function isAutoRefresh()
    {
        return ($this->request->getSession()->read("AutoRefresh") === true);
    }

    /**
     * @TODO #GUH20190517 retirer après les élections
     * @return string
     */
    protected function getActiveDataSourceName()
    {
        $return = 'default'; //#GUH20190517 // ttere par défaut
        /*
         * #GUH20190517 $return = 'ptere';   // Commenter Hors élections.
         */

        $nameDS = $this->request->getSession()->read("nameDataSource");

        if ($nameDS) {
            $return = $nameDS;
        }

        return $return;
    }

    /** Fournit la connexion courante
     *
     * @return mixed| connexion
     */
    protected function getActiveConnexion()
    {
        //var_dump(__METHOD__, $this->getActiveDataSourceName());
        return ConnectionManager::get($this->getActiveDataSourceName());
    }

    /**
     *
     * @param string $param
     */
    protected function setActiveDataSourceName($param = null)
    {
        if (is_null($param)) {
            $param = 'default';
        }

        if (!is_string($param)) {
            $param = 'default';
        }

        $this->request->getSession()->write("nameDataSource", $param);
    }
    /**
     * Choix d'une entité géographique
     *
     * @param string $CtlCible - toto
     * @param array  $filtre   - too
     * @param string $nFncOK   - Nom de la fonction si choix OK
     * @param string $nFncNo   - Nom de la fonction si choix NO
     *
     * @return response
     */
    public function lanceChoix(
        string $CtlCible,
        array $filtre = [],
        string $nFncOK,
        string $nFncNo = "index"
    ) {
        $nom = $CtlCible . ".";
        if (is_array($filtre) and (!empty($filtre))) {
            /* filtrage a priori du choix sur certains critères */
            foreach ($filtre as $key => $value) {
                $this->sessionWrite($nom . $key, $value);
            }
        }
        $url = [
            "controller" => $CtlCible,
            "action" => "choix",
        ];
        /**
         * Mémoriser action de retour
         */
        $chxCtlRet = $nom . self::CHXCTLRET;
        $chxActOk = $nom . self::CHXACTOK;
        $chxActNo = $nom . self::CHXACTNO;
        $this->sessionWrite($chxCtlRet, $this->name);
        /**
         * Revient ici dans la même function
         */
        $this->sessionWrite($chxActOk, $nFncOK);
        /**
         * Retourne à l'index
         */
        $this->sessionWrite($chxActNo, $nFncNo);
        $this->redirect($url);
    }

    /**
     * Choice method
     * Affiche la liste des entités géographiques, pour en choisir une.
     *
     * @return Response|null
     */
    public function choix()
    {
        /*
          $choix = $this->name . "." . self::CHXCLE;
          if ($this->sessionCheck($choix)) {
          $this->sessionDelete($choix);
          }
         *
         */
        $this->Flash->set(__("Choisissez une Entité Géographique."));

        $ctl = $this->name . "." . self::CHXCTLRET;
        $actok = $this->name . "." . self::CHXACTOK;
        $actno = $this->name . "." . self::CHXACTNO;
        /**
          $msg = ($this->sessionCheck($ctl) ?
          $this->sessionRead($ctl)[0] :
          "pas trouvé " . EngeoController::CHXCTLRET)
          . "/" .
          ($this->sessionCheck($actok) ?
          $this->sessionRead($actok)[0] :
          "pas trouvé " . EngeoController::CHXACTOK)
          . "/" .
          ($this->sessionCheck($actno) ?
          $this->sessionRead($actno)[0] :
          "pas trouvé " . EngeoController::CHXACTNO)
          ;
          $this->Flash->set($msg);
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Entite Geo id.
     *
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function choixFait($id = null)
    {
        //$this->Flash->info(__("Valeur reçue pour traiter le choix : $id"));

        $chxCtl = $this->name . "." . self::CHXCTLRET;
        $Ctl = $this->sessionRead($chxCtl)[0];
        $chxAct = $this->name . "." . self::CHXACTOK;
        $Act = $this->sessionRead($chxAct)[0];
        /**
         * mémorisation de la clef choisie
         */
        $arr_action = ['action' => $Act, $id];
        //$url = ["controller" => $Ctl, $arr_action];
        $url = ["controller" => $Ctl, 'action' => $Act, $id];
        //dd(__METHOD__, __LINE__, $url);
        return $this->redirect($url);
    }

    /**
     * choixFaitNo methode opur retourner au controleur appelant
     * sans objet sélectionné
     *
     * @param string|null $id Entite Geo id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function choixFaitNo()
    {
        $chxCtl = $this->name . "." . self::CHXCTLRET;
        $chxAct = $this->name . "." . self::CHXACTNO;
        /*
         * Détermination du nom du contrôleur
         *
         *         if (isset($this->sessionRead($chxCtl)[0])) {
         *            $Ctl = $this->sessionRead($chxCtl)[0];
         *         }
         *         else {
         *             $Ctl = 'Scrut';
         *         }
         *
         * nous sommes en PHP 7 que Diable !
         * usage for: Null Coalesce Operator
         */
        $Ctl = $this->sessionRead($chxCtl)[0] ?? "Scrut";
        $Act = $this->sessionRead($chxAct)[0] ?? "index";
        /**
         * mémorisation de la clef choisie
         */
        $url = ["controller" => $Ctl, 'action' => $Act];
        return $this->redirect($url);
    }

    /**
     * Active la source des données et réinitialise l'affichage.
     * Source : TEST ou PRODUCTION
     *
     * @param mixed $param
     */
    public function changeDataSource()
    {
        $dsname = $this->isInProd() ? self::NDS_TEST : self::NDS_PROD;
        $this->setActiveDataSourceName($dsname);
        /*
         * $_SESSION['dsname'] = $dsname;
         * TableRegistry::clear();
         */
        $this->redirect($this->request->getEnv('HTTP_REFERER'));
    }

    /**
     * Execute une procédure / fonction stockée pour Oracle
     *
     * @param array $param : nécessaire pour executer la procstock,
     * "method" est le nom de la procédure,
     *
     * arrayParams est un tableau contenant
     * chaque occurrence (tableau de paramètres) à exécuter,
     *
     * @return array : array [
     *                          'isOk'=> boolean,
     *                          'Result' => mixed|string in case of error.
     *                      ]
     */
    public function methodeStockee(array &$param)
    {
        $result = null;
        $errorContext = ['scope' => ['error']];
        $msgArray = [
            __METHOD__ . __(" :: Manque le paramètre 'method'."),
            __METHOD__ . __(" :: Manque le paramètre tableau 'arrayParams'."),
            __METHOD__ . __(" :: Un arrayParam n'est pas un tableau !"),
            __METHOD__ . __(" :: Le paramètre tableau doit être NON vide !"),
        ];
        /*
         * scope pour fichier procstock.log
         */
        $logContext = ['scope' => ['procstock']];

        /*
         * Vérif. du nécessaire pour l'exécution de la proc.
         */
        $isOk = ([] !== $param);
        if (!$isOk) { // Pb détecté
            $result = $msgArray[3];
            $this->log($result);
            return ["isOk" => $isOk, "Result" => $result];
        }

        /*
         * Vérif. du nécessaire pour l'exécution de la proc.
         */
        $isOk = (\key_exists("method", $param));
        if (!$isOk) { // Pb détecté
            $result = $msgArray[0];
            $this->log($result);
            return ["isOk" => $isOk, "Result" => $result];
        }

        $isOk = (\key_exists("arrayParams", $param));
        if (!$isOk) { // Pb détecté
            $result = $msgArray[1];
            $this->log($result);
            return ["isOk" => $isOk, "Result" => $result];
        }

        /*
         *  Nom Procédure Stockée
         */
        try {
            $options = ['method' => $param["method"]];
            //$alias = "GR";
            $alias = $param["method"];
            $method = MethodRegistry::get($alias, $options);
            $conn = $this->getActiveConnexion();
            $method->connection($conn);
            $request = $method->newRequest();
        } catch (Exception $exc) {
            $isOk = false;
            // $result = $exc->getTraceAsString();
            $msg = $exc->getMessage();
            $result = $msg;
            //$this->log($result);
            $tag = Chronos::now()->format("YmdHis");
            $tag .= " " . __METHOD__ . "::" . __LINE__;
            Log::debug(">" . $tag); //, $errorContext);
            Log::debug($msg); //, $errorContext);
            Log::debug("<" . $tag); //, $errorContext);
            $mdbg = __("Vérifier dans debug.log au Tag [{0}]", $tag);
            $this->Flash->error($mdbg);
            return ["isOk" => $isOk, "Result" => $result];
        }

        /*
         * Exécute méthode autant de fois que nécessaire
         * utile pour effectuer une sélection multiple,
         * si c'est une procédure par exemple !
         */

        $arrayParams = $param["arrayParams"];
        $strParams = "";
        foreach ($arrayParams as $nieme => $arrayParam) {
            $isOk = is_array($arrayParam);
            if (!$isOk) {
                $msg = __METHOD__
                    . __("::: $nieme-ième occurence de tableau de paramètres");

                $this->log($msg);
                $this->log($msgArray[2]);

                $result[] = $msg;
                $result[] = $msgArray[2];
                break; // sort de foreach
            }

            /*
             * Paramètres de la $nieme exécution de la méthode
             */
            $strParams = "";
            foreach ($arrayParam as $key => $value) {
                $request->set($key, (string) $value);
                $strParams .= " <" . $key . "> => <" . (string) $value . ">";
            }
            /* n-ième éxecution de la méthode */
            try {
                /*
                 * https://github.com/CakeDC/cakephp-oracle-driver/blob/master/docs/Methods.md
                 */
                $nmeth = strtoupper($param["method"]);

                Log::info("> : " . $nmeth . $strParams, $logContext);
                /* Exécution de la méthode */
                /** dd(__METHOD__, $request, $method); */
                $toto = $method->execute($request);
                /** dd(__METHOD__, $toto, $request, $method); */
                /* Récupère les paramètres en cas de INOUT */
                $param["afterRequest"][$nieme] = $request->toArray();
                /* Résultat de fonction stockée. */
                $result = $request->result(); // Null si procédure
                /* Récupère paramètres en sortie pour out */
                foreach ($param["afterRequest"][$nieme] as $key => $value) {
                    if (array_key_exists($key, $arrayParam)) {
                        if ($arrayParam[$key] != $value) {
                            $param["out"][$nieme][$key] = $value;
                        }
                    }
                }
                if (!is_null($result)) { // une fonction ?
                    $strResult = print_r($result, true);
                    Log::info("< : " . $nmeth . " : " . $strResult, $logContext);
                } else {
                    if (array_key_exists("out", $param)) {
                        $inout = " ";
                        foreach ($param["out"][$nieme] as $key => $value) {
                            $inout .= "<$key> => <$value>,";
                        }
                        Log::info("< : " . $nmeth . $inout, $logContext);
                    }
                }
            } catch (\Exception $exc) {
                $isOk = false;
                $tag = Chronos::now()->format("YmdHis");
                $tag .= " " . __METHOD__ . "::" . __LINE__;
                Log::debug(">" . $tag); //, $errorContext);
                $result[] = __METHOD__ . "::" . __LINE__
                    . __(
                        ":: Pb sur occurence [{nieme}] ",
                        ["nieme" => $nieme]
                    );
                /*
                 * Le message d'erreur reçu.
                 */
                $msg = $exc->getMessage();
                $result[] = $msg;
                Log::debug(end($result));
                /*
                 * Les paramètres pour l'occurrence.
                 */
                $result[] = $request->__debugInfo();
                Log::debug(end($result));
                $result[] = $method->_generateSql();
                Log::debug(end($result));

                $result = $msg;
                //$this->log($result);
                Log::debug("<" . $tag); //, $errorContext);
                $mdbg = __(
                    "Vérifier dans error.log debug.log entre le Tag [{0}]",
                    $tag
                );
                $this->Flash->error($mdbg);
                /*
                 * msg spécifique pour procstock.log
                 */
                Log::info(print_r($result, true), $logContext);
                /*
                 * on pisse des lignes d'erreur pour info.log et error.log
                 */
                /* $result[] = $exc; Ne  pas renvoyer cela! */
                /* Message Flash doit rester court !! */
                // Log::info(print_r($exc, true)); // aucun interêt a priori
                /*
                 * break : Termine la boucle foreach principale.
                 *
                 * https://www.php.net/manual/fr/control-structures.break.php
                 *
                 */
                break;
            }
        }

        return ["isOk" => $isOk, "Result" => $result];
    }

    /**
     * Renvoie la variable, de session, sous forme de tableau.
     *
     * utiliser la syntaxe à point (dot notation)
     *
     * dot notation
     * Dot notation defines an array path, by separating nested levels with .
     * For example:
     *
     * Asset.filter.css
     *
     * Would point to the following value:
     *
     * array(
     *     'Asset' => array(
     *        'filter' => array(
     *             'css' => 'got me'
     *         )
     *     )
     * )
     *
     * @param string $nom
     * @return array
     */
    public function sessionRead($nom = '')
    {
        $session = $this->request->getSession(); // accès Session
        return (array) $session->read($nom);
    }

    /**
     * Check if data exists in the session
     * Vérifie si une donnée existe en Session
     * @param string $nom
     * @return bool - true if data exists, false if not.
     */
    public function sessionCheck($nom = '')
    {
        $session = $this->request->getSession(); // accès Session
        return $session->check($nom);
    }

    /**
     *
     * @param string - $nom de la section en Session.
     * @param array  - $Urlparams tableau des paramètres à sauvegarder.
     */
    public function sessionSauveUrlParams($nom = '', $Urlparams = [])
    {
        if (!is_null($nom)) {
            $session = $this->request->getSession(); // accès Session
            if (!is_array($Urlparams)) {
                $Urlparams = [$Urlparams];
            }
            //dd(__METHOD__ . ":" . __LINE__, $nom, $params);
            $session->write([$nom => $Urlparams]); // sauvegarde
        }
    }

    public function sessionMergeGetParams($nom = '')
    {
        if (!$this->request->is('get')) {
            throw new Exception(
                __METHOD__ . ":" . __LINE__ . " :: " .
                    "Ce n'est pas une requête de type GET."
            );
        }
        $this->sessionMergeArray($nom, $this->request->getQueryParams());
    }

    /**
     *
     * @param string $nom - nom de la zone tableau à mettre à jour
     * @param array $params - nouveau tableau contenant les mises à jour.
     */
    public function sessionMergeArray(string $nom, $params = [])
    {
        $avant = $this->sessionRead($nom);
        if (!is_array($avant)) {
            throw new Exception(
                __METHOD__ . ":" . __LINE__ . " :: "
                    . " paramètre 1 [$nom] n'est pas un tableau !"
            );
        }
        if (!is_array($params)) {
            throw new Exception(
                __METHOD__ . ":" . __LINE__ . " :: "
                    . " paramètre 2 n'est pas un tableau !"
            );
        }
        // $avant ou $this->readSession($nom) ?
        $this->sessionWrite($nom, array_merge($avant, $params));
    }

    /**
     * Écrit directement en session
     * @param string $nom
     * @param mixed $params
     */
    public function sessionWrite($nom, $params)
    {
        $session = $this->request->getSession(); // accès Session
        $session->write([$nom => $params]); // sauvegarde
    }

    /**
     * Écrit directement en session
     * @param string $nom
     * @param mixed $params
     */
    public function sessionDelete($nom = "")
    {
        $absence = !$this->sessionCheck($nom);
        if (!$absence) {
            $session = $this->request->getSession(); // accès Session
            $absence = $session->delete($nom);
        }
        return $absence;
    }

    /**
     * En vue de la gestion des différentes modifications possibles,
     * mémorise en session la totalité des infos d'un scrutin.
     * @param array $pkScrut tableau asso contenant elec_cle et scru_tour
     */
    protected function modifScrutinCandidatureMemorise(array $pk)
    {
        $kWanted = [AppTable::CANDID];
        $clef = $this->arrayFilterByKeysWanted($pk, $kWanted);
        /** Détermination complète et sauvegarde
         * du scrutin
         *
         */
        $this->modifScrutin1EntityMemorise(
            $clef,
            AppTable::SETTBLCAND,
            "candidature"
        );
        /**
         * Génère automatiquement l'entité Candidate correspondante
         */
        /**
         * Abandonné car génère une erreur inratrappable facilement.
         * ORA-00972: l'identificateur est trop long
         *
         * SQL Query:
         * SELECT entite_candidate.ENTI_CAN_NO AS "entite_candidate__ENTI_CAN_NO",
         * entite_candidate.TYEN_CODE AS "entite_candidate__TYEN_CODE",
         * entite_candidate.ENTI_CAN_DESI
         * AS "entite_candidate__ENTI_CAN_DESI" <-- 31 carac. limite à 30 !
         * FROM entite_candidate entite_candidate WHERE ENTI_CAN_NO = :c0
         *
         *         $pk = $this->modifScrutinCandidatureLireValue(AppTable::ENTCANNO);
         *         $this->modifScrutin1EntityMemorise(
         *                [AppTable::ENTCANNO => $pk,]
         *                , AppTable::SETTBLENTITECAND
         *                , "entite_candidature"
         *         );
         *
         *
         */
    }

    protected function modifScrutinCandidatureSupprime(array $pk)
    {
        $clef = $this->arrayFilterByKeysWanted(
            $pk,
            [AppTable::CANDID]
        );
        /** Détermination complète et sauvegarde
         * du scrutin
         *
         */
        $this->modifScrutin1EntitySupprime(
            $clef,
            AppTable::SETTBLCAND,
            "candidature"
        );
    }

    /**
     * Renvoie la valeur d'un champ,
     * de la candidature à modifier
     * ou l'entity (le tableau entier)
     * si $champ est une chaîne vide.
     *
     * @param string $champ
     * @return string|array  - array only if $champ is empty string
     */
    protected function modifScrutinCandidatureLireValue(string $champ = "")
    {
        $tablo = self::MODIFSCRUTIN . "." . "candidature";
        $arrResult = $this->sessionRead($tablo);
        $result = ("" === $champ) ? $arrResult : $arrResult[$champ];
        return $result;
    }

    /**
     * En vue de la gestion des différentes modifications possibles,
     * mémorise en session la totalité des infos d'un scrutin.
     * @param array $pkScrut tableau asso contenant elec_cle et scru_tour
     */
    protected function modifScrutinScrutinMemorise(array $pk)
    {
        $kWanted = [AppTable::ELECCLE, AppTable::SCRUTTOUR];
        $clef = $this->arrayFilterByKeysWanted($pk, $kWanted);
        /** Détermination complète et sauvegarde
         * du scrutin
         *
         */
        $this->modifScrutin1EntityMemorise(
            $clef,
            AppTable::SETTABELECSCRUT,
            "scrutin"
        );
    }

    /**
     *
     */
    protected function modifScrutinScrutinSupprime(array $pk)
    {
        $clef = $this->arrayFilterByKeysWanted(
            $pk,
            [AppTable::ELECCLE, AppTable::SCRUTTOUR]
        );
        /** Détermination complète et sauvegarde
         * du scrutin
         *
         */
        $this->modifScrutin1EntitySupprime(
            $clef,
            AppTable::SETTABELECSCRUT,
            "scrutin"
        );
    }

    /**
     * Renvoie le tableau associatif des valeurs du scrutin courant
     * dont les clefs sont spécifiées.
     *
     * @param array $keys - tableau indexé des clefs dont les valeurs sont demandées.
     * @return array $result - tableau associatif keys => values
     */
    protected function modifScrutinExtractArrayScrutin(array $keys = [])
    {
        return $this->arrayFilterByKeysWanted(
            $this->modifScrutinScrutinLire(),
            $keys
        );
    }

    /**
     * Renvoie les couples valeur clef demandés de l'entité Géo.
     * @param array $keys
     * @return array
     */
    protected function modifScrutinExtractArrayEnGeo(array $keys = [])
    {
        return $this->arrayFilterByKeysWanted(
            $this->modifScrutinEnGeoLire(),
            $keys
        );
    }

    /**
     * En vue de la gestion des différentes modifications possibles,
     * mémorise en session la totalité des infos d'un scrutin.
     * @param array $pkScrut tableau asso contenant elec_cle et scru_tour
     */
    protected function modifScrutinMemoriseTraitement(string $traitement)
    {
        $nom = self::MODIFSCRUTIN;
        $this->sessionWrite($nom . "." . "traitement", [$nom => $traitement]);
    }

    /**
     * renvoie le nom dutraitement en cours pour modifier un scrutin
     * @return string le nom du traitement en cours
     */
    protected function modifScrutinLireTraitement()
    {
        $nom = self::MODIFSCRUTIN;
        return $this->sessionRead($nom . "." . "traitement" . "." . $nom)[0];
    }

    /**
     * En vue de la gestion des différentes modifications possibles,
     * mémorise en session la totalité des infos d'un scrutin.
     * @param array $pkScrut tableau asso contenant elec_cle et scru_tour
     */
    protected function modifScrutinEnGeoMemorise(array $pk)
    {
        $clef = $this->arrayFilterByKeysWanted($pk, [AppTable::EGCLE]);
        /** Détermination complète et sauvegarde
         * de l'entité géographique
         *
         */
        $this->modifScrutin1EntityMemorise($clef, "Engeo", "entiteGeo");
    }

    protected function modifScrutinEnGeoSupprime(array $pk)
    {
        $clef = $this->arrayFilterByKeysWanted($pk, [AppTable::EGCLE]);
        /** Détermination complète et sauvegarde
         * de l'entité géographique
         *
         */
        $this->modifScrutin1EntitySupprime($clef, "Engeo", "entiteGeo");
    }

    /**
     * Généralisation de la mémorisation d'un entité
     * en vue de modifier un scrutin.
     *
     * @param type $pk Clef primaire de l'entité à mémoriser.
     * @param type $ntable nom de la table contenant l'entité.
     * @param type $nsession nom de la variable mémoire où mémoriser.
     */
    protected function modifScrutin1EntityMemorise($pk, $ntable, $nsession)
    {
        /** Détermination complète du scrutin
         *
         */
        $table = $this->getTableLocator()->get(
            $ntable,
            ['connection' => $this->getActiveConnexion(), 'table' => $ntable]
        );
        $entity = $table->find()->where($pk)->first()->toArray();
        $nom = self::MODIFSCRUTIN;
        $this->sessionWrite($nom . "." . $nsession, $entity);
    }

    protected function modifScrutin1EntitySupprime($pk, $ntable, $nsession)
    {
        /** Détermination complète du scrutin
         *
         */
        $table = $this->getTableLocator()->get(
            $ntable,
            ['connection' => $this->getActiveConnexion()]
        );
        $entity = $table->find()->where($pk)->first()->toArray();
        $nom = self::MODIFSCRUTIN;
        $this->sessionDelete($nom . "." . $nsession, $entity);
    }

    /**
     * Renvoyer soit le tableau , soit la valeur d'un champ d'un sous tableau
     * @param string $champ
     * @param string $soustableau
     * @return array|mixed
     */
    private function modifScrutinLire(string $champ, string $tablo)
    {
        $table = self::MODIFSCRUTIN . "." . $tablo;
        $arrResult = $this->sessionRead($table);
        return ("" === $champ) ? $arrResult : $arrResult[$champ];
    }

    /**
     * Renvoie un champ, ou l'entité, du scrutin à modifier
     *
     * @param string $champ -
     *
     * @return mixed array if $champ is empty string
     */
    protected function modifScrutinScrutinLire(string $champ = "")
    {
        return $this->modifScrutinLire($champ, "scrutin");
        /*
          $tablo = self::MODIFSCRUTIN . "." . "scrutin";
          $arrResult = $this->sessionRead($tablo);
          $result = ("" === $champ) ? $arrResult : $arrResult[$champ];
          return $result;
         *
         */
    }

    /**
     * Renvoie un champ, ou l'entité, de l'entité géogr. à modifier
     *
     * @param string $champ -
     *
     * @return mixed array if $champ is empty string
     */
    protected function modifScrutinEnGeoLire(string $champ = "")
    {
        return $this->modifScrutinLire($champ, "entiteGeo");
    }

    /**
     *
     * @return bool vrai si un Scrutin est sélectionné, faux sinon
     */
    protected function isScrutinSelectedExist()
    {
        return ([] !== $this->modifScrutinScrutinLire());
    }

    /**
     * Vérifie existence de l'entitéé géo selectionnée
     *
     * @return bool vrai si un Scrutin est sélectionné, faux sinon
     */
    protected function isEntGeoSelectedExist()
    {
        return ([] !== $this->modifScrutinEnGeoLire());
    }

    /**
     * Fournit les données pour afficher le scrutin sélectionné depuis la vue
     *
     * @return response
     */
    public function getscrutinselected()
    {
        try {
            $tmp = $this->modifScrutinScrutinLire();
            if (is_array($tmp)) {
                $rows[] = $tmp;
            } else {
                $rows = $tmp->toArray();
            }
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $total = count($rows); // forcément !
        $this->renderEasyUIDatagrid($total, $rows);
    }

    /**
     * Fournit les données pour afficher l'entité géogr. sélectionnée depuis la vue.
     */
    public function getengeoselected()
    {
        try {
            $rows[] = $this->modifScrutinEnGeoLire();
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $total = 1; // forcément !
        $this->renderEasyUIDatagrid($total, $rows);
    }

    /**
     * Fournit les données pour afficher les données
     * du résultat du scrutin de la circ. électorale
     */
    public function getRsltsScrEg()
    {
        $kElCle = AppTable::ELECCLE;
        $kInCle = AppTable::INDICLE;
        $kTour = AppTable::SCRUTTOUR;
        $kEgCle = AppTable::EGCLE;
        $kTyEgCode = AppTable::TYEGCODE;

        $vElCle = $this->modifScrutinScrutinLire($kElCle);
        $vInCle = $this->modifScrutinScrutinLire($kInCle);
        $vTour = $this->modifScrutinScrutinLire($kTour);
        $vEgCle = $this->modifScrutinEnGeoLire($kEgCle);
        $vTyEgCode = $this->modifScrutinEnGeoLire($kTyEgCode);
        $param = [
            $kElCle => $vElCle,
            $kInCle => $vInCle,
            $kTour => $vTour,
            $kEgCle => $vEgCle,
            $kTyEgCode => $vTyEgCode,
        ];
        try {
            $tmp = $this->selectRsltsScrEg($param);

            if (is_array($tmp)) {
                $rows[] = $tmp;
            } else {
                $rows = $tmp->toArray();
            }

            /**
             * Calcul de l'abstention
             */
            $opt = ["multiply" => true];
            foreach ($rows as $key => $value) {
                $abs = 1 - $value["RESU_SCR_VOT"] / $value["RESU_SCR_INS"];
                $rows[$key]["ABSTENTION"] = Number::toPercentage($abs, 2, $opt);
            }
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $total = count($rows); // forcément !
        $this->renderEasyUIDatagrid($total, $rows);
    }

    public function shortDateDdMmYyyyFromOracle(string $dateFromOracle)
    {
        /**
         * string reçue de la forme : '23/03/2014 00:00:00'
         */
        $result = explode(" ", $dateFromOracle);
        return $result[0];
    }

    /**
     * Renvoie le statement (le query)
     * de la liste des candidatures d'une EG d'un Scrutin.
     * @param array $params paramètres de filtrage
     * @result \Cake\ORM\Query le query (statement) associé à ce select.
     */
    protected function stmtSelCandEgLst(array $param = [])
    {
        /**
         * Au moment où j'écris cette fonction
         * il m'apparait plus simple de ne pas créer
         * un Controller ou une Table spécifique pour CANDIDATURE EG
         */
        /**
         * SELECT
         *  C.CAND_ID,
         *  C.ENTI_CAN_NO AS LISTE_NO,
         *  EC1.ENTI_CAN_DESI AS LISTE_DESI,
         *  C.ETIQ_CLE AS LISTE_ETIQ,
         *  CL.ENTI_CAN_NO AS CAND_NO,
         *  EC2.ENTI_CAN_DESI AS CAND_DESI,
         *  CL.ETIQ_CLE AS CAND_ETIQ,
         * ici la date texte au format dd/mm/yyy
         *  tereadm1.concat_cvs(CL.ENTI_CAN_NO, 'Int', ?) AS CVS,
         *  CL.CAND_LIST_TYP_SORT,
         *  CL.CAND_LIST_LIB,
         *  C.CAND_LIB_2
         * FROM
         *  CANDIDATURE C,
         *  ENTITE_CANDIDATE EC1,
         *  CANDIDAT_DE_LA_LISTE CL,
         *  ENTITE_CANDIDATE EC2
         * WHERE
         *  C.ENTI_CAN_NO = EC1.ENTI_CAN_NO
         *  AND C.CAND_ID = CL.CAND_ID (+)
         *  AND CL.ENTI_CAN_NO = EC2.ENTI_CAN_NO (+)
         *  AND (C.ELEC_CLE = ?)
         *  AND (C.SCRU_TOUR = ?)
         *  AND (C.ENTG_CLE = ?)
         *  AND (CL.CAND_LIST_CODE (+) = 1)
         * ORDER BY 3
         */
        /* Préparation du query de la table Candidature */
        $table = $this->getTableLocator()->get(
            AppTable::SETTBLCAND,
            ['connection' => $this->getActiveConnexion()]
        );
        $stmt = $table->query();
        /* Préparation du filtrage */
        $kNeeded = [AppTable::SCRUTDATE,];
        $dateScrutin = $this->arrayFilterByKeysWanted($param, $kNeeded);
        $kWhere = [AppTable::ELECCLE, AppTable::EGCLE, AppTable::SCRUTTOUR,];
        $where = $this->arrayFilterByKeysWanted($param, $kWhere);
        /**
         * Il faut retravailler la forme des clefs de paramètres
         */
        $keys = array_keys($where);
        $values = array_values($where);
        $callback = function ($k) {
            return "C." . $k;
        };
        $longKeys = array_map($callback, $keys);
        $longParams = array_combine($longKeys, $values);

        //->select($table) // tout champ de la table
        $stmt->select(
            [
                "CAND_ID" => "C.CAND_ID",
                "LISTE_NO" => "C.ENTI_CAN_NO",
                "LISTE_DESI" => "EC1.ENTI_CAN_DESI",
                "LISTE_ETIQ" => "C.ETIQ_CLE",
                "CAND_NO" => "CL.ENTI_CAN_NO",
                "CAND_DESI" => "EC2.ENTI_CAN_DESI",
                "CAND_ETIQ" => "CL.ETIQ_CLE",
            ]
        );
        /* Insertion de la date du scrutin au format string 'dd/mm/yyyy' */
        if ([] !== $dateScrutin) {
            $stmt->select(
                [
                    "CVS" =>
                    "tereadm1.concat_cvs(CL.ENTI_CAN_NO, 'Int', '"
                        . $this->shortDateDdMmYyyyFromOracle(
                            $dateScrutin[AppTable::SCRUTDATE]
                        )
                        . "')",
                ]
            );
        }
        $stmt->select(
            [
                "CAND_LIST_TYP_SORT" => "CL.CAND_LIST_TYP_SORT",
                "CAND_LIST_LIB" => "CL.CAND_LIST_LIB",
                "CAND_LIB_2" => "C.CAND_LIB_2",
            ]
        )
            ->from(
                [
                    "C" => AppTable::SETTBLCAND,
                    "EC1" => AppTable::SETTBLENTITECAND,
                    "CL" => AppTable::SETTBLCAND2LIST,
                    "EC2" => AppTable::SETTBLENTITECAND,
                ]
            )
            ->where(
                [
                    "C.ENTI_CAN_NO = EC1.ENTI_CAN_NO",
                    "C.CAND_ID = CL.CAND_ID (+)",
                    "CL.ENTI_CAN_NO = EC2.ENTI_CAN_NO (+)",
                    "CL.CAND_LIST_CODE (+) = 1",
                ]
            )
            ->where($longParams);
        return $stmt;
    }

    /**
     * Renvoie le nombre de
     * de la liste des candidatures d'une EG d'un Scrutin.
     * @param array $params SelElec, SelNumTour, selEntgCle
     * @return int :  Le nombre de candidature , -1 si problème.
     */
    protected function compteSelCandEgLst($param)
    {
        try {
            $stmt = $this->stmtCandEg($param);
            $result = $stmt->count();
        } catch (\Exception $exc) {
            $result = -1;
        }
        return $result;
    }

    /**
     *
     */
    public function getCand1Eg1Sc()
    {
        $filtre = [
            AppTable::ELECCLE => $this->modifScrutinScrutinLire(AppTable::ELECCLE),
            AppTable::SCRUTTOUR => $this->modifScrutinScrutinLire(AppTable::SCRUTTOUR),
            AppTable::EGCLE => $this->modifScrutinEnGeoLire(AppTable::EGCLE),
            /* Ce dernier paramètre pour l'affichage */
            AppTable::SCRUTDATE => $this->modifScrutinScrutinLire(AppTable::SCRUTDATE),
        ];

        try {
            $tmp = $this->stmtSelCandEgLst($filtre)

                //->stmtCandEg($param)
                ->enableHydration(false)->all();
            //  dd(__METHOD__, $tmp->toArray());
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $this->renderResultSet2EasyUIDatagrid($tmp);
        /*
          $rows = [];
          if (is_array($tmp)) {
          $rows[] = $tmp;
          } else {
          $rows = $tmp->toArray();
          // dd(__METHOD__, $tmp, $rows);
          }
          $total = count($rows); // forcément !
          $this->renderEasyUIDatagrid($total, $rows);
         */
    }

    public function selectAsArraySelCandEgLst($param)
    {
        /**
         * Clef du champ d'affichage paramétrable
         */
        $kAffichage = [AppTable::SCRUTDATE];
        /**
         * Clefs utiles pour le filtrage
         */
        $kWhere = [AppTable::ELECCLE, AppTable::SCRUTTOUR, AppTable::EGCLE];

        /**
         * Extraction des clefs du tableau des paramètres
         */
        $aff = $this->arrayFilterByKeysWanted($param, $kAffichage);
        $where = $this->arrayFilterByKeysWanted($param, $kWhere);

        if ([] === $aff) {
            /**
             * Forçage valeur de la date du scrutin
             */
            $aff = [AppTable::SCRUTDATE =>
            $this->modifScrutinScrutinLire(AppTable::SCRUTDATE)];
        }

        /**
         * Reconstruction d'un tableau de conditions valides
         */
        $cond = \array_merge($aff, $where);
        $stmt = $this->stmtRsltsScrEg($cond)->enableHydration(false);
        return $stmt->all()->toArray();
    }

    /**
     * Renvoie le statement (le query) des résultats d'une EG d'un Scrutin.
     * @param array $params paramètres de filtrage
     * @result le statement associé à ce select.
     */
    private function stmtRsltsScrEg(array $param = [])
    {
        /**
         * Au moment où j'écris cette fonction
         * il m'apparait plus simple de ne pas créer
         * un Controller ou une Table spécifique pour RESULTAT_SCRUTIN
         */
        /**
         * SELECT
         *  ENT_GEO_SCRUTIN.EGEO_SIEGES AS EGEO_SIEGES,
         *  RESULTAT_SCRUTIN.*,
         *  ENT_GEO_SCRUTIN.EGEO_LIBEL AS EGEO_LIBEL,
         *  ENT_GEO_SCRUTIN.EGEO_LIBEL_2 AS EGEO_LIBEL_2
         * FROM
         *  RESULTAT_SCRUTIN, ENT_GEO_SCRUTIN
         * WHERE
         *  RESULTAT_SCRUTIN.INDI_CLE = ENT_GEO_SCRUTIN.INDI_CLE
         *  AND RESULTAT_SCRUTIN.ENTG_CLE = ENT_GEO_SCRUTIN.ENTG_CLE
         *  AND RESULTAT_SCRUTIN.ELEC_CLE = ENT_GEO_SCRUTIN.ELEC_CLE
         *  AND RESULTAT_SCRUTIN.SCRU_TOUR = ENT_GEO_SCRUTIN.SCRU_TOUR
         *  AND (RESULTAT_SCRUTIN.ELEC_CLE = ?)
         *  AND (RESULTAT_SCRUTIN.INDI_CLE = ?)
         *  AND (RESULTAT_SCRUTIN.SCRU_TOUR = ?)
         *  AND (RESULTAT_SCRUTIN.ENTG_CLE = ?)
         *  AND (RESULTAT_SCRUTIN.TYEG_CODE = ?)
         */
        /**
         * Il faut retravailler la forme des clefs de paramètres
         */
        $keys = array_keys($param);
        $values = array_values($param);
        $callback = function ($k) {
            return "resultat_scrutin." . $k;
        };
        $longKeys = array_map($callback, $keys);
        $longParams = array_combine($longKeys, $values);

        $table = $this->getTableLocator()->get(
            AppTable::SETTBLRES,
            ['connection' => $this->getActiveConnexion()]
        );
        $stmt = $table->query()
            ->select($table) // tout champ de la table
            ->select(
                [
                    "egeo_sieges" => "ent_geo_scrutin.egeo_sieges",
                    "egeo_libel" => "ent_geo_scrutin.egeo_libel",
                    "egeo_libel_2" => "ent_geo_scrutin.egeo_libel_2",
                ]
            )
            ->from([AppTable::SETTBLRES, "ent_geo_scrutin"])
            ->where(
                [
                    "resultat_scrutin.indi_cle = ent_geo_scrutin.indi_cle",
                    "resultat_scrutin.entg_cle = ent_geo_scrutin.entg_cle",
                    "resultat_scrutin.elec_cle = ent_geo_scrutin.elec_cle",
                    "resultat_scrutin.scru_tour = ent_geo_scrutin.scru_tour",
                ]
            )
            ->where($longParams);
        return $stmt;
    }

    /**
     * Renvoie la liste des résultats d'une EG d'un Scrutin.
     * @param array $params paramètres de filtrage
     * @result array ce select.
     */
    public function selectRsltsScrEg(array $param = [])
    {
        $stmt = $this->stmtRsltsScrEg($param);
        return ($stmt->count() === 1) ? $stmt->first()->toArray() : [];
    }

    /**
     * renvoie le statement des Candidatures
     * d'une entité géo d'un indice de candidature
     * @param array $params SelElec, SelNumTour, selEntgCle, SelIndiCle
     * @return statement
     */
    private function stmtCandEg(array $param = [])
    {
        $kwanted = [
            AppTable:: ELECCLE,
            AppTable:: EGCLE,
            AppTable:: SCRUTTOUR,
            AppTable:: INDICLE,
            AppTable:: TYEGCODE,    // à peaufiner
        ];
        $cond = $this->arrayFilterByKeysWanted($param, $kwanted);
        // * Il faut retravailler la forme des clefs de paramètres
        $keys     = array_keys($cond);
        $values   = array_values($cond);
        $callback = function ($k) {
            // return AppTable::SETTBLRESUCAND . "." . $k;
            // return AppTable::SETTBLRESUCAND . "." . $k;
            return "RC" . "." . $k;
        };
        $longKeys   = array_map($callback, $keys);
        $longParams = array_combine($longKeys, $values);

        $table = $this->getTableLocator()->get(
            "RC",
            [
                'connection' => $this->getActiveConnexion(),
                'table'      => AppTable::SETTBLRESUCAND,
            ]
        );
        $stmt = $table
            ->query()
            ->select(
                [
                    'CAND_ID'             => 'RC.CAND_ID',
                    'ETIQ_CLE'            => 'C.ETIQ_CLE',
                    'ENTI_CAN_DESI'       => 'EC.ENTI_CAN_DESI',
                    'RESU_CAND_VOIX'      => 'RC.RESU_CAND_VOIX',
                    'RESU_CAND_SIEGES'    => 'RC.RESU_CAND_SIEGES',
                    'CAND_TYP_DEC'        => 'C.CAND_TYP_DEC',
                    "ENTI_CAN_NO"         => 'C.ENTI_CAN_NO',
                    "INDI_CLE"            => 'RC.INDI_CLE',
                    "ENTG_CLE"            => 'RC.ENTG_CLE',
                    "TYEG_CODE"           => 'RC.TYEG_CODE',
                    "ELEC_CLE"            => 'RC.ELEC_CLE',
                    "SCRU_TOUR"           => 'RC.SCRU_TOUR',
                    "CAND_LIST_TYP_SORT"  => 'CL.CAND_LIST_TYP_SORT',
                    "RESU_SCR_EXP"        => "RS.RESU_SCR_EXP",
                    "POURCENTAGE_EXPRIME" =>
                    "ROUND(RC.RESU_CAND_VOIX / RS.RESU_SCR_EXP * 100, 2)",
                ]
            )
            ->from(
                [
                    "CL" => AppTable::SETTBLCAND2LIST,
                    "RC" => AppTable::SETTBLRESUCAND,
                    "RS" => AppTable::SETTBLRES,
                    "C"  => AppTable::SETTBLCAND,
                    "EC" => "ENTITE_CANDIDATE",
                ]
            )
            ->where(
                [
                    "RC.CAND_ID = C.CAND_ID ",
                    "RC.ELEC_CLE = C.ELEC_CLE",
                    "RC.SCRU_TOUR = C.SCRU_TOUR",
                    "C.CAND_ID = CL.CAND_ID (+)",
                    "EC.ENTI_CAN_NO (+) = CL.ENTI_CAN_NO",
                    "CL.CAND_LIST_CODE (+) = 1",
                    "RC.INDI_CLE = RS.INDI_CLE",
                    "RC.SCRU_TOUR = RS.SCRU_TOUR",
                    "RC.ENTG_CLE = RS.ENTG_CLE",
                ]
            )
            ->where($longParams)
            ->orderDesc("RC.RESU_CAND_VOIX");
        //dd(__METHOD__, $cond, $stmt->enableHydration(false)->sql());
        return $stmt;
    }

    /**
     * Renvoie le nombre de candidature pour une Eg pour un scrutin donné
     * @param array $params SelElec, SelNumTour, selEntgCle, SelIndiCle
     * @return int :  Le nombre de candidature , -1 si problème.
     */
    protected function compteCandEg(array $param = [])
    {
        $stmt = $this->stmtCandEg($param);
        return $stmt->count();
    }

    public function selectCandEgAsArray($param)
    {
        $result = $this->stmtCandEg($param)
            ->enableHydration(false)
            ->all()
            //->toArray()
        ;
        //dd(__METHOD__, $result->toArray());
        return $result;
    }

    public function selectCandEg(array $param = [])
    {
        $result = $this->stmtCandEg($param)->all();
        //dd(__METHOD__, $result);
        return $result;
    }

    /**
     * Fournit les données pour afficher les données
     * du résultat du scrutin de la circ. électorale
     * @return type
     */
    public function getCandScrEg()
    {
        /*
         * scope pour fichier queries.log
         */
        $logContext = ['scope' => ['queries']];
        // * Les clefs nécessaires à la construction de données
        $keys = [
            AppTable::EGCLE,
            AppTable::SCRUTTOUR,
            AppTable::INDICLE,
            AppTable::ELECCLE
        ];
        // * Constitution des paramètres de requête, à partir de clefs.
        $param = $this->modifScrutinExtractArrayScrutin($keys);
        // * ENTGCLE est manquant. Il est stocké dans tableau EnGeo
        $paramEG = $this->modifScrutinExtractArrayEnGeo($keys);
        $param = array_merge($param, $paramEG);
        try {
            Log::info("> : " . __METHOD__, $logContext);
            $tmp = $this->stmtCandEg($param)->enableHydration(false)->all();
            Log::info("< : " . __METHOD__, $logContext);
            if (is_array($tmp)) {
                $rows[] = $tmp;
            } else {
                $rows = $tmp->toArray();
            }
        } catch (Exception $exc) {
            $this->Flash->error($exc->getTraceAsString());
            $url = ['controller' => $this->name, 'action' => 'index'];
            return $this->redirect($url);
        }
        $total = count($rows); // forcément !
        $this->renderEasyUIDatagrid($total, $rows);
    }
}