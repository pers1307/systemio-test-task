<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/calculate-price', name: 'product_calculate_price', methods: ['POST'])]
    public function calculatePrice(): JsonResponse
    {
        return new JsonResponse([
            'price' => 5000,
        ]);
    }
}
