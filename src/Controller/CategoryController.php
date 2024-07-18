<?php

namespace App\Controller;

class CategoryController
{
    public function index()
    {
        global $twig;
        return $twig->render('views/category');
    }
}