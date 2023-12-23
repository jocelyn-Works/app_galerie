<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpPosteController extends AbstractController
{
    #[Route('/blogp/poste', name: 'app_blogp_poste')]
    public function index(): Response
    {
        return $this->render('blogp_poste/index.html.twig', [
            'controller_name' => 'BlogpPosteController',
        ]);
    }
}
