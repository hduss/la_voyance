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

    #[Route('/prestation/detail/{id}', name: 'app_blog_prestation_detail', requirements: ['id' => '\d+'])]
    public function detail($id): Response
    {
        $prestation = $this->prestationsRepository->findOneBy(['id' => $id]);
        return $this->render('prestation/detail.html.twig', [
            'prestation' => $prestation
        ]);
    }
}
