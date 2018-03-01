<?php

/*
 * (c) Sven Siebrands <info@s-dl.biz>
 *
 * Credits to Marco Pivetta (Ocramius)
 *  - https://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PropertyReader;

/**
 * A helper class to access properties from other classes (including protected & private)
 * 
 * Using PropertyReader::read() with PHP version < 7 will trigger a PHP Warning "Cannot bind an instance to a static closure".
 * You can use PropertyReader::newInstance()->read() to avoide the warning.
 */
class PropertyReader
{
    /**
     * Create new instance of PropertyReader
     * 
     * @return PropertyReader
     */
    public static function newInstance()
    {
        return new self;
    }
    
    /**
     * Accessing class property by reference
     * 
     * @param mixed $object
     * @param string $property
     * 
     * @return mixed
     */
    public static function & read($object, $property)
    {
        $value = & \Closure::bind(function & () use ($property) {
            return $this->{$property};
        }, $object, $object)->__invoke();

        return $value;
    }
}
