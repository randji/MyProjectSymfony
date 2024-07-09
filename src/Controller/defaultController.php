<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class defaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response('réponse ok');
    }
}