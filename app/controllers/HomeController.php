<?php

namespace App\controllers;

use Hi\Core\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        print 'Benvenuto in Hi Framework !';
    }

    public function home()
    {
        $this->render('home', ['name' => 'diego', 'title' => 'Home page']);
    }
}
