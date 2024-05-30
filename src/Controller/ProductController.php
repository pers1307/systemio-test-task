<?php

namespace App\Controller;

use App\Dto\ProductForCalculatePrice;
use App\Service\ErrorFormatService;
use App\Service\PriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly PriceService $priceService,
        private readonly ValidatorInterface $validator,
        private readonly ErrorFormatService $errorFormatService,
    ) {
    }

    #[Route('/calculate-price', name: 'product_calculate_price', methods: ['POST'])]
    public function calculatePrice(Request $request): JsonResponse
    {
        $inputBag = $request->getPayload();
        $productForCalculatePrice = new ProductForCalculatePrice(
            $inputBag->get('product'),
            $inputBag->get('taxNumber'),
            $inputBag->get('couponCode'),
        );

        $errors = $this->validator->validate($productForCalculatePrice);
        if (count($errors) > 0) {
            return new JsonResponse([
                'errors' => $this->errorFormatService->format($errors),
            ], 400);
        }

        try {
            $price = $this->priceService->calculate($productForCalculatePrice);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'errors' => [$exception->getMessage()],
            ], 400);
        }

        return new JsonResponse([
            'price' => $price,
        ]);
    }
}
