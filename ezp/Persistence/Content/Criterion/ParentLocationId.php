<?php
/**
 * File containing the ezp\Persistence\Content\Criterion\ParentLocationId
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 *
 */

namespace ezp\Persistence\Content\Criterion;
use ezp\Persistence\Content\Criterion,
    ezp\Persistence\Content\Interfaces\Criterion as CriterionInterface;

/**
 * A criterion that matches content based on its parent location id
 *
 * Own location id is done using {@see LocationId}
 *
 * Supported operators:
 * - IN: matches against a list of location ids
 * - EQ: matches against a unique location id
 */
class ParentLocationId extends Criterion implements CriterionInterface
{
    /**
     * Creates a new ParentLocationId criterion
     *
     * @param null $target Not used
     * @param string $operator
     *        Possible values:
     *        - Operator::IN: match parent locations against a list of locationId. $value must be an array of locationId
     *        - Operator::EQ: match parent locations against a single locationId. $value must be a single locationId
     * @param integer|array(integer) One or more locationId parent locations must be matched against
     *
     * @throw InvalidArgumentException if a non numeric id is given
     * @throw InvalidArgumentException if the value type doesn't match the operator
     */
    public function __construct( $target = null, $operator, $value )
    {
        parent::__construct( $target, $operator, $value );
    }

    public function getSpecifications()
    {
        return array(
            new OperatorSpecifications(
                Operator::IN,
                OperatorSpecifications::FORMAT_ARRAY,
                array( OperatorSpecifications::TYPE_INTEGER, OperatorSpecifications::TYPE_STRING )
            ),
            new OperatorSpecifications(
                Operator::EQ,
                OperatorSpecifications::FORMAT_SINGLE,
                array( OperatorSpecifications::TYPE_INTEGER, OperatorSpecifications::TYPE_STRING )
            ),
        );
    }
}
?>