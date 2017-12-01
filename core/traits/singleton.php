<?php

namespace core\traits;

trait Singleton
{
    protected static $instance;

    public static function getInstance()
    {
        return (null !== self::$instance) ? self::$instance : (self::$instance = new self());
    }
}