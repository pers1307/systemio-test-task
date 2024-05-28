<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(): JsonResponse
    {
        return new JsonResponse([
            'price' => 5000,
        ]);
    }
}
