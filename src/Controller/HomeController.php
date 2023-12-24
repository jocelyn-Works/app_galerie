<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\GalerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(GalerieRepository $galerieRepository,
     BlogpostRepository $blogpostRepository): Response
    {

        return $this->render('home/home.html.twig', [
            'galeries' => $galerieRepository->lastTreeArts(),
            'blogposts' => $blogpostRepository->lastTreeBlogpost(),
        ]);
    }
}
