<?php
// Basic dependency injection container.  Acts as a place to bind dependencies
// that have been sent to it (essentially, a registry).  When you need to fetch
// those values, you can later retrieve them from the container.

namespace App\Core;

class App
{
    // Static $registry will be accessible directly from the class object:
    protected static $registry = [];

    public static function bind($key, $value)
    {
        // When you are within a "static", you are not dealing with an instance
        // of the class, but rather acting upon the class object itself.  Thus,
        // you must preface $registry with "static::" as opposed to "$this->":
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }
        return static::$registry[$key];
    }
}
