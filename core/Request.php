<?php
// Responsible for fetching information about the current browser request:

namespace App\Core;

class Request
{
    public static function uri()
    {
        // $_SERVER is a PHP super global array containing information about
        // headers, paths, and script locations.  (NOTE: If you need obtain
        // information about the request to the server, then use the $_REQUEST
        // super global.)

        // PHP's trim() function normally removes blank spaces from the
        // beginning and end of a string, but the character(s) to be removed
        // can be specified as the second argument.

        // PHP's parse_url() function will parse the URI (first argument) and
        // return the specificied URL component (second argument).  This allows
        // you to handle URIs that include query strings:
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method() {
        // States whether the request is GET, POST, PUT, DELETE, etc.:
        return $_SERVER['REQUEST_METHOD'];
    }
}
