<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/prestations', name: 'api_prestations', methods: ['GET'])]
    public function getPrestations(): JsonResponse
    {
        $data = [
            ['id' => 1, 'nom' => 'Entretien des espaces verts', 'prix' => 50],
            ['id' => 2, 'nom' => 'Taille des haies', 'prix' => 75],
            ['id' => 3, 'nom' => 'Élagage et abattage', 'prix' => 120]
        ];

        return $this->json($data);
    }
}