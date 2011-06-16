<?php
/**
 * File containing ezp\Content\Criteria\CriteriaCollection class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package API
 * @subpackage content/criteria
 */
namespace ezp\Content\Criteria;
use ezp\Content;

/**
 * Criteria collection to be used to "find" a content in a subtree
 * Example :
 * <code>
 * use ezp\Content\Repository as ContentRepository;
 *
 * $contentService = ContentRepository::get()->getContentService();
 * $c = $contentService->createCriteria();
 * $c->subtree( $parentLocation )
 *      ->where( $c->field->eq( "folder/name", "My folder name" ) )
 *      ->limit( 5 )
 *      ->offset( 0 );
 *
 * $result = $contentService->find( $c );
 * </code>
 */
class CriteriaCollection
{
    /**
     * Parent location to retrieve content from
     * @var ezp\Content\Location
     */
    protected $parentLocation;

    /**
     * Parent location Id to retrieve content from
     * @var integer
     */
    protected $parentLocationId;

    /**
     * Criterias for content retrieval filtering
     * @var array( Criteria|Criterion )
     */
    protected $criterias = array();

    /**
     * Criterias for content sorting
     * @var SortCriteriaCollection
     */
    protected $sortCriterias = array();

    /**
     * Maximum number of results that need to be returned by the query
     * @var integer
     */
    protected $limit;

    /**
     * Which row that will be first returned in result (starting from 0)
     * @var integer
     */
    protected $offset;

    /**
     * Logic expression object for this criteria collection for AND/OR association of criterias
     * @var LogicExpression
     */
    public $logic;

    /**
     * ArrayAccess object for FieldCriteriaCreation
     * <code>$c->field["folder/name"]->eq( "My folder name" )</code>
     * @var FieldForwarder
     */
    public $field;

    /**
     * Constructs a new CriteriaCollection
     */
    public function __construct()
    {
        $this->logic = new LogicExpression();
    }

    /**
     * Prepares a subtree content retrieval starting from $parentLocation
     * @param ezp\Content\Location $parentLocation
     * @return CriteriaCollection
     */
    public function subtree( Content\Location $parentLocation )
    {
        $this->parentLocation = $parentLocation;
        return $this;
    }

    /**
     * Prepares a subtree content retrieval starting from $parentLocationId
     * @param integer $parentLocationId
     * @return CriteriaCollection
     */
    public function subtreeById( $parentLocationId )
    {
        $this->parentLocationId = (int)$parentLocationId;
        return $this;
    }

    /**
     * Adds filter criterias
     * Arguments must be valid Criteria or Criterion objects
     * @return CriteriaCollection
     * @throws \InvalidArgumentException If at least one of the arguments is not a valid Criteria/Criterion object
     */
    public function where()
    {
        $args = func_get_args();

        foreach ( $args as $c )
        {
            if ( !$c instanceof Criteria || !$c instanceof Criterion )
            {
                throw new \InvalidArgumentException( "Arguments must be valid Criteria or Criterion objects" );
            }

            $this->criterias[] = $c;
        }

        return $this;
    }

    public function limit( $limit )
    {
        $this->limit = (int)$limit;
        return $this;
    }

    public function offset( $offset = 0 )
    {
        $this->offset = (int)$offset;
        return $this;
    }
}
?>