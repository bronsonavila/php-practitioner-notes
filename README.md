# "The PHP Practitioner" Notes

This project was created by reviewing [The PHP Practitioner](https://laracasts.com/series/php-for-beginners) series by Jeffrey Way.  This repository is intended to serve as a personal quick reference guide and not a full-fledged tutorial.

NOTE: The project structure evolves over the course of the series.  Accordingly, file names and directories referenced in the code blocks below may not necessarily correspond to the names of files/directories reflected in the project's final state.

<div id='id-toc'/>

## Table of Contents
- Episode 3: [Variables](#id-section3)
- Episode 4: [PHP and HTML](#id-section4)
- Episode 5: [Separate PHP Logic from Presentation](#id-section5)
- Episode 6: [Understanding Arrays](#id-section6)
- Episode 7: [Associative Arrays](#id-section7)
- Episode 9: [Conditionals](#id-section9)
- Episode 10: [Functions](#id-section10)
- Episode 11: [MySQL 101](#id-section11)
- Episode 12: [Classes 101](#id-section12)
- Episode 13: [Intro to PDO (PHP Data Objects)](#id-section13)
- Episode 14: [PDO Refactoring and Collaborators](#id-section14)
- Episode 15: [Hide Your Secret Passwords](#id-section15)
- Episode 16: [Routing](#id-section16)
- Episode 17: [DRY Up Your Views](#id-section17)
- Episode 18: [Array Filtering](#id-section18)
- Episode 19: [Forms, Request Types, and Routing](#id-section19)
- Episode 20: [Dynamic Inserts With PDO](#id-section20)
- Episode 21: [Composer Autoloading](#id-section21)
- Episode 22: [Your First Dependency Injection ("DI") Container](#id-section22)
- Episode 23: [Refactoring to Controller Classes](#id-section23)
- Episode 24: [Switch to Namespaces](#id-section24)

<div id='id-section3'/>

## Episode 3: Variables

- By using double quotes, you can integrate variables into a string (like template literals in JS):

  ```php
  echo "Hello, $name.";
  ```

  - Alternatively, you can use concatenation (with a . rather than +):

    ```php
    echo 'Hello, ' . $name . '.';
    ```

  - NOTE: When using double quotes, it is possible to wrap the variable name in curly braces just to make it explicitly clear to the reader that the variable is in fact a variable:

    ```php
    echo "Hello, {$name}."
    ```

- SIDE NOTE: Use PHP CLI to run `index.php` in a local server:

  `php -S localhost:8080`

[Back to TOC](#id-toc)

<div id='id-section4'/>

## Episode 4: PHP and HTML

- If you have a file that is purely PHP code, you need only have an opening PHP tag at the top of your file: `<?php`

  - However, if your file also contains HTML, then you will need to include closing tags at the end of the PHP code block: `?>`

- To work with data contained in the query strings of a URL (e.g., `?name=Bronson`), you can make use of [superglobals](http://php.net/manual/en/language.variables.superglobals.php), e.g.:

  ```php
  <?php echo "Hello, " . $_GET['name']; ?>
  ```

  - Shorthand for opening PHP and echoing text:

    ```php
    <?= "Hello, " . $_GET['name']; ?>
    ```

  - NOTE: To prevent users from injecting HTML into the query string to be processed by PHP, use the built-in function `htmlspecialchars()` to force special HTML characters to be rendered as plain text:

    ```php
    <?= "Hello, " . htmlspecialchars($_GET['name']); ?>
    ```

[Back to TOC](#id-toc)

<div id='id-section5'/>

## Episode 5: Separate PHP Logic from Presentation

- Rather than having all HTML content to be served from a single `index.php` file, you can separate HTML content into **views**, and then apply all the logic necessary to display those views in the main `index.php` file, which will contain render the data contained in your views. For example, you could (1) create a file named `index.view.php` that contains HTML and a reference to a `$greeting` variable, and (2) insert the following code into your `index.php` file to render the view with the variable defined:

  ```php
  <?php

  $greeting = 'Hello, world.';

  require 'index.view.php';
  ```

[Back to TOC](#id-toc)

<div id='id-section6'/>

## Episode 6: Understanding Arrays

- Create an array as follows:

  ```php
  $names = ['Adam', 'Ben', 'Charlie'];
  ```

- Use a **for loop** to iterate over the array in your HTML:

  ```html
  <!-- Typical For Loop Syntax -->
    <ul>
      <?php
        foreach ($names as $name) {
          echo "<li>$name</li>";
        }
      ?>
    </ul>

  <!-- Alternative For Loop Syntax -->
    <ul>
      <?php foreach ($names as $name) : ?>
        <li><?= $name; ?></li>
      <?php endforeach; ?>
    </ul>
  ```

- Use the following syntax to add (push) to an array:

  ```php
  $animals = ['dog', 'cat'];

  $animals[] = 'elephant';

  // $animals = ['dog', 'cat', 'elephant']
  ```

[Back to TOC](#id-toc)

<div id='id-section7'/>

## Episode 7: Associative Arrays

- A comma-separated list of key-value pairs (i.e., an object):

  ```php
  $person = [
      'age' => 31,
      'hair' => 'brown',
      'career' => 'web developer',
  ];
  ```

- If you iterate over an associative array in the same manner as a basic array, you will only iterate over the value. If you also want to iterate over the key, then use the following syntax:

  ```html
  <?php foreach ($person as $key => $val) : ?>
    <li><?= $key; ?> <?= $val; ?></li>
  <?php endforeach; ?>
  ```

  - SIDE NOTE: You can uppercase the first letter by using the built-in function `ucwords()`:

    ```html
    <li><?= ucwords($key); ?> <?= $val; ?></li>
    ```

- To display (dump) all key-value pairs in an associative array in raw format, you can use `var_dump()`:

  ```php
  // <pre> tags are not essential, but help make displayed text more readable:
  echo '<pre>';
  var_dump($person);
  echo '</pre>';
  ```

  - SIDE NOTE: If you want your PHP code to stop running after executing a dump, you can make it an argument in the `die()` function:

    ```php
    die(var_dump($person));
    ```

- To remove an item (property) from an associative array, use `unset`:

  ```php
  unset($person['age']);
  ```

[Back to TOC](#id-toc)

<div id='id-section9'/>

## Episode 9: Conditionals

- In addition to ternaries and the basic if/else curly braces syntax, you can express conditionals as follows:

  ```html
  <li>
    <strong>Status:</strong>
    <?php if ($task['completed']) : ?>
      <span class="icon">&#9989;</span>
    <?php else : ?>
      <span>Incomplete</span>
    <?php endif; ?>
  </li>
  ```

- Use a `bang (!)` to invert a boolean:

  ```php
  if (!$task['completed']) {
      echo 'Incomplete';
  }
  ```

[Back to TOC](#id-toc)

<div id='id-section10'/>

## Episode 10: Functions

- Example:

  ```php
  $animals = ['dog', 'cat'];

  // "dd" stands for Die & Dump:
  function dd($data)
  {
      echo '<pre>';
      die(var_dump($data));
      echo '</pre>';
  }

  dd($animals);
  ```

[Back to TOC](#id-toc)

<div id='id-section11'/>

## Episode 11: MySQL 101

- CLI (root user with no password set):

  `$ mysql -uroot`

  - NOTE: If you have a password set, preface it with the `-p` flag:

    `$ mysql -uroot -ppassword`

- Show databases:

  `mysql> show databases;`

- Create database:

  `mysql> create database my_database_name;`

- Use a database:

  `mysql> use my_database_name;`

- Create a table (must specify the column name and type):

  `mysql> create table my_table_name (id integer PRIMARY KEY AUTO_INCREMENT, description text NOT NULL, completed boolean NOT NULL);`

- Show table information:

  `mysql> describe my_table_name;`

- Insert into a table:

  `mysql> insert into my_table_name (description, completed) values('Buy groceries', false);`

- View all records in a table:

  `mysql> select * from my_table_name;`

[Back to TOC](#id-toc)

<div id='id-section12'/>

## Episode 12: Classes 101

- Example:

  ```php
  class Task
  {
      // Private properties:
      protected $description;
      protected $completed = false;

      // Constructor automatically triggered on instantiation via "new" keyword:
      public function __construct($description)
      {
          $this->description = $description;
      }

      public function isComplete()
      {
          return $this->completed;
      }

      public function complete()
      {
          $this->completed = true;
      }

      public function getDescription()
      {
          return $this->description;
      }
  }

  $tasks = [
      new Task('Go to the store'),
      new Task('Finish work'),
      new Task('Clean room'),
  ];

  $tasks[0]->complete();
  ```

  - The tasks can be rendered in HTML as follows:

    ```html
    <ul>
      <?php foreach ($tasks as $task) : ?>
        <li>
          <?php if ($task->isComplete()) : ?>
            <strike><?= $task->getDescription() ?></strike>
          <?php else : ?>
            <?= $task->getDescription() ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    ```

[Back to TOC](#id-toc)

<div id='id-section13'/>

## Episode 13: Intro to PDO (PHP Data Objects)

- To interact with your database, use the PDO class, e.g.:

  ```php
  // Best practice is to wrap a PDO in a try/catch statement for error handling:
  try {
      // PDO requires (1) DSN (Data Source Name), (2) username, and (3) password:
      $pdo = new PDO('mysql:host=127.0.0.1;dbname=mytodos', 'root', '');
  } catch (PDOException $e) {
      die("Could not connect: $e");
  }

  // Prepare SQL query:
  $query = $pdo->prepare('select * from todos');

  // Execute SQL query:
  $query->execute();

  // Fetch all results (specifically storing each row as an object):
  $tasks = $query->fetchAll(PDO::FETCH_OBJ);

  // Alternatively, you can store results as a class instance (if class exists):
  // $tasks = $query->fetchAll(PDO::FETCH_CLASS, 'Task');

  // Dump only the description of the first result:
  var_dump($tasks[0]->description);
  ```

  - The tasks can be rendered in HTML as follows:

    ```html
    <ul>
      <?php foreach ($tasks as $task) : ?>
        <li>
          <?php if ($task->completed) : ?>
            <strike><?= $task->description ?></strike>
          <?php else : ?>
            <?= $task->description ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    ```

[Back to TOC](#id-toc)

<div id='id-section14'/>

## Episode 14: PDO Refactoring and Collaborators

- Example:

  ```php
  // index.php

  <?php

  // Responsible for the "behind-the-scenes" work:
  $query = require 'bootstrap.php';

  $tasks = $query->selectAll('todos');

  require 'index.view.php';
  ```

  ```php
  // bootstrap.php

  <?php

  require 'database/Connection.php';
  require 'database/QueryBuilder.php';

  return new QueryBuilder(
      Connection::make()
  );
  ```

  ```php
  // database/Connection.php

  <?php

  class Connection
  {
      // "static" makes a method available globally without requiring an instance.
      // Allows calling method directly like so: Connection::make();
      public static function make()
      {
          try {
              return new PDO('mysql:host=127.0.0.1;dbname=mytodos', 'root', '');
          } catch (PDOException $e) {
              die($e->getMessage());
          }
      }
  }
  ```

  ```php
  // database/QueryBuilder.php

  <?php

  class QueryBuilder
  {
      protected $pdo;

      // "Type hinting" defines type of values that can be passed as an argument:
      public function __construct(PDO $pdo)
      {
          $this->pdo = $pdo;
      }

      public function selectAll($table)
      {
          $query = $this->pdo->prepare("select * from {$table}");
          $query->execute();
          return $query->fetchAll(PDO::FETCH_OBJ);
      }
  }
  ```

[Back to TOC](#id-toc)

<div id='id-section15'/>

## Episode 15: Hide Your Secret Passwords

- Example:

  ```php
  // config.php

  <?php

  return [
      'database' => [
          'name' => 'mytodos',
          'username' => 'root',
          'password' => '',
          'connection' => 'mysql:host=127.0.0.1',
          'options' => [
              // Displays an error (rather than blank page) if DB access fails:
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          ],
      ],
  ];
  ```

  ```php
  // bootstrap.php

  <?php

  $config = require 'config.php';
  require 'database/Connection.php';
  require 'database/QueryBuilder.php';

  return new QueryBuilder(
      Connection::make($config['database'])
  );
  ```

  ```php
  // Connection.php

  <?php

  class Connection
  {
      public static function make($config)
      {
          try {
              // Fourth argument may include "options":
              return new PDO(
                  "{$config['connection']};dbname={$config['name']}",
                  $config['username'],
                  $config['password'],
                  $config['options']
              );
          } catch (PDOException $e) {
              die($e->getMessage());
          }
      }
  }
  ```

[Back to TOC](#id-toc)

<div id='id-section16'/>

## Episode 16: Routing

- Example:

  ```php
  // index.php

  // Sole purpose is to serve as application's entry point and set up project:
  <?php

  $database = require 'core/bootstrap.php';

  // Load routes into a router instance, and then direct traffic to
  // the controllers associated with a URI (via chaining):
  require Router::load('routes.php')
      ->direct(Request::uri());
  ```

  ```php
  // core/bootstrap.php

  <?php

  $app = [];

  $app['config'] = require 'config.php';

  // Always require starting from the project root:
  require 'core/Router.php';
  require 'core/Request.php';
  require 'core/database/Connection.php';
  require 'core/database/QueryBuilder.php';

  $app['database'] = new QueryBuilder(
      Connection::make($app['config']['database'])
  );
  ```

  ```php
  // core/Router.php

  <?php

  class Router
  {
      // Stores the routes that have been defined on the router instance:
      protected $routes = [];

      // A static function is not an instance method, but is rather like a
      // a global method that can be called at any time:
      public static function load($file)
      {
          // Makes the $router variable available:
          $router = new static; // Keyword "static" creates a new instance.
          require $file;
          return $router;
      }

      public function define($routes)
      {
          $this->routes = $routes;
      }

      // Directs traffic from a URI to its associated controller:
      public function direct($uri)
      {
          // First argument is the key to find; second is the array to search:
          if (array_key_exists($uri, $this->routes)) {
              return $this->routes[$uri];
          }

          throw new Exception('No route defined for this URI.');
      }
  }
  ```

  ```php
  // routes.php

  <?php

  // Defines routes to be added to the router instance:
  $router->define([
    '' => 'controllers/index.php',
    'about' => 'controllers/about.php',
    'about/culture' => 'controllers/about-culture.php',
    'contact' => 'controllers/contact.php',
  ]);
  ```

  ```php
  // core/Request.php

  <?php

  // Responsible for fetching information about the current browser request:
  class Request
  {
      public static function uri()
      {
          // $_SERVER is a PHP super global array containing information about
          // headers, paths, and script locations.  trim() is a PHP function
          // that normally removes blank spaces from the beginning and end of
          // a string, but the character(s) to be removed can be specified as
          // the second argument:
          return $uri = trim($_SERVER['REQUEST_URI'], '/');
      }
  }
  ```

[Back to TOC](#id-toc)

<div id='id-section17'/>

## Episode 17: DRY Up Your Views

- Example of how to implement partials:

  ```html
  <!-- views/index.view.php -->

  <?php require('partials/head.php'); ?>

  <h1>My Tasks</h1>

  <ul>
    <?php foreach ($tasks as $task): ?>
      <li>
        <?php if ($task->completed): ?>
          <strike><?=$task->description?></strike>
        <?php else: ?>
          <?=$task->description?>
        <?php endif;?>
      </li>
    <?php endforeach;?>
  </ul>

  <?php require('partials/footer.php'); ?>
  ```

  ```html
  <!-- views/partials/head.php -->

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/styles.css">
  </head>
  <body>
    <!-- Path used in require() is relative -->
    <?php require('nav.php') ?>
  ```

  ```html
  <!-- views/partials/nav.php -->

  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/about/culture">About Our Culture</a></li>
      <li><a href="/contact">Contact</a></li>
    </ul>
  </nav>
  ```

  ```html
  <!-- views/partials/footer.php -->

  </body>
  </html>
  ```

[Back to TOC](#id-toc)

<div id='id-section18'/>

## Episode 18: Array Filtering

- Example of how to use `array_filter()`, `array_map()`, and `array_column()`:

  ```php
  <?php

  class Post
  {
      public $title;
      public $author;
      public $published;

      public function __construct($title, $author, $published)
      {
          $this->title = $title;
          $this->author = $author;

          $this->published = $published;
      }
  }

  $posts = [
      new Post('My First Post', 'BA', true),
      new Post('My Second Post', 'FD', true),
      new Post('My Third Post', 'TY', true),
      new Post('My Fourth Post', 'HK', false),
  ];

  // Filters posts and returns a new array containing only unpublished posts:
  $unpublishedPosts = array_filter($posts, function ($post) {
      return !$post->published;
  });

  // NOTE: PHP's syntax is inconsistent re: filtering/mapping arrays.  The first
  // argument in array_filter() is the array to iterate through, while the second
  // argument is a callback function.  The arguments are reserved in array_map().

  // Iterates over posts and transforms each post object into an array:
  $modified = array_map(function ($post) {
      return (array) $post;
  }, $posts);

  // Iterates over posts and returns each post title in an associative array:
  $objectTitles = array_map(function ($post) {
      return ['title' => $post->title];
  }, $posts);

  // Iterates over posts (first argument) and returns an array of each author
  // (second argument) with the title (third argument) as the key for each
  // author, rather than using an index number for the key:
  $stringTitles = array_column($posts, 'author', 'title');

  ```

[Back to TOC](#id-toc)

<div id='id-section19'/>

## Episode 19: Forms, Request Types, and Routing

1.  Create a form:

    ```html
    <!-- views/index.view.php -->

    <?php require('partials/head.php'); ?>

    <h1>Submit Your Name</h1>

    <!-- Form to submit POST request, trigger controller associated with
      the "/names" path, and fetch data specified by the controller: -->
    <form method="POST" action="/names">
      <input name="name">
      <button type="submit">Submit</button>
    </form>

    <?php require('partials/footer.php'); ?>
    ```

2.  Configure your routes to handle HTTP requests depending on request type (e.g., GET, POST, etc.):

    ```php
    // routes.php

    <?php
    // Defines routes to be added to the router instance (by request type).

    // GET Route(s):
    $router->get('', 'controllers/index.php');
    $router->get('about', 'controllers/about.php');
    $router->get('about/culture', 'controllers/about-culture.php');

    // POST Route(s):
    $router->post('names', 'controllers/add-name.php');
    ```

3.  Configure your Router class to handle HTTP requests depending on request type:

    ```php
    // core/Router.php

    <?php

    class Router
    {
        // Stores routes (by type) that have been defined on the router instance:
        public $routes = [
            'GET' => [],
            'POST' => [],
        ];

        public static function load($file)
        {
            $router = new static;
            require $file;
            return $router;
        }

        public function get($uri, $controller)
        {
            $this->routes['GET'][$uri] = $controller;
        }

        public function post($uri, $controller)
        {
            $this->routes['POST'][$uri] = $controller;
        }

        // Directs traffic from a URI to its associated controller based on
        // HTTP request type:
        public function direct($uri, $requestType)
        {
            if (array_key_exists($uri, $this->routes[$requestType])) {
                return $this->routes[$requestType][$uri];
            }

            throw new Exception('No route defined for this URI.');
        }
    }
    ```

4.  Configure your Request class to parse the URL path and to process requests different depending on the request type:

    ```php
    // core/Request.php

    <?php
    // Responsible for fetching information about the current browser request:

    class Request
    {
        public static function uri()
        {
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
    ```

5.  Configure your application's entry point to direct traffic based on the URI and the HTTP request method:

    ```php
    // index.php

    <?php

    $database = require 'core/bootstrap.php';

    // Load routes into a router instance, and then direct traffic to
    // the controllers associated with a URI based on the request method:
    require Router::load('routes.php')
        ->direct(Request::uri(), Request::method());
    ```

6.  Configure your POST route's controller to output the desired data:

    ```php
    // controllers/add-name.php

    <?php

    // $_POST super global contains form data passed via HTTP POST method.
    // (NOTE: If you need obtain information about the request to the server,
    // then use the $_REQUEST super global.)
    var_dump("You typed {$_POST['name']}.");

    ```

[Back to TOC](#id-toc)

<div id='id-section20'/>

## Episode 20: Dynamic Inserts With PDO

1.  Add an insert() method to your QueryBuilder:

    ```php
    // core/database/QueryBuilder.php

    <?php

    class QueryBuilder
    {
        protected $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function selectAll($table)
        {
            $query = $this->pdo->prepare("select * from {$table}");

            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        public function insert($table, $parameters)
        {
            // array_keys() returns an array containing the keys of the input array,
            // and implode() concatenates each element of the new array into a
            // string in which each element is separated by ", ":
            $columns = implode(', ', array_keys($parameters));

            // Trick to preface each column name with a colon, which acts as a
            // placeholder for the value corresponding to the specified key:
            $values = ':' . implode(', :', array_keys($parameters));

            // sprintf() allows you to declare a string with placeholders to which
            // you can attach variables (in this case, strings identified as %s):
            $sqlString = sprintf(
                'insert into %s (%s) values (%s)', $table, $columns, $values
            );

            try {
                $query = $this->pdo->prepare($sqlString);

                // execute() accepts an array that is used in binding values to the
                // placeholders (parameters) specified in $values:
                $query->execute($parameters);
            } catch (Exception $e) {
                die('Something went wrong.');
            }
        }
    }
    ```

2.  Configure form submission controller to use insert() method and redirect:

    ```php
    // controllers/add-name.php

    <?php

    $app['database']->insert('users', [
      'name' => $_POST['name']
    ]);

    // Redirect back to homepage:
    header('Location: /');
    ```

3.  Configure the controller of application's entry point to get user names:

    ```php
    // controllers/index.php

    <?php

    $users = $app['database']->selectAll('users');

    require 'views/index.view.php';
    ```

4.  Configure the home page to display all names submitted via the form:

    ```html
    <!-- views/index.view.php -->

    <?php require('partials/head.php'); ?>

      <!-- Lists the names of all users upon page load: -->
      <ul>
      <?php foreach ($users as $user) : ?>
        <li><?= $user->name; ?></li>
      <?php endforeach; ?>
      </ul>

      <h1>Submit Your Name</h1>

      <form method="POST" action="/names">
        <input name="name">
        <button type="submit">Submit</button>
      </form>

    <?php require('partials/footer.php'); ?>
    ```

[Back to TOC](#id-toc)

<div id='id-section21'/>

## Episode 21: Composer Autoloading

- [Composer](https://getcomposer.org/) is a package manager (similar to NPM).

- In your project root directory, create a file named `composer.json` that will be used to specify how you want Composer to autoload your project files.  `classmap` contains all classes (identified as PHP files beginning with a capital letter) that need to be loaded.  In this example, every class in the project will be loaded:

  ```json
  {
    "autoload": {
      "classmap": [
        "./"
      ]
    }
  }
  ```

- After creating your `composer.json` file, use Composer's `install` command to install the project's dependencies from `composer.json`.  The output will be located in a directory named `/vendor` in your project root.  You can use the generated files by inserting the following code into your project's entry point:

  ```php
  <?php

  // Must require this file in the entry point when using Composer's autoloader:
  require 'vendor/autoload.php';

  $database = require 'core/bootstrap.php';

  require Router::load('routes.php')
      ->direct(Request::uri(), Request::method());
  ```

- To rebuild the files in your `/vendor` directory (which is necessary if you have added new files to your project), use Composer's `dump-autoload` command.

[Back to TOC](#id-toc)

<div id='id-section22'/>

## Episode 22: Your First Dependency Injection ("DI") Container

1.  Create an `App.php` file to serve as your DI container:

    ```php
    // core/App.php

    <?php
    // Basic dependency injection container.  Acts as a place to bind dependencies
    // that have been sent to it (essentially, a registry).  When you need to fetch
    // those values, you can later retrieve them from the container.

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
    ```

2.  Configure your `bootstrap.php` file (along with any other files that may reference "config" and "database") to implement the App DI Container:

    ```php
    // core/bootstrap.php

    <?php

    // Creates a key called "config" which has config.php array as its value,
    // and then stores the key-value pair within the App DI container:
    App::bind('config', require 'config.php');

    // Creates a key called "database" which has a value that is an instance of
    // QueryBuilder, and stores it to the App DI container:
    App::bind('database', new QueryBuilder(
        Connection::make(App::get('config')['database'])
    ));
    ```

[Back to TOC](#id-toc)

<div id='id-section23'/>

## Episode 23: Refactoring to Controller Classes

- Controllers are generally responsible for receiving a request, delegating an action, and returning a response.  Rather than spreading your controllers across multiple files, you can consolidate them into class objects.

- Example:

  ```php
  // controllers/PagesController.php

  <?php

  class PagesController
  {
      public function home()
      {
          // Custom helper function contained in "core/bootstrap.php":
          return view('index');
      }

      public function about()
      {
          $company = 'Laracasts';

          return view('about', ['company' => $company]);
      }

      public function contact()
      {
          return view('contact');
      }
  }
  ```

  ```php
  // controllers/UsersController.php

  <?php

  class UsersController
  {
      public function index()
      {
          $users = App::get('database')->selectAll('users');

          // compact() is a PHP function that converts a string into an
          // associative array (i.e., ['users' => $users]):
          return view('users', compact('users'));
      }

      public function store()
      {
          App::get('database')->insert('users', [
              'name' => $_POST['name'],
          ]);

          // Custom helper function contained in "core/bootstrap.php":
          return redirect('users');
      }
  }
  ```

  ```php
  // core/bootstrap.php

  <?php

  App::bind('config', require 'config.php');

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
      return require "views/{$name}.view.php";
  }

  function redirect($path)
  {
      header("Location: /{$path}");
  }
  ```

  ```php
  // routes.php

  <?php

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

  ```

  ```php
  // index.php

  <?php

  require 'vendor/autoload.php';

  require 'core/bootstrap.php';

  // It is not necessary to preface this with a "require" keyword
  // because the Router.direct() method will call Router.callAction(),
  // which will create a new instance of a necessary controller:
  Router::load('routes.php')
      ->direct(Request::uri(), Request::method());
  ```

  ```php
  // core/Router.php

  <?php

  class Router
  {
      public $routes = [
          'GET' => [],
          'POST' => [],
      ];

      public static function load($file)
      {
          $router = new static;
          require $file;
          return $router;
      }

      public function get($uri, $controller)
      {
          $this->routes['GET'][$uri] = $controller;
      }

      public function post($uri, $controller)
      {
          $this->routes['POST'][$uri] = $controller;
      }

      public function direct($uri, $requestType)
      {
          // First argument is the key to find; second is the array to search:
          if (!array_key_exists($uri, $this->routes[$requestType])) {
              throw new Exception('No route defined for this URI.');
          }

          // Changes, e.g., "PagesController@home" to ["PagesController", "home"]:
          $arguments = explode('@', $this->routes[$requestType][$uri]);

          return $this->callAction(...$arguments);
      }

      // Protected because no other operation outside of this class will use it:
      protected function callAction($controller, $action)
      {
          $controller = new $controller;

          if (!method_exists($controller, $action)) {
              throw new Exception(
                  "{$controller} does not respond to the {$action} action."
              );
          }

          return $controller->$action();
      }
  }
  ```

  ```html
  <!-- views/users.view.php -->

  <?php require('partials/head.php'); ?>

    <h1>All Users</h1>

    <ul>
    <?php foreach ($users as $user) : ?>
      <li><?= $user->name; ?></li>
    <?php endforeach; ?>
    </ul>

    <h2>Submit Your Name</h2>

    <form method="POST" action="/users">
      <input name="name">
      <button type="submit">Submit</button>
    </form>

  <?php require('partials/footer.php'); ?>
  ```

[Back to TOC](#id-toc)

<div id='id-section24'/>

## Episode 24: Switch to Namespaces

- Namespacing is a technique used to prevent identifiers (e.g., objects/variables) from colliding with other identifiers in the global namespace.  Common practice is to have a namespace mimic your folder structure.  Thus, if you have a directory called `/controllers` that contains a controller labeled `PagesController.php`, you would insert the following `namespace` at the top of the file:

  ```php
  <?php

  namespace App\Controllers;

  class UsersController
  {
      ...
  }
  ```

- Note the following circumstances that should be taken into consideration when namespacing:

  ```php
  // core/bootstrap.php

  <?php

  // Basically acts like an import; indicates that any usage of "App" within
  // the file should be treated as "App\Core\App":
  use App\Core\App;

  App::bind('config', require 'config.php');

  App::bind('database', new QueryBuilder(
      Connection::make(App::get('config')['database'])
  ));

  function view($name, $data = [])
  {
      extract($data);

      return require "app/views/{$name}.view.php";
  }

  function redirect($path)
  {
      header("Location: /{$path}");
  }
  ```

  ```php
  // index.php

  <?php

  require 'vendor/autoload.php';
  require 'core/bootstrap.php';

  // PHP 7 allows you to consolidate namespacing where files share the same path:
  use App\Core\{Router, Request};

  Router::load('app/routes.php')
      ->direct(Request::uri(), Request::method());
  ```

  ```php
  // core/Router.php

  <?php

  namespace App\Core;

  class Router
  {
      public $routes = [
          'GET' => [],
          'POST' => [],
      ];

      public static function load($file)
      {
          $router = new static;
          require $file;
          return $router;
      }

      public function get($uri, $controller)
      {
          $this->routes['GET'][$uri] = $controller;
      }

      public function post($uri, $controller)
      {
          $this->routes['POST'][$uri] = $controller;
      }

      public function direct($uri, $requestType)
      {
          if (!array_key_exists($uri, $this->routes[$requestType])) {
              throw new Exception('No route defined for this URI.');
          }

          $arguments = explode('@', $this->routes[$requestType][$uri]);

          return $this->callAction(...$arguments);
      }

      protected function callAction($controller, $action)
      {
          // Add namespacing to the controller, and use double backslashes to
          // prevent the usage of a single backslash as an escape character:
          $namespacedController = "App\\Controllers\\{$controller}";

          $controller = new $namespacedController;

          if (!method_exists($controller, $action)) {
              throw new Exception(
                  "{$controller} does not respond to the {$action} action."
              );
          }

          return $controller->$action();
      }
  }
  ```

  ```php
  // app/controllers/UsersController.php

  <?php

  namespace App\Controllers;

  // Prevents "App" below from defaulting to "App\Controllers\App",
  // which does not exist:
  use App\Core\App;

  class UsersController
  {
      public function index()
      {
          $users = App::get('database')->selectAll('users');

          return view('users', compact('users'));
      }

      public function store()
      {
          App::get('database')->insert('users', [
              'name' => $_POST['name'],
          ]);

          return redirect('users');
      }
  }
  ```

[Back to TOC](#id-toc)
