<?php

/**
 * PHP version 7.2.14
 *
 * Définiton commune à toute l'application d'une table.
 *
 * @category Toto
 * @package  Toto
 * @author   FMB <bouillerot@lemonde.fr>
 * @license http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link
 */

namespace App\Model\Table;

use ArrayObject;
use Cake\Chronos\Date;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\Table;
use Exception;

// use TheSeer\Tokenizer\Exception as Exception2;


// use Composer\Script\Event;

/**
 * Election Model
 *
 * @method \App\Model\Entity\Election get($primaryKey, $options = [])
 * @method \App\Model\Entity\Election newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Election[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Election|false save(EntityInterface $entity,
 * $options = [])
 * @method \App\Model\Entity\Election saveOrFail(EntityInterface $entity,
 * $options = [])
 * @method \App\Model\Entity\Election patchEntity(EntityInterface $entity,
 * array $data, array $options = [])
 * @method \App\Model\Entity\Election[]
 * patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Election findOrCreate($search,
 * callable $callback = null, $options = [])
 */
class AppTable extends Table
{
    /* Début des noms de Table */

    public const VCGEO = "Vcgeo";

    /**
     * Nom court (ORM) de la table EG_CANDIDATURE
     *
     * @var string
     */
    public const EGCAN = "Egcan";
    public const INCAN = "Incan"; // Indice Candidatures
    /* Fin des noms de Table */

    /* Datasource */
    public const KEYDATASOURCE = "nameDataSource";

    /**
     * Constantes Noms de Table
     * utiles entre autres pour $this->setTable()
     */
    public const SETTABELECT = "election"; // en minuscules !
    public const SETTABELECSCRUT = "v_elec_scrut";
    public const SETTBLRES = "resultat_scrutin";
    public const SETTBLRESUCAND = "resultat_candidature";
    public const SETTBLENTITECAND = "entite_candidate";
    public const SETTBLCAND2LIST = "candidat_de_la_liste";
    public const SETTBLCAND = "candidature";
    /**
     * Champ de Candidature
     */

    /**
     * Nom du champ identifiant une candidature
     *
     * @var string
     */
    public const CANDID = "CAND_ID";

    /**
     *  Description: nom du champ identifiant une entité candidate
     *
     * @var string
     */
    public const ENTCANNO = "ENTI_CAN_NO";
    /* Champs de Indices de candiddature INCAN */
    public const INDICLE = "INDI_CLE";
    /* Champs de Table Election */
    public const ELECCLE = "ELEC_CLE";
    public const ELECLIB = "ELEC_LIB";
    /**
     * Champs de Scrutin
     */

    /**
     * Nom du champ SCRU_TOUR
     *
     * @var String
     */
    public const SCRUTTOUR = "SCRU_TOUR";

    /**
     * Valeur du champ SCRU_TOUR
     *
     * @var String
     */
    public const SCRUTTOUR1 = "01";

    /**
     * Valeur du champ SCRU_TOUR
     *
     * @var String
     */
    public const SCRUTTOUR2 = "02";
    public const SCRUTDATE = "SCRU_DATE";
    /* Champs de Type ELection */
    public const TYELCODE = "TYEL_CODE";

    /**
     * Nom du champ correspondant
     * au type d'entité attendu pour un scrutin
     *
     * @var String
     */

    /**
     * @ type d'entité candidate
     */
    public const TYENCODE = "TYEN_CODE";

    /**
     * @ type d'entité candidate Personne
     */
    public const TYENPERS = "Personne";

    /**
     * @ type d'entité candidate Liste
     */
    public const TYENLIST = "Liste";

    /**
     * @ type d'entité candidate Réponse
     */
    public const TYENREPO = "Réponse";

    /**
     *  Champs de Type Classification des EG.
     */
    public const TYCLCODE = "TYCL_CODE";
    /* Champs de Type Entité Géo. */
    public const TYEGCODE = "TYEG_CODE";
    /**
     * Champs de Type Scrutin.
     */

    /**
     * Nom de champ type de scrutin
     *
     * @var String
     */
    public const TYSCCODE = "TYSC_CODE";

    /**
     * Valeur de Champ type de scrutin par défaut
     *
     * @var String
     */
    public const TYSCDEFT = "National";
    /* Champs de Type RT. */
    public const TYRTCODE = "TYRT_CODE";

    /**
     * Nom du champ de la table ENTITE_GEO
     * contenant le code INSEE du l'entité géogr.
     *
     * @var String
     */
    public const EGCODINSEE = "ENTG_CODINSEE";

    /**
     * Champ de Clef d'entité géographique.
     * nom du Champ ENTG_CLE de Table ENTITE_GEO
     *
     * @var string
     */
    public const EGCLE = "ENTG_CLE";
    public const EGDESI = "ENTG_DESI";

