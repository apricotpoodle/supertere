<?php

/**
 * Société  Éditrice du Monde.
 * Service Étude et Développement.
 * 80 Boulevard Blanqui 75013 Paris
 */

namespace App\Model\Filter;

use Cake\ORM\Query;
use Search\Model\Filter\Base;
use Search\Model\Filter\FilterCollection;

/**
 * Url
 * https: //github.com/FriendsOfCake/search/tree/master/docs
 * Filter collection classes
 * Apart from configuring filters through search mananger in your table class,
 * you can also create them as separate collection classes.
 * This helps in keeping your table's initialize() method uncluttered and
 * the filters are lazy loaded only when actually used.
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
 * 'collectionClass' => MyPostsCollection::class
 * ]);
 * You can also specify alternate collection class to use when making find call:
 *
 * // PostsController::action()
 * $query = $this->Posts
 *         ->find('search', [
 * 'search'     => $this->request->getQueryParams(),
 * 'collection' => 'posts_backend'
 *         ]);
 *     }
 * The above will use App\Model\Filter\PostsBackendCollection.
 */
class ScrutCollection extends FilterCollection
{

    /**
     * Initialisation
     *
     * @return void
     */
    public function initialize()
    {
        //->value(['ELEC_CLE', 'SCRU_TOUR'])
        $this
            ->value('SCRU_TOUR')
            ->value('ELEC_CLE')
            // Here we will alias the 'q' query param to search
            // the `Scrutin.SCRU_TOUR` and the `Scrutin.SCRU_DATE` fields,
            // using a LIKE match, with `%` both before and after.
            ->add(
                'q',
                'Search.Like',
                [
                'before'      => true,
                'after'       => true,
                'fieldMode'   => 'OR',
                'comparison'  => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field'       => [
                                    // Comparaison sur les champs suivants
                                    //'ELEC_CLE', pas une chaîne, ne karakter'ĉen'o
                                    //'SCRU_VALIDE', ne ĉeno
                                    //'SCRU_ACTIF', ne ĉeno
                                    'SCRU_TOUR',
                                    'SCRU_DATE',
                                    'SCRU_VALI_DATE',
                                    'Election.ELEC_LIB',
                                    'Election.TYEL_CODE',
                                    'Election.TYSC_CODE',
                ],
                'beforeProcess' =>
                function (Query $query, array $args, Base $filter) {
                    $query->contain('Election');
                },
                ]
            )
                /**
                 * Recherche sur ComboBox pour TYEL_CODE
                 */
                ->value(
                    'TYEL_CODE',
                    [
                        'field'         => 'Election.TYEL_CODE',
                        'beforeProcess' =>
                        function (Query $query, array $args, Base $filter) {
                            $query->contain('Election');
                        },
                    ]
                )
                /**
                 * Recherche sur ComboBox pour TYSC_CODE
                 */
                ->value(
                    'TYSC_CODE',
                    [
                        'field'         => 'Election.TYSC_CODE',
                        'beforeProcess' =>
                        function (Query $query, array $args, Base $filter) {
                            $query->contain('Election');
                        },
                    ]
                );
    }

    /**
     * À conserver pour documentation
     *
     * @return void
     *
    public function initialize_documentation_a_conserver()
    {
        $this->add(
            'foo',
            'Search.Callback',
            [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]
        );
        // More $this->add() calls here. The argument for FilterCollection::add()
        // are same as those of searchManager()->add() shown above.
    }
    */

}
