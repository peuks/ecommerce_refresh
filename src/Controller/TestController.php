<?php

namespace App\Controller;

use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    public function __construct()
    {
    }


    #[Route('/test/', name: 'test',)]
    public function index(Slugify $slugify): Response
    {

        dd($slugify->slugify("Bouya ta mere"));

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
