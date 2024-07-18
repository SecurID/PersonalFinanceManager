<?php
namespace App\Controller;

class HomeController {
    public function index()
    {
        global $twig;
        return $twig->render('home');
    }
}