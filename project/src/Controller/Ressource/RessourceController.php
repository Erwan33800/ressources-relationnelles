<?php

namespace App\Controller\Ressource;

use App\Repository\Ressource\RessourceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RessourceController extends AbstractController
{
    #[Route('/', name: 'ressource.index', methods: ['GET'])]
    public function index(RessourceRepository $ressourceRepository, Request $request): Response
    {
        $ressources = $ressourceRepository->findAll();
        return $this->render('pages/blog/index.html.twig', [
            'ressources' => $ressources,
        ]);
    }
}
