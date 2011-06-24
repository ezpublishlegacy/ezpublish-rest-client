<?php
/**
 * File containing ezp\Content\Base class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package API
 * @subpackage Content
 */

/**
 * Abstract base class for Content namespace
 * @access private
 */
namespace ezp\base;
use ezcBasePropertyNotFoundException;
use ezcBasePropertyPermissionException;

abstract class AbstractModel implements ObservableInterface, ModelInterface
{
    /**
     * Array indicates which public/protected properties are readable through
     * the magic getter (__get)
     * Key is property name, value is true
     * @var array
     */
    protected $readableProperties;

    /**
     * Array container for virtual properties, handled dynamically by methods
     * Key is property name, value is a bool, true if member of aggregate, false if not.
     *
     * Corresponding get method name must follow pattern get<propertyName>().
     * The method will be called without any parameter
     * e.g. : for a dynamic property named "myProperty", method should be "getMyProperty()".
     *
     * If the dynamic property is writeable, a set method should be defined.
     * Corresponding set method name must follow pattern set<propertyName>( $value ).
     * The method will be called with only one $value parameter.
     * e.g. : for a dynamic property named "myProperty", method should be "setMyProperty( $value )"
     *
     * @var array
     */
    protected $dynamicProperties;

    /**
     * List of event listeners
     *
     * @var ObserverInterface[]
     */
    private $observers = array();


    /**
     * Attach a event listener to this subject
     *
     * @param ObserverInterface $observer
     * @param string $event
     * @return AbstractModel
     */
    public function attach( ObserverInterface $observer, $event = 'update' )
    {
        if ( isset( $this->observers[$event] ) )
        {
            $this->observers[$event][] = $observer;
        }
        else
        {
            $this->observers[$event] = array( $observer );
        }
        return $this;
    }

    /**
     * Detach a event listener to this subject
     *
     * @param ObserverInterface $observer
     * @param string $event
     * @return AbstractModel
     */
    public function detach( ObserverInterface $observer, $event = 'update' )
    {
        if ( !empty( $this->observers[$event] ) )
        {
            foreach( $this->observers[$event] as $key => $obj )
            {
                if ( $obj === $observer )
                    unset( $this->observers[$event][$key] );
            }
        }
        return $this;
    }

    /**
     * Notify listeners about certain events, by default $event is a plain 'update'
     *
     * @param string $event
     * @return AbstractModel
     */
    public function notify( $event = 'update' )
    {
        if ( !empty( $this->observers[$event] ) )
        {
            foreach( $this->observers[$event] as $obj )
            {
                $obj->update( $this, $event );
            }
        }
        return $this;
    }

    /**
     * Magic getter
     * @param string $property Property name
     * @access private
     * @throws ezcBasePropertyNotFoundException If $property cannot be found
     */
    public function __get( $property )
    {
        if ( isset( $this->readableProperties[$property] ) )
        {
            return $this->$property;
        }

        if ( isset( $this->dynamicProperties[$property] ) )
        {
            $method = "get{$property}";
            return $this->$method();
        }

        throw new \InvalidArgumentException( "'{$property}' is not a valid property on class: " . get_class( $this ) );
        throw new ezcBasePropertyNotFoundException( $property );
    }

    /**
     * Magic setter
     * Avoids to modify read-only properties
     * @param string $property
     * @param mixed $value
     * @throws ezcBasePropertyNotFoundException If $property cannot be found
     * @throws ezcBasePropertyPermissionException When trying to set a value to a read-only property
     */
    public function __set( $property, $value )
    {
        if ( isset( $this->dynamicProperties[$property] ) )
        {
            $method = "set{$property}";
            if ( method_exists( $this, $method ) )
            {
                $this->$method( $value );
            }
            else
            {
                throw new ezcBasePropertyPermissionException( $property, ezcBasePropertyPermissionException::READ );
            }
        }
        else
        {
            throw new \InvalidArgumentException( "'{$property}' is not a valid property on class: " . get_class( $this ) );
            throw new ezcBasePropertyNotFoundException( $property );
        }
    }

    /**
     * Checks if a public virtual property is set
     * @param string $property Property name
     * @access private
     */
    public function __isset( $property )
    {
        return isset( $this->readableProperties[$property] ) || isset( $this->dynamicProperties[$property] );
    }

    /**
     * Restores the state of a content object
     * @param array $state
     */
    public static function __set_state( array $state )
    {
        $obj = new static;
        $publicProperties = get_object_vars( $obj );
        foreach ( $state as $property => $value )
        {
            if ( isset( $publicProperties[$property] ) ||
                    isset( $obj->readableProperties[$property] ) )
            {
                $obj->$property = $value;
            }
        }

        return $obj;
    }
}

?>