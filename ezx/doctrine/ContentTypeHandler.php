<?php
/**
 * Storage Engine implementation for doctrine
 *
 * @copyright Copyright (c) 2011, eZ Systems AS
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2.0
 * @package ext
 * @subpackage base
 */

namespace ezx\doctrine;
class ContentTypeHandler implements \ezx\base\Interfaces\StorageEngine\ContentTypeHandler
{
    /**
     * Object for storage engine
     *
     * @var \ezx\base\Interfaces\StorageEngine
     */
    protected $se;

    /**
     * Object for doctrine backend
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Setups current instance with storage engine and doctrine object
     *
     * @param \ezx\base\Interfaces\StorageEngine $engine
     * @param object $backend
     */
    public function __construct( \ezx\base\Interfaces\StorageEngine $engine, $backend = null )
    {
        $this->se = $engine;
        $this->em = $backend;
    }

    /**
     * Create Content object
     *
     * @param \ezx\content\ContentType $contentType
     * @return \ezx\content\ContentType
     */
    public function create( \ezx\content\ContentType $contentType )
    {
        // @todo Store in backend
        return $contentType;
    }

    /**
     * Get Content object by id
     *
     * @param int $id
     * @return \ezx\content\ContentType|null
     */
    public function load( $id )
    {
        return $this->em->find( "ezx\\content\\ContentType", (int) $id );
    }

    /**
     * Get ContentType object by identifier
     *
     * @param string $identifier
     * @return \ezx\content\ContentType[]
     */
    public function loadByIdentifier( $identifier )
    {
        $query = $this->em->createQuery( "SELECT a FROM ezx\\content\\ContentType a WHERE a.identifier = :identifier" );
        $query->setParameter( 'identifier', $identifier );
        return $query->getResult();
    }
}