<?php
/**
 * File containing the FieldDefinition class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @package ezp
 * @subpackage persistence_content_types
 */

namespace ezp\persistence\content_types;

/**
 * @package ezp
 * @subpackage persistence_content_types
 */
class FieldDefinition extends TypeBase
{
	/**
	 */
	public $fieldGroup;
	/**
	 */
	public $position;
	/**
	 */
	public $fieldType;
	/**
	 */
	public $translatable;
	/**
	 */
	public $required;
	/**
	 */
	public $infoCollector;
	/**
	 */
	public $fieldTypeConstraints;
	public $defaultValue;
	/**
	 */
	public $unnamed_ContentType_;
}
?>