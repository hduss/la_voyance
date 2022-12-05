<?php

namespace App\Controller;

use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    public function __construct(private readonly PrestationsRepository $prestationsRepository)
    {
    }
    #[Route('/prestations', name: 'app_prestations')]
    public function index(): Response
    {
        $prestations = $this->prestationsRepository->findAll();
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestations
        ]);
    }
}