    /**
     * Attention !
     * Ce champ, pas son nom, est de type booléen.
     * Cependant son contenu a été «bizarrement» codé.
     * Dans la table EG_CANDIDATURE, ce champ a trois valeurs possibles.
     * false est codé par NULL ou 0
     * true est codé par -1
     *
     * @var string nom du Champ ENTG_SELECT de Table EG_CANDIDATURE
     */
    public const EGCANSEL = "ENTG_SELECT";
    /* Champs de Valeur Classif. Géo. */
    public const VACLVALE = "VACL_VALE";
    /* Tableau des champs date de l'application */
    public const HAYSTACKDATES = [
        self::SCRUTDATE,
    ];

    /**
     * Get the chosen connection name.
     *
     * This method is used to get the fallback connection name if an
     * instance is created through the TableLocator without a connection.
     *
     * @return string
     * @see    TableLocator::get()
     */
    public static function defaultConnectionName()
    {
        $key = self::KEYDATASOURCE;
        $result = parent::defaultConnectionName();
        if (isset($_SESSION) && key_exists($key, $_SESSION)) {
            $result = $_SESSION[$key];
        }

        return $result;
    }

    /**
     * Formate un champ date pour Oracle.
     *
     * @param string $k Nom du champ supposément de type Date
     * @param string $v Valeur du champ à formater
     *
     * @return string Résultat formaté selon le format $k
     */
    public function formateChampDate4Oracle(string $k, string $v)
    {
        // https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
        // return (in_array($k, self::HAYSTACKDATES)) ?
        // $this->formateStringDate4Oracle($v) : $v;
        if (in_array($k, self::HAYSTACKDATES)) {
            Log::info(__METHOD__ . "::Champ date connu [$k]");
            $v = $this->formateStringDate4Oracle($v);
        } else {
            Log::info(__METHOD__ . ":: Pas un champ date connu [$k]");
        }

        return $v;
    }




    /**
     * Assure le bon formatage d'une chaîne représentant une date
     *
     * @param string $strdate chaîne date
     *
     * @return string
     */
    public static function formateStringDate4Oracle(string $strdate)
    {
        $result = $strdate;
        Log::info(__METHOD__ . "::" . __LINE__ . ":: [$result]");
        $formats = [
            "Y/m/d",
            "d/m/Y",
        ];
        $isOk = false;
        $date = null;
        foreach ($formats as $format) {
            try {
                $date = Date::createFromFormat($format, substr($strdate, 0, 10));
                $result = $date->format("Y/m/d"); // format Oracle - supertere
                $isOk = true;
                break; // si bon, sortons ! se bon'e, vetur'ekster'u ! !
            } catch (\Exception $exc) {
                $isOk = false;
            }
        }

        if (!$isOk) {
            $msg = __("Formatage Date [{0}] impossible.", $strdate);
            Log::error(__METHOD__ . ":: $msg");
            throw new Exception($msg);
        }
        Log::info(__METHOD__ . "::" . __LINE__ . ":: formaté en [$result]");

        return $result;
    }

    /**
     * Vérifie et formate si nécessaire toute date.
     *
     * @param ArrayObject $data tableau
     *
     * @return ArrayObject tableau
     */
    public function formateArrayObjectDates(ArrayObject $data)
    {
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                Log::info("traite un tableau depuis " . __FUNCTION__);
                $data[$k] = $this->formateArrayDates($v);
            }

            if (is_string($v)) {
                Log::info(__METHOD__ . ":: " . "traite un nom de champ [$k]");
                $data[$k] = $this->formateChampDate4Oracle($k, $v);
            }
        }

        return $data;
    }

    /**
     * Idem formateArrayObjectDates mais pour un array
     *
     * @param array $data tableau
     *
     * @return array
     */
    public function formateArrayDates(array $data = [])
    {
        Log::info(__METHOD__ . "::" . __LINE__, $data);
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                Log::info("traite un tableau");
                $data[$k] = $this->formateArrayDates($v);
            }
            if (is_string($v)) {
                Log::info("traite un nom de champ [$k]");
                $data[$k] = $this->formateChampDate4Oracle($k, $v);
            }
        }
        return $data;

    }

    /**
     * Marshaling
     *
     * @param event       $event   object of something
     * @param ArrayObject $data    array ---
     * @param ArrayObject $options array of options of marshaling
     *
     * @return void
     */
    public function beforeMarshal(
        Event $event,
        ArrayObject $data,
        ArrayObject $options
    ) {
        Log::info(__METHOD__."::".__LINE__);
        // formate chaque date pour Oracle. form'as ĉio dat'o por'e Oracle
        $data = $this->formateArrayObjectDates($data);
    }
}
