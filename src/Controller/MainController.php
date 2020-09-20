<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        //return new Response('<h1>Hello</h1>');
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/custom/{name?}", name="custom")
     */
    public function custom(Request $req)
    {
        $name = $req->get('name');
        //return new Response('<h1>Welcome ' .$name .  '</h1>');
        return $this->render('home/custom.html.twig',
            [
                'name' => $name
            ]);

    }
}
