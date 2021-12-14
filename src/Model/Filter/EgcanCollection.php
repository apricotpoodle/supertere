<?php

/*
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

namespace App\Model\Filter;

use App\Model\Table\AppTable;
use Search\Model\Filter\FilterCollection;

/**
 * https://github.com/FriendsOfCake/search/tree/master/docs
 * Filter collection classes
 * Apart from configuring filters through search mananger in your table class,
 * you can also create them as separate collection classes.
 * This helps in keeping your table's initialize() method uncluttered and
 * the filters are lazy loaded only when actually used.
 *
 *
 * // src/Model/Filter/PostsCollection.php
 * namespace App\Model\Filter;
 *
 * use Search\Model\Filter\FilterCollection;
 *
 * class PostsCollection extends FilterCollection
 * {
 *     public function initialize()
 *     {
 *         $this->add('foo', 'Search.Callback', [
 *             'callback' => function ($query, $args, $filter) {
 *                 // Modify $query as required
 *             }
 *         ]);
 *         // More $this->add() calls here. The argument for FilterCollection::add()
 *         // are same as those of searchManager()->add() shown above.
 *     }
 * }
 * Conventionally if PostsCollection exists then it will be used as default
 * filter collection for PostsTable.
 *
 * You can also configure the Search behavior to use another collection class
 * as default using the collectionClass config:
 *
 * use App\Model\Filter\MyPostsCollection;
 *
 * // In PostsTable::initialize()
 * $this->addBehavior('Search.Search', [
 *     'collectionClass' => MyPostsCollection::class
 * ]);
 * You can also specify alternate collection class to use when making find call:
 *
 * // PostsController::action()
 *     $query = $this->Posts
 *         ->find('search', [
 *             'search' => $this->request->getQueryParams(),
 *             'collection' => 'posts_backend'
 *         ]);
 *     }
 * The above will use App\Model\Filter\PostsBackendCollection.
 *
 */
class EgcanCollection extends FilterCollection {

    public function initialize()
    {
        $this
                ->value('INDI_CLE')
                ->value('ENTG_CLE')
                ->value('TYEG_CODE')
                /**
                  ->value('ENTG_SELECT')
                 * Ici nous renommerons le paramètre de query 'ENTG_SELECT'
                 * pour chercher correctement.
                 * En effet le booléen 'ENTG_SELECT' a des valeurs
                 * stockées dans la base qui ne sont pas représentatives
                 * d'un fonctionnement standard pour un booléen.
                 * ------
                 * false codé NULL ou 0
                 * true codé -1     <<-- c'est n'importe quoi !
                 * ------
                 * Pour chercher correctement nous utiliserons
                 * une fonction de type dit "callback"
                 * 
                 */
                ->add('ENTG_SELECT', 'Search.Callback',
                        [
                    'callback' => function ($query, $args, $filter) {
                        // Modify $query as required
                        $nchp = AppTable::EGCANSEL;
                        if (key_exists($nchp, $args)) {
                            switch ($args[$nchp]) {
                                case "":
                                    // ne pas modifier le query
                                    break;
                                case "0":
                                    $query->where([$nchp => 0]);
                                    break;

                                default:
                                    $query->where([$nchp . " <> " => 0]);
                                    break;
                            }
                            /*
                              if (!$args[$nchp]) { //=== "0") {
                              $query->where([$nchp => 0]);
                              }
                              else {
                              $query->where([$nchp . " <> " => 0]);
                              }
                             */
                        }
                    }
                ])
                // Here we will alias the 'q' query param to search
                // the `Scrutin.SCRU_TOUR` and the `Scrutin.SCRU_DATE` fields,
                // using a LIKE match, with `%` both before and after.
                ->add('q', 'Search.Like',
                        [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'colType' => [
                        'ENTG_CLE' => 'string',
                        //'ENTG_SELECT' => 'boolean',
                        //'ENTG_SELECT' => 'integer',
                        'ENTG_SELECT' => 'string',
                    ],
                    'field' => [// Comparaison sur les champs suivants
                        // 'INDI_CLE',
                        'ENTG_CLE',
                        'TYEG_CODE',
                        'ENTG_DESI',
                        'ENTG_CODINSEE',
                        'ENTG_LIBELLE',
                        'ENTG_TYPO',
                        'ENTG_TRI',
                        'ENTG_SELECT',
                        'ENTG_GEOCODE',
                    ],
                ])
        ;
    }

    public function initialize_documentation_a_conserver()
    {
        $this->add('foo', 'Search.Callback',
                [
            'callback' => function ($query, $args, $filter) {
                // Modify $query as required
            }
        ]);
        // More $this->add() calls here. The argument for FilterCollection::add()
        // are same as those of searchManager()->add() shown above.
    }

}
