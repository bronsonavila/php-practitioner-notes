<?php

namespace App\Controllers;

class PagesController
{
    public function home()
    {
        // view() is a custom helper function contained in "core/bootstrap.php":
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
