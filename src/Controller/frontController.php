<?php
// src/Controller/frontController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class frontController
{

    public function home(Environment $twig)
    {
        $content = $twig->render('front/home.html.twig',['name' => 'sacha']);
        return new Response($content);
    }

    public function tricks(Environment $twig) // passer l'id en parametre
    {
        $content = $twig->render('front/single.html.twig',['name' => 'sacha']);
        return new Response($content);
    }
}