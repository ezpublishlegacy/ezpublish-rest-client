<?php
/**
 * A mockup ContentRepository
 *
 * @copyright Copyright (c) 2011, eZ Systems AS
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2.0
 * @package ext
 * @subpackage doctrine
 */

/**
 * Mokup ContentRepository
 */
namespace ezx\doctrine\model;
class ContentRepository extends Abstract_Repository implements Interface_IdentifierRepository
{
    /**
     * Get an object by identifier
     *
     * @param string $type
     * @param string $identifier
     * @return object
     * @throws \InvalidArgumentException
     */
    public function loadByIdentifier( $type, $identifier )
    {
        $query = $this->em->createQuery( "SELECT a FROM ezx\doctrine\model\\{$type} a WHERE a.identifier = :identifier" );
        $query->setParameter( 'identifier', $identifier );
        $contentType = $query->getResult();
        if ( !$contentType )
            throw new \InvalidArgumentException( "Could not find '{$type}' with identifier: {$identifier}" );
        return $contentType;
    }

    /**
     * Create content object
     *
     * @todo Move to content service / manager?
     *
     * @param string $typeIdentifier
     * @return Content
     */
    public function createContent( $typeIdentifier )
    {
        // @todo The call bellow should be cached in repository layer / Storage Engine
        $type = $this->loadByIdentifier( 'ContentType', $typeIdentifier );

        if ( !$type )
            throw new \RuntimeException( "Could not find content type by identifier: '{$typeIdentifier}'" );

        return Content::create( $type[0] );
    }
}