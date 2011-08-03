<?php
/**
 * File contains Read Only Collection class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace ezp\Base\Collection;
use ezp\Base\Collection,
    ezp\Base\Exception\ReadOnly as ReadOnlyException,
    ArrayObject;

/**
 * Read Only Collection class
 *
 */
class ReadOnly extends ArrayObject implements Collection
{
    /**
     * Overloads offsetSet() to do exception about being read only.
     *
     * @internal
     * @throws ezp\Base\Exception\ReadOnly
     * @param string|int $offset
     * @param mixed $value
     */
    public function offsetSet( $offset, $value )
    {
        throw new ReadOnlyException( 'Collection' );
    }

    /**
     * Overloads offsetUnset() to do exception about being read only.
     *
     * @internal
     * @throws ezp\Base\Exception\ReadOnly
     * @param string|int $offset
     */
    public function offsetUnset( $offset )
    {
        throw new ReadOnlyException( 'Collection' );
    }

    /**
     * Overloads exchangeArray() to do exception about being read only.
     *
     * @throws ezp\Base\Exception\ReadOnly
     * @param array $input
     * @return array
     */
    public function exchangeArray( $input )
    {
        throw new ReadOnlyException( 'Collection' );
    }
}

?>