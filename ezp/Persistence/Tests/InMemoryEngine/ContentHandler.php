<?php
/**
 * File containing the ContentHandler implementation
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @package ezp
 * @subpackage persistence_tests
 * @version //autogentag//
 *
 */

namespace ezp\Persistence\Tests\InMemoryEngine;

/**
 * @see \ezp\Persistence\Content\Interfaces\ContentHandler
 *
 * @package ezp
 * @subpackage persistence_tests
 * @version //autogentag//
 */
class ContentHandler implements \ezp\Persistence\Content\Interfaces\ContentHandler
{
    /**
     * @var RepositoryHandler
     */
    protected $handler;

    /**
     * @var Backend
     */
    protected $backend;

    /**
     * Setups current handler instance with reference to RepositoryHandler object that created it.
     *
     * @param RepositoryHandler $handler
     * @param Backend $backend The storage engine backend
     */
    public function __construct( RepositoryHandler $handler, Backend $backend )
    {
        $this->handler = $handler;
        $this->backend = $backend;
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function create( \ezp\Persistence\Content\ContentCreateStruct $content )
    {
        $contentObj = $this->backend->create( 'Content', array(
            'name' => $content->name,
            'typeId' => $content->typeId,
            'sectionId' => $content->sectionId,
            'ownerId' => $content->ownerId,
        ) );
        $version = $this->backend->create( 'Content\\Version', array(
            'modified' => time(),
            'creatorId' => $content->ownerId,
            'created' => time(),
            'contentId' => $contentObj->id,
            'state' => \ezp\Content\Version::STATUS_DRAFT,
        ) );
        foreach ( $content->fields as $field )
        {
            $version->fields[] = $this->backend->create(
                'Content\\Field',
                array( 'versionId' => $version->id ) + (array) $field
            );
        }
        $contentObj->versionInfos[] = $version;

        $locationHandler = $this->handler->locationHandler();
        foreach ( $content->parentLocation as $parentLocationId )
        {
            $contentObj->locations[] = $locationHandler->createLocation( $contentObj->id, $parentLocationId );
        }
        return $contentObj;
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function createDraftFromVersion( $contentId, $srcVersion = false )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function load( $id )
    {
        $content = $this->backend->load( 'Content', $id );
        if ( !$content )
            return null;

        $versions = $this->backend->find( 'Content\\Version', array( 'contentId' => $content->id ) );
        foreach ( $versions as $version )
        {
            $version->fields = $this->backend->find( 'Content\\Field', array( 'versionId' => $version->id ) );
        }
        $content->versionInfos = $versions;
        // @todo Loading locations by content object id should be possible using handler API.
        $content->locations = $this->backend->find( 'Content\\Location', array( 'contentId' => $content->id  ) );
        return $content;
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function find( \ezp\Content\Criteria\Criteria $criteria, $offset, $limit, $sort )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function findSingle( \ezp\Content\Criteria\Criteria $criteria, $offset, $sort )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function setState( $contentId, $state, $version )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function setObjectState( $contentId, $stateGroup, $state, $version )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function update( \ezp\Persistence\Content\ContentUpdateStruct $content )
    {
        // @todo Will need version number to be able to know which version to update.
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function delete( $contentId )
    {
        $return = $this->backend->delete( 'Content', $contentId );
        if ( !$return )
            return $return;

        $versions = $this->backend->find( 'Content\\Version', array( 'contentId' => $contentId ) );
        foreach ( $versions as $version )
        {
            $fields = $this->backend->find( 'Content\\Field', array( 'versionId' => $version->id ) );
            foreach ( $fields as $field )
                $this->backend->delete( 'Content\\Field', $field->id );

            $this->backend->delete( 'Content\\Version', $version->id );
        }

        // @todo Deleting Locations by content object id should be possible using handler API.
        $locationHandler = $this->handler->locationHandler();
        $locations = $this->backend->find( 'Content\\Location', array( 'contentId' => $contentId ) );
        foreach ( $locations as $location )
        {
            $locationHandler->delete( $location->id );
        }
        return $return;
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function trash( $contentId )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function untrash( $contentId )
    {
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function listVersions( $contentId )
    {
        return $this->backend->find( 'Content\\Version', array( 'contentId' => $contentId ) );
    }

    /**
     * @see \ezp\Persistence\Content\Interfaces\ContentHandler
     */
    public function fetchTranslation( $contentId, $languageCode )
    {
    }
}
?>