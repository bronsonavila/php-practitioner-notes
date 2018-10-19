<?php
// Defines routes to be added to the router instance (by request type).

// GET Route(s):

// The "@" convention specifies which page to call (NOTE: Not required
// to reference the "/controllers" directory explicitly):
$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
// Using "index" conventionally means that this route will display all users:
$router->get('users', 'UsersController@index');

// POST Route(s):

// Convention calls for using a "store" action when saving (storing) data:
$router->post('users', 'UsersController@store');
