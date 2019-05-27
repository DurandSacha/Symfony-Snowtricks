<?php
// src/Controller/frontController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;

class frontController extends Controller
{

    public function home(Environment $twig)
    {
        $content = $twig->render('front/home.html.twig',['name' => 'sacha']);
        return new Response($content);
    }

    public function tricks($id)
    {

        return $this->render(
            'front/single.html.twig',
            ['id'  => $id
                ]);

    }
}