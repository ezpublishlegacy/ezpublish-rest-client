<?php
/**
 * File containing the EzcDatabase remote id criterion handler class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace ezp\Persistence\Storage\Legacy\Content\Locator\Gateway\CriterionHandler;
use ezp\Persistence\Storage\Legacy\Content\Locator\Gateway\CriterionHandler,
    ezp\Persistence\Storage\Legacy\Content\Locator\Gateway\CriteriaConverter,
    ezp\Persistence\Content\Criterion;

/**
 * Remote id criterion handler
 */
class RemoteId extends CriterionHandler
{
    /**
     * Check if this criterion handler accepts to handle the given criterion.
     *
     * @param Criterion $criterion
     * @return bool
     */
    public function accept( Criterion $criterion )
    {
        return $criterion instanceof Criterion\RemoteId;
    }

    /**
     * Check if this criterion handler accepts to handle the given criterion.
     *
     * @param CriteriaConverter $converter
     * @param \ezcQuerySelect $query
     * @param Criterion $criterion
     * @return \ezcQueryExpression
     */
    public function handle( CriteriaConverter $converter, \ezcQuerySelect $query, Criterion $criterion )
    {
        return $query->expr->in( 'remote_id', $criterion->value );
    }
}
