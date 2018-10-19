<?php

// Basically acts like an import; indicates that any usage of "App" within
// the file should be treated as "App\Core\App":
use App\Core\App;

// Creates a key called "config" which has the config.php array as its value,
// and then stores the key-value pair within the App DI container:
App::bind('config', require 'config.php');

// Creates a key called "database" which has a value that is an instance of
// QueryBuilder, and stores it to the App DI container:
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

// $data defaults to an empty array if no data needs to be passed to the view:
function view($name, $data = [])
{
    // PHP function that takes a collection of key-value pairs, and "extracts"
    // the contents into variables (for example, ['name' => 'index'] becomes
    // $name = 'index';):
    extract($data);

    // This function assumes you will follow conventions regarding the
    // location and file name of your views:
    return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}
