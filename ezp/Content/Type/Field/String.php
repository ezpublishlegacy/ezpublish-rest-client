<?php
/**
 * String Field domain object
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package ezp
 * @subpackage content
 */

/**
 * Float Field value object class
 */
namespace ezp\Content\Type\Field;
class String extends \ezp\Content\AbstractFieldType implements \ezp\Content\Interfaces\ContentFieldDefinition
{
    /**
     * Field type identifier
     * @var string
     */
    const FIELD_IDENTIFIER = 'ezstring';

    /**
     * @public
     * @var string
     */
    public $default = '';

    /**
     * @public
     * @var int
     */
    public $maxLength = 255;

    /**
     * @var array Readable of properties on this object
     */
    protected $readableProperties = array(
        'default' => 'data_text1',
        'maxLength' => 'data_int1',
    );

    /**
     * Sets identifier on design override and calls parent __construct.
     */
    public function __construct()
    {
        $this->types[] = self::FIELD_IDENTIFIER;
        parent::__construct();
    }
}