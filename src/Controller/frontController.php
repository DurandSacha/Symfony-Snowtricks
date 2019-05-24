<?php
// src/Controller/frontController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class frontController
{
    public function index(Environment $twig)
    {
        $content = $twig->render('front/index.html.twig');
        //$content = 'controleur';


        return new Response($content);
    }
}