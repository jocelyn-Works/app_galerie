<?php

namespace App\Controller;

use App\Repository\GalerieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RéalisationsController extends AbstractController
{
    #[Route('/realisations', name: 'realisations')]
    public function realisations(GalerieRepository $galerieRepository,
    PaginatorInterface $paginator,
    Request $request): Response
    {
        
        $data = $galerieRepository->findAll();

        $galeries = $paginator->paginate(
        $data,
        $request->query->getInt('page', 1),
        6
        );
        return $this->render('realisations/index.html.twig', [
            'galeries' => $galeries,
        ]);
    }

    // #[Route('/realisations/{id}', name: 'realisations_id')]
    // public function user_realisation () 
    // {
    //     return $this->render('realisations/usersRéalisation.html.twig', [
            
    //     ]); 
    // }
}
