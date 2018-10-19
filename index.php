<?php
// Sole purpose is to serve as application's entry point and set up the project.

// Must require this file in the entry point when using Composer's autoloader:
require 'vendor/autoload.php';
require 'core/bootstrap.php';

// PHP 7 allows you to consolidate namespacing where files share the same path:
use App\Core\{Router, Request};

// Load routes into a router instance, and then direct traffic to
// the controllers associated with a URI based on the request method
// (NOTE: It is not necessary to preface this with a "require" keyword
// because the Router.direct() method will call Router.callAction(),
// which will create a new instance of a necessary controller):
Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
