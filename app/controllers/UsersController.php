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
